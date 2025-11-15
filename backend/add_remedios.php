<?php

header('Content-Type: application/json');
session_start();

include('conexao.php'); 
include('log_helper.php');

// 1. Pega os dados enviados pelo AJAX
$nome     = $_POST['nome'] ?? '';
$data     = $_POST['data_vencimento'] ?? '';
$lote     = $_POST['lote'] ?? '';
$qtd      = $_POST['quantidade'] ?? '';

// 2. Validação do backend
if (empty($nome) || empty($data) || empty($lote) || empty($qtd)) {
    echo json_encode(['status' => 'erro', 'message' => 'Todos os campos são obrigatórios.']);
    exit;
}
if (!is_numeric($qtd) || $qtd < 0) {
    echo json_encode(['status' => 'erro', 'message' => 'Quantidade inválida.']);
    exit;
}

// 3. Insere no banco de dados
try {
    $sql = "INSERT INTO remedios (nome, data_vencimento, lote, quantidade) VALUES (?, ?, ?, ?)";
    $stmt = $conexao->prepare($sql);
    
    if ($stmt->execute([$nome, $data, $lote, $qtd])) {
        // Pega o ID do remédio inserido
        $newId = $conexao->lastInsertId();

        // Registra o log
        $acao = "Adicionou o novo item '{$nome}' ({$qtd} unidades) ao estoque.";
        registrar_log($conexao, $acao);
      
        
        // Envia resposta de sucesso + o novo ID
        echo json_encode(['status' => 'ok', 'message' => 'Remédio adicionado com sucesso!', 'new_id' => $newId]);
    } else {
        echo json_encode(['status' => 'erro', 'message' => 'Erro ao salvar no banco.']);
    }

} catch (PDOException $e) {
    echo json_encode(['status' => 'erro', 'message' => 'Erro no banco: ' . $e->getMessage()]);
    exit;
}
?>