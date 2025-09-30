<?php
$nome = $_REQUEST['nome'];
$email = $_REQUEST['email'];
$senha = $_REQUEST['senha'];

$senhaCript = password_hash($senha, PASSWORD_DEFAULT);

include "conexao.php";



try{
    
    $consulta_cadastro = $conexao->prepare("INSERT INTO usuario(nome, email, senha) VALUES (:nome, :email, :senha);");
    $consulta_cadastro->bindParam(":email", $email);
    $consulta_cadastro->bindParam(":nome", $nome);
    $consulta_cadastro->bindParam(":senha", $senhaCript);

    $consulta_cadastro->execute();

    header("Location: ../admin.php?status=3");
}
catch(PDOException $e){

    header("Location: ../admin.php?status=4");

}

?>