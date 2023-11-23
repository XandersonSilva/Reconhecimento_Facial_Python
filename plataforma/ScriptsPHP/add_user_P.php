<?php
// Usando a extensão PDO para criar uma conexão com o banco
// Caminho relativo para o banco de dados SQLite (dois níveis acima)
$dbPathRelativo = '../../armazenamento/Banco_comSQLite/banco.db';

// Caminho completo usando __DIR__ que retorna a localização do arquivo atual
$bdPath = __DIR__ . '/' . $dbPathRelativo;
// instância do PDO com o caminho final
$db = new PDO('sqlite:' . $bdPath);



if(isset($_POST['add'])) {
    $matricula = $_POST['matricula'];
    $nome = $_POST['nome'];
    $tipo = $_POST['tipo'];
    $CT = $POST['CT'];
    $extensão = $_FILES['foto']['name'];
    $extensão = pathinfo($extensão, PATHINFO_EXTENSION);
    echo $extensão;
    if(isset($_FILES['foto']) && !empty($_FILES['foto']) && !$_FILES['foto']['error'])
    {
        if($extensão == 'png'){
            move_uploaded_file($_FILES['foto']["tmp_name"] , "../../armazenamento/fotos/". $matricula . ".png");
        }
        else{
            header('Location: ../PaginasPHP/add_user_P.php?ADD=Ext');
            die("Você não pode subir esse tipo de extensão. Apenas PNG.");
        }
    }else{
        header('Location: ../PaginasPHP/add_user_P.php?ADD=Erro');
        die("Error");
    }
}

$nome = $nome;
$tipo = $tipo;
$cargo_turma = $CT;
$num  = $matricula;
$Caminho_das_fotos = ["/fotos/$matricula.png"];
//$face_Encoded = [];

if($tipo == $cargo_turma){
    $query =  "insert into usuario(
        nome,
        funcao,
        numero_identificacao_pessoal,
        imagemURL,
        presente
        ) 
        values(
            '$nome' ,
            '$tipo' ,
            '$num'  ,
            '$Caminho_das_fotos[0]',
            0
        );
        ";
        
        
    }else{
        echo $valores;
        $query =  "insert into usuario(
            nome,
            funcao,
            turma,
            matricula,
            imagemURL,
            presente
            ) 
            values(
                '$nome'       ,
                '$tipo'       ,
                '$cargo_turma',
                '$num'        ,
                '$Caminho_das_fotos[0]',
                0
            );";
            
}

try{
    $result = $db->exec($query);
    header('Location: ../PaginasPHP/add_user_P.php?ADD=Add');
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
    
}

?>
