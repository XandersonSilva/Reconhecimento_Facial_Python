<?php
include_once "./conexao.php";

// Consultando dados
$query = "SELECT id, nome, email, chave_de_acesso FROM usuario WHERE nivelAcesso = 'TRUE'";
$result = $db->query($query);

$email = trim($_POST['Email']) ?? '';
$senha = trim($_POST['Senha']) ?? '';


$definido = 0;
$usuarioValid = 0;


// Percorrer os objetos do array e fazer verificações
foreach ($result as $row) {
    if(password_verify($senha, $row['chave_de_acesso']) && $row['email'] == $email){
        if($row['nome'] == 'Administrador'){
            $usuarioValid = 1;
        }
        elseif($row['nome'] == 'Controlador'){
            $usuarioValid = 2;
        }
    }
}

if ($usuarioValid == 0){
    header("Location: ../Cadastro_Login/index.php?erro=Nregistrado");
}elseif($usuarioValid == 1){
    //Define os cookies de sessão necessários ADMIN, e confirma que o usuário está logado através de sessão
    session_start();
    $_SESSION['logado_admin'] = true;
    $_SESSION['User'] = $row['nome'];
    header("Location: ../PaginasPHP/index.php");
}elseif($usuarioValid == 2){
    //Define os cookies de sessão necessários CONTROLADOR, e confirma que o usuário está logado através de sessão
    session_start();
    $_SESSION['logado_controlador'] = true;
    $_SESSION['User'] = $row['nome'];
    header("Location: ../PaginasPHP/controlador/liberar_catraca.php");
}
?>

