<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar foto</title>
</head>
<body>
    <form action="" method="POST">
        <label for="foto">Clique para codificar as fotos.</label>
        <input type="submit" value="OK">
    </form>

    <?php 
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $response = file_get_contents('http://localhost:5000/validate?OK=OK');
            echo $response; 
        }
    ?>
</body>
</html>