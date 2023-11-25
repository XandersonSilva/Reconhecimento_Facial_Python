<?php

// Usando a extensão PDO para criar uam conexão com o banco
// Caminho relativo para o banco de dados SQLite (dois níveis acima)
$dbPathRelativo = '../../armazenamento/Banco_comSQLite/banco.db';

// Caminho completo usando __DIR__ que retorna a localização do arquivo atual
$bdPath = __DIR__ . '/' . $dbPathRelativo;
// instância do PDO com o caminho final
$db = new PDO('sqlite:' . $bdPath);


// Consultando dados
$query = "SELECT id, nome, email, chave_de_acesso FROM usuario WHERE nivelAcesso = 'Admin'";
$result = $db->query($query);

$email = trim($_POST['Email']) ?? '';
$senha = trim($_POST['Senha']) ?? '';


$definido = 0;
$usuarioValid = 0;


// Percorrer os objetos do array e fazer verificações
foreach ($result as $row) {
    if(password_verify($senha, $row['chave_de_acesso']) && $row['email'] == $email){
        $usuarioValid ++;
        if(isset($row['nome'])){
            $usserAtu      = $row['nome'];
        }else{
            $usserAtu = "";
        }
    }
}
//$usserAtu = urlencode($usserAtu);

if ($usuarioValid == 0){
    header("Location: ../Cadastro_Login/index.php?erro=Nregistrado");
}else{
    //Define os cookies de sessão necessários, e confirma que o usuário está logado através de sessão
    
    session_start();
    $_SESSION['logado'] = true;
    $_SESSION['User'] = $usserAtu;
    header("Location: ../PaginasPHP/index.php");
}
?>

