<?php
$database = "monolety";
$servername = "localhost";
$username = "root";
$password = "1234";
//
try {
    // Cria conexão PDO
    $conexao = new PDO("mysql:host=$servername;port=3312;dbname=$database;charset=utf8", $username, $password);
    // Ativa modo de erro
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(["status" => "erro", "message" => "Conexão falhou: " . $e->getMessage()]);
    exit;
}
?>
