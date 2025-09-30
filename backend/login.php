<?php 

$email = $_REQUEST['email'];
$senha = $_REQUEST['senha'];


include "conexao.php";




$consulta_user = $conexao->prepare("SELECT * from usuario where email = :email LIMIT 1");
$consulta_user->bindParam(":email", $email);

$consulta_user->execute();

$user = $consulta_user->fetch();


if($user){

    if(password_verify($senha, $user['senha'])){
        session_start();
        $_SESSION['email'] = $email;
        $_SESSION['nome'] = $user['nome'];
        $_SESSION['id'] = $user['idUsuario'];
        header("Location: ../viewtable.php");
    }else{
        header("Location: ../index.php?status=1");
        
        
    }

}
else{
    header("Location: ../index.php?status=2");
    
}



?>