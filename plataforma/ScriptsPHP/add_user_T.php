<?php
include_once "./conexao.php";

if(isset($_POST['add'])) {
    //Variáveis
    //Usando htmlspecialchars(strip_tags()) para evitar XSS
    $CPF = htmlspecialchars(strip_tags($_POST['CPF']));
    $nome = htmlspecialchars(strip_tags($_POST['nome']));
    $motivo = htmlspecialchars(strip_tags($_POST['motivo']));
    
    $extensão = $_FILES['foto']['name'];
    $extensão = pathinfo($extensão, PATHINFO_EXTENSION);
    
    $dia = new DateTime($_POST['dias']); //Data fornecida pelo user
    $dias = $dia->format('d/m/Y');       //Formatação da data acima para salvar no BD
    $dia = $dia->format('Y/m/d');        //Formatação da data acima para comparação no IF abaixo
    $hoje = new DateTime();              //Data do dia atual
    $hoje = $hoje->format('Y/m/d');      //Formatação do dia atual
    
    //Verificação da data
    if($dia <= $hoje){
        header('Location: ../PaginasPHP/add_user_T.php?ADD=date');
        die("É necessário no mínimo 24h a mais na data.");
    }

    //Adicionar fotos
    if(isset($_FILES['foto']) && !empty($_FILES['foto']) && !$_FILES['foto']['error'])
    {
        //Confirma a extensão da foto como PNG
        if($extensão == 'png'){
            //Adicionando a foto ao diretório com as fotos
            move_uploaded_file($_FILES['foto']["tmp_name"] , "../../armazenamento/fotos/". $CPF . ".png");
            $Caminho_das_fotos = ["/fotos/$CPF.png"][0];
        }
        else{ //Tratamento de ERRO da extensão
            header('Location: ../PaginasPHP/add_user_T.php?ADD=Ext');
            die("Você não pode subir esse tipo de extensão. Apenas PNG.");
        }
    }else{ //Tratamento de ERRO
        header('Location: ../PaginasPHP/add_user_T.php?ADD=Erro');
        die("Error");
    }
}

//Adição no BD
if($CPF and $nome and $motivo and $dias and $Caminho_das_fotos){
    try{    
        //Comando para inserir os dados do usuário
        $query = $db->prepare("INSERT INTO usuario(cpf, nome, imagemURL, periodo, motivo) VALUES(:cpf, :nome, :imagemURL, :periodo, :motivo)");
        //Usando bindParam() para evitar SQLINJECTION
        $query->bindParam(':cpf', $CPF, PDO::PARAM_INT);
        $query->bindParam(':nome', $nome, PDO::PARAM_STR);
        $query->bindParam(':imagemURL', $Caminho_das_fotos, PDO::PARAM_STR);
        $query->bindParam(':periodo', $dias, PDO::PARAM_STR);
        $query->bindParam(':motivo', $motivo, PDO::PARAM_STR);

        $result = $query->execute();
        header('Location: ../PaginasPHP/add_user_T.php?ADD=Add');
    }catch (PDOException $e) { //Tratamento de ERRO
        echo "Erro: " . $e->getMessage();
        header('Location: ../PaginasPHP/add_user_T.php?ADD=ErroBD');
    }
}
else{ //Tratamento de ERRO
    header('Location: ../PaginasPHP/add_user_T.php?ADD=ErroG');
    die("Error");
}

?>
