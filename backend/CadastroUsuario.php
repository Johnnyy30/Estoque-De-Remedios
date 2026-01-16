<?php

// --- 1. VALIDAÇÃO DOS CAMPOS DE TEXTO ---
if($_REQUEST['nome'] == "" || $_REQUEST['email'] == "" || $_REQUEST['senha'] == "")
{
    echo "Há campos vazios!";
    exit;
}

include('conexao.php');

// --- 2. DEFINIÇÕES E DADOS DO FORMULÁRIO ---
$nome = $_REQUEST['nome'];
$email = $_REQUEST['email'];
$senha = $_REQUEST['senha'];

//criptografia da senha
$senhaCripto = password_hash($senha, PASSWORD_DEFAULT);

/*   ### CODIGO PARA COLOCAR IMAGEM. ps: tem que adaptar pra funcionar
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
}*/

// --- 4. LÓGICA DO BANCO DE DADOS ---
try
{
    //monta consulta preparada para inserir usuário
    $consulta_cadastro = $conexao->prepare("INSERT INTO usuario(nome, email, senha) VALUES (:nome, :email, :senhaCripto)");
    $consulta_cadastro->bindParam(':nome', $nome);
    $consulta_cadastro->bindParam(':email', $email);
    $consulta_cadastro->bindParam(':senhaCripto', $senhaCripto);
    
    //executa a consulta
    $consulta_cadastro->execute();

    //sucesso
    $response = array("status" => "erro", "mensagem" => "Usuário cadastrado com sucesso!");
    echo json_encode($response);

}catch(PDOException $e)
{ 
    if($e->errorInfo[1] == 1062)
        $response = array("status" => "erro", "mensagem" => "Já existe usuário com este e-mail");
    else
        $response = array("status" => "erro", "mensagem" => "Não foi possível cadastrar!");

    echo json_encode($response);
}
?>