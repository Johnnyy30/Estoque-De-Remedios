<?php
header('Content-Type: application/json');
session_start();

include('conexao.php'); 
include('log_helper.php'); // Inclui nosso ajudante de log

$data = json_decode(file_get_contents('php://input'), true);
$changes = $data['changes'] ?? [];

if (empty($changes)) {
    // ... (erro) ...
}

$log_messages = [];

try {
    $conexao->beginTransaction();
    
    $sqlUpdate = "UPDATE remedios SET quantidade = ? WHERE id = ?";
    $stmtUpdate = $conexao->prepare($sqlUpdate);

    // Precisamos saber o nome e a qtd antiga para o log
    $sqlSelect = "SELECT nome, quantidade FROM remedios WHERE id = ?";
    $stmtSelect = $conexao->prepare($sqlSelect);

    foreach ($changes as $change) {
        $id = $change['id'];
        $qty = $change['qty'];
        
        if (!is_numeric($qty) || $qty < 0) {
            throw new Exception("Quantidade inválida para o item ID $id.");
        }
        
        // 1. Busca os dados antigos para o log
        $stmtSelect->execute([$id]);
        $item = $stmtSelect->fetch(PDO::FETCH_ASSOC);
        $old_qty = $item['quantidade'];
        $nome = $item['nome'];

        // 2. Só registra e atualiza se a quantidade realmente mudou
        if ($old_qty != $qty) {
            // Executa o update
            $stmtUpdate->execute([$qty, $id]);
            
            // Salva a mensagem de log
            $log_messages[] = "Alterou a quantidade de '{$nome}' de {$old_qty} para {$qty}.";
        }
    }
    
    $conexao->commit();
    
    // REGISTRA OS LOGS 

    foreach ($log_messages as $acao) {
        registrar_log($conexao, $acao);
    }
    
    echo json_encode(['status' => 'ok', 'message' => 'Alterações salvas com sucesso!']);

} catch (Exception $e) {
    $conexao->rollBack();
    echo json_encode(['status' => 'erro', 'message' => 'Erro ao salvar: ' . $e->getMessage()]);
    exit;
}
?>