<?php 
try{
    // Usando a extensão PDO para criar uma conexão com o banco
    // Caminho relativo para o banco de dados SQLite (dois níveis acima)
    $dbPathRelativo = '../../armazenamento/Banco_comSQLite/banco.db';
    
    // Caminho completo usando __DIR__ que retorna a localização do arquivo atual
    $bdPath = __DIR__ . '/' . $dbPathRelativo;
    // instância do PDO com o caminho final
    $db = new PDO('sqlite:' . $bdPath);
    
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e){
    echo "Erro na conexão com o banco de dados." . $e->getMessage();
}
?>