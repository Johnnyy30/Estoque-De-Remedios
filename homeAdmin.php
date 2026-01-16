<?php
include "backend/verify.php";

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View table</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="router.js"></script>
<style>
  .main-content {
    margin-left: 250px; 
    padding: 20px;
}
</style>

<body>
 <aside class="sidebar">
         <div class="user-profile">
                <p class="user-name"><?php echo htmlspecialchars($nome); ?></p>
                <p class="user-role">Administrador</p>
            </div>
            <nav class="sidebar-nav">
    <?php include "parts/menuAdmin.php" ?></nav>
    <div class="sidebar-footer">
                <a href="backend/logout.php">Sair</a>
            </div>
    </aside>
    <div id="main" class="main-content">
    
    </div>
    
</body>
</html>