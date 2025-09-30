<?php 
$database = "monolety";
$servername = "localhost";
$username= "root";
$password = "Joaopc35.";

try{

    $conexao = new PDO("mysql:host=$servername; dbname=$database", $username, $password);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Conexão estabelecida com sucesso";

} catch(PDOException $e) {

    echo "Conexão falhou: ".$e->getMessage();

}

?>
                