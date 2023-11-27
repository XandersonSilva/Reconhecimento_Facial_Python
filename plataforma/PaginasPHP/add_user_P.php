<?php 
    require('../ScriptsPHP/verificar_logado.php')
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar usuário permanente</title> 
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
                <a class="nav-link active" aria-current="true" href="./add_user_P.php">Adicionar permanente</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./add_user_T.php">Adicionar temporário</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./codificar.php">Codificar fotos</a>
            </li>
            </ul>
        </div>
        <div class="card-body">
            <h5 class="card-title">Adicionar usuário permanente</h5>
            <form action="../ScriptsPHP/add_user_P.php" method="post" class="card container text-left" style="width: 30em;" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label" style="padding-top: 15px;">Tipo:</label>
                    <select class="form-select" aria-label="Default select example" name="tipo" required>
                        <option value="1">Aluno</option>
                        <option value="2">Professor</option>
                        <option value="3">Servidor</option>
                        <option value="4">Funcionário</option>
                        <option value="5">Outro</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Número de matrícula / associado:</label>
                    <input name="matricula" type="text" class="form-control" id="exampleInputEmail1" required>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Cargo / Turma</label>
                    <select name = "CT" class="form-select" aria-label="Default select example" name="tipo" required>
                        <option value="1">Professor</option>
                        <option value="2">Servidor</option>
                        <option value="4">Funcionário</option>
                        <option value="5">Informática</option>
                        <option value="6">Mineração</option>
                        <option value="7">Eletromecânica</option>
                        <option value="8">Meio ambiente</option>
                        <option value="9">Lic. Computação</option>
                        <option value="10">Outro</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Nome: </label>
                    <input name="nome" type="text" class="form-control" id="exampleInputPassword1" required>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">CPF: </label>
                    <input name="CPF" type="text" class="form-control" id="exampleInputPassword1" required>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Foto: </label>
                        <br>
                    <input type="file" name="foto" onchange="checkFileSize()"  id="fotoUsr" accept="image/png">
                </div>
                    <input name="add" type="submit" value="Adicionar" class="btn btn-info">
                    <br>
            </form>
            <?php 
                if(isset($_GET['ADD'])){
                    if($_GET['ADD'] == "Add"){
                        echo '<br><div class="alert alert-success text-center  border border-success" role="alert">Usuário adicionado com sucesso.</div>';
                    }
                    if($_GET['ADD'] == "Ext"){
                        echo '<br><div class="alert alert-warning text-center  border border-warning" role="alert">Você não pode subir esse tipo de extensão. Apenas PNG</div>';
                    }
                    if($_GET['ADD'] == "Erro"){
                        echo '<br><div class="alert alert-danger text-center  border border-danger" role="alert">Erro ao subir a imagem.</div>';
                    }
                }
                
            ?>
            
        </div>
    </div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
     function checkFileSize() {
            var fileInput = document.getElementById('fotoUsr');
            var maxSize = 2 * 1024 * 1024; // 2 megabytes
            
            if (fileInput.files.length > 0) {
                var fileSize = fileInput.files[0].size;
                
                if (fileSize > maxSize) {
                    alert('O arquivo excede o tamanho máximo permitido.');
                    // Limpar o campo de arquivo se o tamanho for excedido
                    fileInput.value = '';
                }
            }
     }
    
</script>
</body>
</html>
