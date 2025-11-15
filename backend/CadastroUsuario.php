<?php

header('Content-Type: application/json');
session_start();

include('conexao.php');
include('log_helper.php'); 

// --- 1. DEFINIÇÕES E DADOS DO FORMULÁRIO ---
$nome  = $_POST['usuario'] ?? '';
$email = $_POST['email'] ?? '';
$senha = $_POST['password'] ?? '';

// --- 2. VALIDAÇÃO DOS CAMPOS DE TEXTO ---

if (empty($nome) || empty($email) || empty($senha)) {
    echo json_encode(["status" => "erro", "message" => "Preencha todos os campos obrigatórios."]);
    exit;
}

$path = null;       
$pathParaDB = null; 


if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
    
    // --- 3. VALIDAÇÃO E SALVAMENTO DA IMAGEM ---
    $arquivo = $_FILES['foto'];
    $pasta = "../img/";
    $nomeImg = basename($arquivo['name']);
    $novoNome = uniqid();
    

    $extencao = strtolower(pathinfo($nomeImg, PATHINFO_EXTENSION));
   
    $path = $pasta . $novoNome . "." . $extencao; 
    
    
    // Cria o caminho para salvar no banco
    $pathParaDB = "img/" . $novoNome . "." . $extencao; 
  

    $allowedTypes = ['jpg', 'jpeg', 'png'];
    if (!in_array($extencao, $allowedTypes)) { 
        echo json_encode(["status" => "erro", "message" => "Formato de imagem inválido. Use JPG ou PNG."]);
        exit;
    }

    if (!move_uploaded_file($arquivo['tmp_name'], $path)) { 
        echo json_encode(["status" => "erro", "message" => "Erro ao salvar a imagem."]);
        exit;
    }
}

// --- 4. LÓGICA DO BANCO DE DADOS ---
try {
    // Verifica se o e-mail já existe
    $sql = "SELECT * FROM usuario WHERE email = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->execute([$email]); 
    $user = $stmt->fetch(); 

    if ($user) {
        
        if ($path && file_exists($path)) {
            unlink($path);
        }
        echo json_encode(["status" => "erro", "message" => "Este e-mail já foi cadastrado."]);
        exit;
    }

    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuario (nome, email, senha, foto_path) VALUES (?, ?, ?, ?)";
    $stmt = $conexao->prepare($sql);
    

    if ($stmt->execute([$nome, $email, $senhaHash, $pathParaDB])) {

       
        $acao = "Cadastrou o novo funcionário '{$nome}'.";
        registrar_log($conexao, $acao);
        
        echo json_encode(["status" => "ok", "message" => "Cadastro realizado com sucesso!"]);
    } else {
        echo json_encode(["status" => "erro", "message" => "Erro ao cadastrar usuário."]);
    }

} catch (PDOException $e) {
   
    if ($path && file_exists($path)) {
        unlink($path);
    }
    echo json_encode(["status" => "erro", "message" => "Erro no banco de dados: " . $e->getMessage()]);
    exit;
}
?>