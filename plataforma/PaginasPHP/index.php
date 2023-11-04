<?php 
    require('../ScriptsPHP/verificar_logado.php')
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
            <form action="../ScriptsPHP/sair.php">
                <br>
                <button class="btn btn-danger" type="submit">Sair</button>
            </form>
        </div>
    </nav>
</header>
<br>
<body class="bg-dark">
    <h1 class="text-center display-4">Painel administrativo</h1>
    <br>
    <div class="card-group">
        <div class="col-sm-6 mb-3 mb-sm-0">
            <div class="card">
                    <ul class="list-group">
                        <li class="list-group-item bg-info text-light text-center h4" aria-current="true">Adiconar usuário:</li>
                        <li class="list-group-item">Adicionar usuário permanente</li>
                        <li class="list-group-item">Adiconar usuário temporário</li>
                        <li class="list-group-item">Codificar foto</li>
                        <li class="list-group-item"><a href="add_user_P.php" class="btn btn-info">Acessar</a></li>
                    </ul>
            </div>
        </div>
        <div class="col-sm-6 mb-3 mb-sm-0">
            <div class="card">
                    <ul class="list-group">
                        <li class="list-group-item bg-info text-light text-center h4" aria-current="true">Acessar usuário:</li>
                        <li class="list-group-item">Editar usuário</li>
                        <li class="list-group-item">Excluir usuário</li>
                        <li class="list-group-item">Logs de usuário</li>
                        <li class="list-group-item"><a href="edit_user.php" class="btn btn-info">Acessar</a></li>
                    </ul>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
