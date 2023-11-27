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
                <label for="search">CPF do usuário: </label>
                <input type="search" name="log" placeholder="CPF do usuário">
                <input type="submit" value="Procurar" class="btn btn-info">

                <?php 

                $nome = $_POST['log'] ?? '';
                $log = $nome;

                if($nome != ''){
                    try{
                        // Usando a extensão PDO para criar uma conexão com o banco
                        // Caminho relativo para o banco de dados SQLite (dois níveis acima)
                        $dbPathRelativo = '../../armazenamento/Banco_comSQLite/banco.db';

                        // Caminho completo usando __DIR__ que retorna a localização do arquivo atual
                        $bdPath = __DIR__ . '/' . $dbPathRelativo;
                        // instância do PDO com o caminho final
                        $db = new PDO('sqlite:' . $bdPath);

                        $query =  "SELECT * from logs where cpf = $log ORDER BY dataLog DESC";
                        $query2 =  "SELECT nome from usuario where cpf = $log"; 

                        $result = $db->query($query);
                        $result2 = $db->query($query2);

                        $row = $result->fetch(PDO::FETCH_ASSOC);
                        $row2 = $result2->fetch(PDO::FETCH_ASSOC);

                        echo "<br>" . $row2['nome']."<br>";
                        echo $row['dataLog']."Hr<br>";
                        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                            echo $row['dataLog']."Hr<br>";
                        }
                    }catch(PDOException $e){
                         echo '<br><div class="alert alert-danger text-center  border border-danger" role="alert">LOG não encotrado.</div>';
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
