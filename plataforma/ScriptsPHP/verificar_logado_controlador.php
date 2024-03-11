<?php 
    //VERIFICA SE O USUÁRIO CONTROLADOR JÁ ESTÁ LOGADO, CASO NÃO ESTEJA, REDIRECIONA PARA LOGIN
    session_start();
    if(isset($_SESSION['logado_admin']) == true){
        header('Location: ../index.php');
    }
    elseif ((!isset($_SESSION['logado_controlador']) == true) ){
        unset($_SESSION['logado_controlador']);
        session_destroy();
        header('Location: ../Cadastro_Login/index.php');
    }
?>