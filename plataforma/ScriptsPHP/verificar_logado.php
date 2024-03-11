<?php 
    //VERIFICA SE O USUÁRIO ADMIN JÁ ESTÁ LOGADO, CASO NÃO ESTEJA, REDIRECIONA PARA LOGIN
    session_start();
    if(isset($_SESSION['logado_controlador']) == true){
        header('Location: ../PaginasPHP/controlador/liberar_catraca.php');
    }
    elseif ((!isset($_SESSION['logado_admin']) == true) ){
        unset($_SESSION['logado_admin']);
        session_destroy();
        header('Location: ../Cadastro_Login/index.php');
    }
?>