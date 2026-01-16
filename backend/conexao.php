<?php
$database = "monolety";
$servername = "127.0.0.1"; 
$username = "root";
$password = "kali";

try {
    // Cria conexão PDO
    $conexao = new PDO("mysql:host=$servername;dbname=$database;charset=utf8", $username, $password);
    
   
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){ 
    echo "Conexão falhou: " . $e->getMessage(); 
}
?>