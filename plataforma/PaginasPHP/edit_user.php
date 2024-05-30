<?php 
    //VERIFICAÇÃO DE LOGIN
    require('../ScriptsPHP/verificar_logado.php')
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar usuário</title> 
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
                <a class="nav-link active" aria-current="true" href="./edit_user.php">Editar usuário</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./logs_date.php">LOGS data</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./logs_user.php">LOGS de usuários</a>
            </li>
            </ul>
        </div>
        <div class="card-body">
            <h5 class="card-title">Editar usuário</h5>
            <form action="" method="post">
            <?php 
                //MENSAGENS
                if(isset($_GET['ADD'])){
                    //EDIÇÃO COM SUCESSO
                    if($_GET['ADD'] == "Add"){
                        echo '<br><div class="alert alert-success text-center  border border-success" role="alert">Usuário editado com sucesso.</div>';
                    }
                    //ERRO DE EXTENSÃO
                    if($_GET['ADD'] == "Ext"){
                        echo '<br><div class="alert alert-warning text-center  border border-warning" role="alert">Você não pode subir esse tipo de extensão. Apenas PNG</div>';                    
                    }
                    //ERRO AO SUBIR IMAGEM
                    if($_GET['ADD'] == "Erro"){
                        echo '<br><div class="alert alert-danger text-center  border border-danger" role="alert">Erro ao subir a imagem.</div>';
                    }
                    //EXCLUIDO COM SUCESSO
                    if($_GET['ADD'] == "DEL"){
                        echo '<br><div class="alert alert-danger text-center  border border-danger" role="alert">Usuário excluido com sucesso.</div>';
                    }
                    //ERRO DE DATA
                    if($_GET['ADD'] == "date"){
                        echo '<br><div class="alert alert-danger text-center  border border-danger" role="alert">É necessário que a data tenha no mínimo 24 horas a mais do dia atual.</div>';
                    }
                }
                
            ?>
                <label for="search">CPF do usuário: </label>
                <input type="number" name="cpf" placeholder="CPF do usuário">
                <input type="submit" value="Procurar" class="btn btn-info">
            </form>
            <?php 
            $cpf = $_POST['cpf'] ?? '';

            if($cpf != ''){
                try{
                    include_once "../ScriptsPHP/conexao.php";

                    //Comando para buscar o usuário
                    $query =  $db->prepare("SELECT * from usuario where cpf = :cpf"); 
                    $query->bindParam(':cpf', $cpf, PDO::FETCH_ASSOC);
                    $query->execute();
                    $row = $query->fetch(PDO::FETCH_ASSOC);
                    
                    if($row){ 
                        //Edição de usuários permanente.
                        if($row['periodo'] == NULL){
                            require './edit_P.php';
                        }
                        //Edição de usuários temporário
                        if($row['periodo'] != NULL){
                            require './edit_T.php';
                        }
                    }

                    else{ //Tratamento de ERRO usuário não encontrado
                        echo '<br><div class="alert alert-danger text-center  border border-danger" role="alert">Usuário não encotrado.</div>';
                    }
                    
                }catch(PDOException $e){ //Tratamento de ERRO erro ao procurar usuário
                     echo '<br><div class="alert alert-danger text-center  border border-danger" role="alert">ERRO AO PROCURAR USUÁRIO ' . $e->getMessage() . '</div>';
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
