<?php
function registrar_log($conexao, $acao) {
    
   
    $nome_usuario = $_SESSION['nome'] ?? 'Sistema'; 
    
    try {
        $sql = "INSERT INTO historico_logs (usuario_nome, acao) VALUES (?, ?)";
        $stmt = $conexao->prepare($sql);
        
        // Apenas executa se a conexão for válida
        if ($stmt) {
             $stmt->execute([$nome_usuario, $acao]);
        }
    } catch (PDOException $e) {
        // Se o log falhar, registra o erro internamente. 
        error_log("Falha ao registrar log: " . $e->getMessage());
    }
}
?>