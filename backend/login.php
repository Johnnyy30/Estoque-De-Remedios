<?php 
// Verificar no backend se há dados
if($_REQUEST['email'] == "" || $_REQUEST['senha'] == "")
{
    $response = array("status" => "erro", "mensagem" => "Há campos vazios!");
    echo json_encode($response);
    exit;
}

// Dados que vieram do front end
$email = $_REQUEST['email'];
$senha = $_REQUEST['senha'];

include "conexao.php"; // conecta ao banco

// monta consulta preparada pelo email
$consulta_usuario = $conexao->prepare("SELECT * from usuario where email = :email LIMIT 1");
$consulta_usuario->bindParam(':email', $email);


// executa a consulta
$consulta_usuario->execute();

// atribui o registro retornado para $usuario
$usuario = $consulta_usuario->fetch();

$response = "";

// Se o email existe verifica a senha
if($usuario)
{
    // verifica senha com password_verify
    if(password_verify($senha, $usuario['senha']))
    {
        session_start();
        $_SESSION['email'] = $email;
        $_SESSION['nome'] = $usuario['nome'];
        $_SESSION['id'] = $usuario['idUsuario'];
        $_SESSION['tipo'] = $usuario['tipo'];
        
        // redirecionamento conforme o tipo de usuário
       if($usuario['tipo'] != 2)
            $response = array("status" => "redirect", "url" => "homeCliente.php");
        else
            $response = array("status" => "redirect", "url" => "homeAdmin.php");
    }
    else    
        $response = array("status" => "erro", "mensagem" => "Senha incorreta!");
}
else
    $response = array("status" => "erro", "mensagem" => "Não existe usuário cadastrado com este e-mail");

echo json_encode($response);
?>
