<?php
include "verify.php";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administração - Controle de Estoque</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="admin-layout">
        <aside class="sidebar">
            <div class="user-profile">
                <img src="img/channels4_profile.jpg" alt="Foto do Perfil" class="profile-pic">
                <p class="user-name"><?php echo htmlspecialchars($nome); ?></p>
                <p class="user-role">Administrador</p>
            </div>
            <nav class="sidebar-nav">
                <a href="viewtable.php">Tabela de Remédios</a>
                <a href="dashboard.php">Controle de Estoque</a>
                <a href="historico.php">Histórico</a> </nav>
            <div class="sidebar-footer">
                <a href="backend/logout.php">Sair</a>
            </div>
        </aside>
        
        <main class="main-content">            
            <div class="content-body">
                <div class="form-box-admin">
                    <h2>Cadastrar Novo Funcionário</h2>
                    <form id="newUserForm" action="backend/CadastroUsuario.php" >
                        <div class="input-group">
                            <label for="newUserName">Nome Completo</label>
                            <input type="text" id="newUserName" name="nome" required>
                        </div>
                        <div class="input-group">
                            <label for="newUserEmail">Email</label>
                            <input type="email" id="newUserEmail" name="email" required>
                        </div>
                        <div class="input-group">
                            <label for="newUserRole">Cargo</label>
                            <select id="newUserRole" required>
                                <option value="" disabled selected>Selecione um cargo</option>
                                <option value="Administrador">Administrador</option>
                                <option value="Farmacêutico">Farmacêutico</option>
                                <option value="Atendente">Atendente</option>
                            </select>
                        </div>
                        <div class="input-group">
                            <label for="newUserPassword">Senha</label>
                            <input type="password" id="newUserPassword" name="senha" required>
                        </div>
                        <button type="submit" class="btn">Cadastrar Funcionário</button>
                <?php
                if (isset($_GET['status'])){
                    $status =  $_GET['status'];
                    if($status == 3){
                        echo "Cadastro realizado com sucesso!";
                    }
    
                    if($status == 4){
                        echo "Houve uma falha no cadastro!";
                    }
                }
                ?>
                    </form>
                </div>
            </div>
        </main>
    </div>
    <script src="script.js"></script>
</body>
</html>