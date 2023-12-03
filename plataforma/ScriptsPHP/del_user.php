<?php
include_once "./conexao.php";

//Variáveis
//Usando htmlspecialchars(strip_tags()) para evitar XSS
$CPF = htmlspecialchars(strip_tags($_POST['cpf'])) ?? '';

$matricula = htmlspecialchars(strip_tags($_POST['matricula'])) ?? '';
if(isset($_POST['del'])) {
    if($matricula != ''){
        try{
            //Comando para deletar o usuário de acordo com a matricula
            //Usando bindParam() para evitar SQLINJECTION
            $query = $db->prepare("DELETE from usuario WHERE matricula = :matricula");
            $query->bindParam(':matricula', $matricula, PDO::PARAM_STR); 
            $result = $query->execute();

            $query2 = $db->prepare("DELETE from logs WHERE CPF = :cpf");
            $query2->bindParam(':cpf', $CPF, PDO::PARAM_STR); 
            $result2 = $query2->execute();

            //Comando para deletar a foto do usuário
            unlink("../../armazenamento/fotos/$matricula.png");

            header('Location: ../PaginasPHP/edit_user.php?ADD=DEL');
        } catch (PDOException $e) { //Tratamento de ERRO
            echo "Erro: " . $e->getMessage();
            header('Location: ../PaginasPHP/edit_user.php?ADD=Erro');
        }
    }
    else{ //Tratamento de ERRO
        header('Location: ../PaginasPHP/edit_user.php?ADD=Erro');
        die("Error");
    }
}


?>
