<?php 
    require('../ScriptsPHP/verificar_logado.php')
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Codificar fotos</title> 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<header>
    <nav class="navbar bg-info border-body" data-bs-theme="dark">
        <div class="container-fluid">
            <h3 class="text-light">Projeto catraca / IFBA</h3>
            <form action="../PaginasPHP/index.php">
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
                <a class="nav-link" href="./add_user_P.php">Adicionar permanente</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./add_user_T.php">Adicionar temporário</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" aria-current="true" href="./codificar.php">Codificar fotos</a>
            </li>
            </ul>
        </div>
        <div class="card-body">
            <h5 class="card-title">Codificar fotos</h5>
            <p class="card-text">Ao clicar, será codificada todas as fotos que estão no banco de dados com o estado pendente.</p>
            <form action="" method="POST">
                <input type="submit" class="btn btn-info" value="Codificar">
            </form>
            <br>    
            <?php 
                //Requisição para o FLASK para codificar as fotos
                if($_SERVER['REQUEST_METHOD'] === 'POST'){
                    try {
                        //Gera uma chave aleatório entre 1000 e 9999
                        $key = rand(1000, 9999);

                        //Arquivo da chave
                        $BD = '../../key.json';

                        $novo_Val = (
                            $key
                        );
                        
                        //Adiciona o valor ao JSON
                        $NBD = json_encode($novo_Val);
                        file_put_contents($BD, $NBD);

                        //Realiza uma requisição com a chave como parâmetro
                        $response = @file_get_contents("http://localhost:5000/validate?OK=$key");
                        
                        //Tratamento de ERRO
                        if ($response === false) {
                            throw new Exception('Servidor fora do ar');
                        }
                        else{
                            //Resposta
                            echo $response;
                        }
                    } catch (Exception $e) { //Tratamento de ERRO
                        echo "<div class='alert alert-danger text-center  border border-danger'>Erro interno do servidor.</div>";
                    }
                }
            ?>
        </div>
    </div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

