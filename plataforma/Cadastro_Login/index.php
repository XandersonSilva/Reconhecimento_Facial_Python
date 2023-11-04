<?php 
    // VERFICA SE O USUÁRIO JÁ ESTÁ LOGADO, CASO SIM, REDIRECIONA PARA A PÁGINA PRINCIPAL
    session_start();
    if ((isset($_SESSION['logado']) == true)){
        header('Location: ../PaginasPHP/index.php');
    }
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="bg-dark">
    <br><br><br>
    <div class="container" style="width: 30em;">
        <div class="row">
            <div class="col align-self-center">
                <div class="card text-light bg-dark">
                    <div class="card-header bg-info text-center">
                        <h2>Login</h2>
                    </div>
                    <div class="card-body">
                        <form action="../ScriptsPHP/validarLogin.php" method="post" >
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Email:</label>
                                    <input type="email" class="form-control" name="Email" placeholder="Email@ifba.edu.br" required size="30">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Senha:</label>
                                    <input type="password" class="form-control" name="Senha" placeholder="Senha" required size="30">
                                </div>
                                <button type="submit" class="btn btn-primary">Entrar</button>
                            </form>
                    </div>
                    <?php 
                        if (isset($_GET['erro'])){
                            echo '<div class="alert alert-danger text-center  border border-danger" role="alert">Email ou senha incorretos</div>';
                        }
                    ?>
                    <div class="card-footer text-center">
                        <footer>
                                <small>
                                    &reg; Todos os direitos reservados
                                </br>
                                    Contato Xanderson: <a href="https://github.com/xandersonsilva" target="_blank">GitHub </a> - <a href="https://www.instagram.com/x.s.s____/" target = "_blank">Instagram</a> <br>
                                    Contato João Vitor: <a href="https://github.com/SilvestreLago" target="_blank">GitHub </a> - <a href="https://www.instagram.com/silvestre_lago" target = "_blank">Instagram</a>
                                </small>
                            </footer>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

   
    
    
   
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>