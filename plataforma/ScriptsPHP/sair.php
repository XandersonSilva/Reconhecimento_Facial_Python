<?php 
require('./verificar_logado.php');
    //Limpa a sessão do usuário e faz logout
    session_start();
    unset($_SESSION['logado_admin']);
    unset($_SESSION['logado_controlador']);
    unset($_SESSION['User']);
    session_destroy();
    header('Location: ../Cadastro_Login/index.php');
?>