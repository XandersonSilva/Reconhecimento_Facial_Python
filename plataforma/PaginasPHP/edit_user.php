<?php 
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
                if(isset($_GET['ADD'])){
                    if($_GET['ADD'] == "Add"){
                        echo '<br><div class="alert alert-success text-center  border border-success" role="alert">Usuário editado com sucesso.</div>';
                    }
                    if($_GET['ADD'] == "Ext"){
                        echo '<br><div class="alert alert-warning text-center  border border-warning" role="alert">Você não pode subir esse tipo de extensão. Apenas PNG</div>';                    
                    }
                    if($_GET['ADD'] == "Erro"){
                        echo '<br><div class="alert alert-danger text-center  border border-danger" role="alert">Erro ao subir a imagem.</div>';
                    }
                    if($_GET['ADD'] == "DEL"){
                        echo '<br><div class="alert alert-danger text-center  border border-danger" role="alert">Usuário excluido com sucesso.</div>';
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
                        //BOTÃO DE DELETAR
                        echo "<br>
                        <form action='../ScriptsPHP/del_user.php' method='post'>
                        <input type='checkbox' value='$row[CPF]' name='cpf' required> 
                        <select class='form-select' aria-label='Default select example' name='matricula' style='display: none;' required>
                            <option value='$row[matricula]'>$row[matricula]</option>
                        </select>
                        <input type='submit' value='Deletar' class='btn btn-danger' name='del' name='$row[nome]'> <br><br>
                        </form>";
                        
                        //ÁREA DE EDIÇÃO DO USUÁRIO
                        echo "<form action='../ScriptsPHP/edit_user.php' method='post' class='card container text-left' style='width: 30em;' enctype='multipart/form-data'>
                        <div class='mb-3'>
                        <select class='form-select' aria-label='Default select example' name='old' style='display: none;' required>
                            <option value='$row[matricula]'>$row[matricula]</option>
                        </select> <select class='form-select' aria-label='Default select example' name='old2' style='display: none;' required>
                        <option value='$row[CPF]'>$row[CPF]</option>
                    </select>
                            <label for='exampleInputEmail1' class='form-label' style='padding-top: 15px;'>Tipo:</label>
                            <select class='form-select' aria-label='Default select example' name='tipo' required>
                                <option value='Aluno'>Aluno</option>
                                <option value='Professor'>Professor</option>
                                <option value='Servidor'>Servidor</option>
                                <option value='Funcionário'>Funcionário</option>
                                <option value='Outro'>Outro</option>
                            </select>
                        </div>
                        <div class='mb-3'>
                            <label for='exampleInputEmail1' class='form-label'>Número de matrícula / associado:</label>
                            <input name='matricula' type='text' class='form-control' id='exampleInputEmail1' placeholder='$row[matricula]' required>
                        </div>
                        <div class='mb-3'>
                            <label for='exampleInputEmail1' class='form-label'>Cargo / Turma</label>
                            <select name = 'CT' class='form-select' aria-label='Default select example' name='tipo' required>
                                <option value='Professor'>Professor</option>
                                <option value='Servidor'>Servidor</option>
                                <option value='Funcionário'>Funcionário</option>
                                <option value='Informática'>Informática</option>
                                <option value='Mineração'>Mineração</option>
                                <option value='Eletromecânica'>Eletromecânica</option>
                                <option value='Meio ambiente'>Meio ambiente</option>
                                <option value='Lic. Computação'>Lic. Computação</option>
                                <option value='Outro'>Outro</option>
                            </select>
                        </div>
                        <div class='mb-3'>
                            <label for='exampleInputPassword1' class='form-label'>Nome: </label>
                            <input name='nome' type='text' class='form-control' id='exampleInputPassword1' placeholder='$row[nome]' required>
                        </div>
                        <div class='mb-3'>
                            <label for='exampleInputPassword1' class='form-label'>CPF: </label>
                            <input name='CPF' type='number' class='form-control' id='exampleInputPassword1' placeholder='$row[CPF]'required>
                        </div>
                        <div class='mb-3'>
                            <label for='exampleInputPassword1' class='form-label'>Foto: </label>
                                <br>
                            <input type='file' name='foto' onchange='checkFileSize()'  id='fotoUsr' accept='image/png'>
                        </div>
                            <input name='add' type='submit' value='Adicionar' class='btn btn-info'>
                            <br>
                    </form>";
                    }

                    else{ //Tratamento de ERRO
                        echo '<br><div class="alert alert-danger text-center  border border-danger" role="alert">Usuário não encotrado.</div>';
                    }
                    
                }catch(PDOException $e){ //Tratamento de ERRO
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
