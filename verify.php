<?php
session_start();



if(!isset($_SESSION['email']) || !$_SESSION['email'] != ""){
  header("Location: index.php");
}

$nome = $_SESSION['nome']

?>