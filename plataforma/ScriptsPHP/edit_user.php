<?php
include "./conexao.php";

//Editar permanente
if(isset($_POST['addP'])){
    //Variáveis
    $CPF = $_POST['CPF'];
    $nome = $_POST['nome'];
    $funcao = $_POST['tipo'];
    $matricula = $_POST['matricula'];
    $CT = $_POST['CT'];
    $old = $_POST['old'];
    $old2 = $_POST['old2'];
    $extensão = $_FILES['foto']['name'];
    $extensão = pathinfo($extensão, PATHINFO_EXTENSION);

    //Adicionando foto
    if(isset($_FILES['foto']) && !empty($_FILES['foto']) && !$_FILES['foto']['error']){
        //Verifica a extensão da foto para PNG
        if($extensão == 'png'){
            //Deleta a foto antiga
            unlink("../../armazenamento/fotos/$old2.png");

            //Adiciona a foto no diretório das fotos
            move_uploaded_file($_FILES['foto']["tmp_name"] , "../../armazenamento/fotos/". $CPF . ".png");
            $Caminho_das_fotos = ["/fotos/$CPF.png"];
        }
        else{ //Tratamento de ERRO da extensão
            header('Location: ../PaginasPHP/edit_user.php?ADD=Ext');
            die("Você não pode subir esse tipo de extensão. Apenas PNG.");
        }
    }else{ //Tratamento de ERRO
        header('Location: ../PaginasPHP/edit_user.php?ADD=Erro');
        die("Error");
    }
    
    //Alterações no BD
    if($CPF and $nome and $funcao and $CT and $matricula and $Caminho_das_fotos){
        //Comando para realizar as alterações no BD
        $query = "UPDATE usuario SET cpf = $CPF, nome = '$nome', funcao = '$funcao', imagemURL = '$Caminho_das_fotos[0]', turma = '$CT', matricula = '$matricula', pontos = NULL WHERE matricula = $old"; 
        $query2 = "UPDATE logs SET cpf = $CPF where cpf = $old2"; 
        try{ //Sucesso
            $result = $db->exec($query);
            $result2 = $db->exec($query2);
            header('Location: ../PaginasPHP/edit_user.php?ADD=Add');
        } catch (PDOException $e) { //Tratamento de ERRO
            echo "Erro: " . $e->getMessage();
        }
    }
    else{ //Tratamento de ERRO
        header('Location: ../PaginasPHP/edit_user.php?ADD=Erro');
        die("Error");
    }
}

//Editar temporário
if(isset($_POST['addT'])){
    $CPF = htmlspecialchars(strip_tags($_POST['CPF']));
    $nome = htmlspecialchars(strip_tags($_POST['nome']));
    $dias = $_POST['dias'];
    $dias = date("d/m/Y")." ".$dias;
    $motivo = htmlspecialchars(strip_tags($_POST['motivo']));
    $extensão = $_FILES['foto']['name'];
    $extensão = pathinfo($extensão, PATHINFO_EXTENSION);
    $old2 = $_POST['old2'];


    echo "$CPF, $nome, $dias, $motivo, $extensão, $old2";

    if(isset($_FILES['foto']) && !empty($_FILES['foto']) && !$_FILES['foto']['error']){
        //Verifica a extensão da foto para PNG
        if($extensão == 'png'){
            //Deleta a foto antiga
            unlink("../../armazenamento/fotos/$old2.png");

            //Adiciona a foto no diretório das fotos
            move_uploaded_file($_FILES['foto']["tmp_name"] , "../../armazenamento/fotos/". $CPF . ".png");
            $Caminho_das_fotos = ["/fotos/$CPF.png"];
        }
        else{ //Tratamento de ERRO da extensão
            header('Location: ../PaginasPHP/edit_user.php?ADD=Ext');
            die("Você não pode subir esse tipo de extensão. Apenas PNG.");
        }
    }else{ //Tratamento de ERRO
        header('Location: ../PaginasPHP/edit_user.php?ADD=Erro');
        die("Error");
    }

    if($CPF and $nome and $dias and $motivo and $Caminho_das_fotos){
        //Comando para realizar as alterações no BD
        $query = "UPDATE usuario SET cpf = $CPF, nome = '$nome', periodo = '$dias', imagemURL = '$Caminho_das_fotos[0]', motivo = '$motivo', pontos = NULL WHERE cpf = $old2"; 
        $query2 = "UPDATE logs SET cpf = $CPF where cpf = $old2"; 
        try{ //Sucesso
            $result = $db->exec($query);
            $result2 = $db->exec($query2);
            header('Location: ../PaginasPHP/edit_user.php?ADD=Add');
        } catch (PDOException $e) { //Tratamento de ERRO
            echo "Erro: " . $e->getMessage();
        }
    }
    else{ //Tratamento de ERRO
        header('Location: ../PaginasPHP/edit_user.php?ADD=Erro');
        die("Error");
    }
}

?>