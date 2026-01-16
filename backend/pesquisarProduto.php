<?php

include "conexao.php"; 

$nome = $_REQUEST["nome"] ?? "";

try {
    $consulta_produtos = $conexao->prepare("SELECT * FROM remedios WHERE nome LIKE :nome");

    $termo = "%".$nome."%";
    $consulta_produtos->bindParam(':nome', $termo);
    $consulta_produtos->execute();

    $produtos = array();

    while ($produto = $consulta_produtos->fetch(PDO::FETCH_ASSOC)) {
        $produtos[] = $produto; 
    }

    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($produtos, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

} catch (PDOException $e) {
    header('Content-Type: application/json', true, 500);
    echo json_encode(["erro" => $e->getMessage()]);
}
?>