<?php
require('./verificar_logado.php');


if(isset($_POST['add'])) {
    $matricula = $_POST['matricula'];
    $nome = $_POST['nome'];
    $tipo = $_POST['tipo'];
    $CT = $POST['CT'];
    $extensão = $_FILES['foto']['name'];
    $extensão = pathinfo($extensão, PATHINFO_EXTENSION);
    echo $extensão;
    if(isset($_FILES['foto']) && !empty($_FILES['foto']) && !$_FILES['foto']['error']){
        if($extensão == 'png'){
            move_uploaded_file($_FILES['foto']["tmp_name"] , "../../armazenamento/fotos/". $matricula . ".png");
            header('Location: ../PaginasPHP/add_user_P.php?ADD=Add');
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


$BD = '../../armazenamento/Dados_Imagens/dados.json';

$val = json_decode(file_get_contents($BD));

$novo_Val = array(array(
    "num" => $matricula,
    "nome" => $nome,
    "tipo" => $tipo,
    "cargo/turma" => $CT,
    "Caminho_das_fotos" => ["/opt/lampp/htdocs/sites/Reconhecimento_Facial_Python/armazenamento/fotos/$matricula.png"],
    "face_Encoded" => []
));

$NBD = json_encode(array_merge($val, $novo_Val));

if($NBD === false){
    die('Erro na codificação do JSON.');
}
elseif(file_put_contents($BD, $NBD)){
    echo 'Informações adicionadas com sucesso no JSON.';
} 
else{
    echo 'Erro ao escrever no arquivo JSON.';
}
?>
