<?php
session_start();

if( empty($_SESSION['email']) ){
  header("Location: index.php");
  exit; 
}

$email = $_SESSION['email'];
$nome = $_SESSION['nome'];
$tipo = $_SESSION['tipo'];
