<?php 
    require('../ScriptsPHP/verificar_logado.php')
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGS de usuários</title> 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<header>
    <nav class="navbar bg-info border-body" data-bs-theme="dark">
        <div class="container-fluid">
            <h3 class="text-light">Projeto catraca / IFBA</h3>
            <form action="./index.php">
                <br>
                <button class="btn btn-dark" type="submit">Voltar</button>
            </form>
        </div>
    </nav>
</header>
<br>

<body class="bg-dark">
    <div class="card text-center container" style="width: 50em;">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
            <li class="nav-item">
                <a class="nav-link" href="./edit_user.php">Editar usuário</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./del_user.php">Excluir usuário</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" aria-current="true"  href="./logs_user.php">LOGS de usuários</a>
            </li>
            </ul>
        </div>
        <div class="card-body">
            <h5 class="card-title">LOGS de usuário</h5>
            <form action="" method="post">
                <label for="search">Nome do usuário: </label>
                <input type="search" name="log" placeholder="Nome do usuário">
                <input type="submit" value="Procurar" class="btn btn-info">
                <?php 

                $nome = $_POST['log'] ?? '';

                if($nome != ''){
                        if(!file_exists("../../armazenamento/LOGS/$nome.log")){
                            echo "<div class='alert alert-danger text-center  border border-danger'>LOGS de usuário não encontrado.</div>";
                            die;
                        }
                        else{
                            $BD = fopen("../../armazenamento/LOGS/$nome.log", "r");
                            $json = fread($BD, filesize("../../armazenamento/LOGS/$nome.log"));
                            echo "<br>".$nome;
                            echo $json;
                        }
                }

                ?>
            </form>
        </div>
    </div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
