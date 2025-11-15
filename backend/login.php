<?php

header('Content-Type: application/json');

include('conexao.php'); 
session_start();

$email = $_POST['email'] ?? ''; 
$senha  = $_POST['senha'] ?? ''; 

if (empty($email) || empty($senha)) {
    echo json_encode(["status" => "erro", "message" => "Preencha usuário e senha."]);
    exit;
}

try {
    $sql = "SELECT * FROM usuario WHERE email = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($senha, $user['senha'])) {
        
        session_unset(); 
        
        $_SESSION['email'] = $user['email']; 
        $_SESSION['nome'] = $user['nome']; 
        
      
        // Salva o nome do arquivo da foto 
        $_SESSION['foto'] = $user['foto_path']; 
       
        
        echo json_encode(["status" => "ok", "message" => "Login realizado com sucesso!"]);
    
    } else {
        echo json_encode(["status" => "erro", "message" => "Usuario ou senha incorreta"]);
    }

} catch (PDOException $e) {
    echo json_encode(["status" => "erro", "message" => "Erro no banco de dados: " . $e->getMessage()]);
    exit;
}
?>