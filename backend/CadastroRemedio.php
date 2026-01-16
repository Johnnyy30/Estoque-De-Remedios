<?php
include "conexao.php";

header('Content-Type: application/json');


if(empty($_REQUEST['nome']) || empty($_REQUEST['data_vencimento']) || empty($_REQUEST['lote']) || empty($_REQUEST['quantidade'])) {
    echo json_encode([
        "status" => "erro",
        "mensagem" => "Preencha todos os campos para adicionar."
    ]);
    exit;
}

$nome = $_REQUEST['nome'];
$datav = $_REQUEST['data_vencimento']; 
$lote = $_REQUEST['lote'];
$quantidade = $_REQUEST['quantidade'];

try {
  
    $consulta_cadastro = $conexao->prepare("
        INSERT INTO remedios(nome, data_vencimento, lote, quantidade)
        VALUES (:nome, :datav, :lote, :quantidade)
    ");

    $consulta_cadastro->bindParam(':nome', $nome);
    $consulta_cadastro->bindParam(':datav', $datav);
    $consulta_cadastro->bindParam(':lote', $lote);
    $consulta_cadastro->bindParam(':quantidade', $quantidade);

    $consulta_cadastro->execute();

    echo json_encode(["status" => "ok", "mensagem" => "Produto cadastrado com sucesso!"]);

} catch(PDOException $e) { 
    echo json_encode(["status" => "erro", "mensagem" => "Erro no banco: " . $e->getMessage()]);
}
?>