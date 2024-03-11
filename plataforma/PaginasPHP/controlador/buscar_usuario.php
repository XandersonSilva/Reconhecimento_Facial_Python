<?php 
    require('../../ScriptsPHP/verificar_logado_controlador.php')
?>
<!DOCTYPE html>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página principal</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style> 
        h1, h3{
            color: white;
        }
    </style>
</head>
<header>
    <nav class="navbar bg-info border-body" data-bs-theme="dark">
        <div class="container-fluid">
            <h3>Projeto catraca / IFBA</h3>
            <form action="../../ScriptsPHP/sair.php">
                <br>
                <button class="btn btn-danger" type="submit">Sair</button>
            </form>
        </div>
    </nav>
</header>
<br>
<body class="bg-dark">
<h1 class="text-center display-4">Painel controlador</h1>

    <div class="card text-center container" style="width: 50em;">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
            <li class="nav-item">
                <a class="nav-link" href="./liberar_catraca.php">Liberar Catraca</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" aria-current="true"  href="./buscar_usuario.php">Buscar Usuário</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./logs_user.php">LOGS</a>
            </li>
            </ul>
        </div>
        <div class="card-body">
            <h2>Em andamento...</h2>
        </div>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
