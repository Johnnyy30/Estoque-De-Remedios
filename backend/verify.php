<?php
session_start();

// 1. Verifica se a sessão de 'email' existe
if( empty($_SESSION['email']) ){
  header("Location: index.php");
  exit; 
}

$nome = $_SESSION['nome'];

$path_da_sessao = $_SESSION['foto'] ?? null; 

if (empty($path_da_sessao)) {
    // Se o usuário NÃO tiver foto, usa a foto padrão
    $path = "img/channels4_profile.jpg"; 
} else {
    // Se ele TIVER foto, usa o caminho EXATAMENTE como veio da sessão
    $path = $path_da_sessao; 
}
?>