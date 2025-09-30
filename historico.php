<?php
include "verify.php";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histórico - Controle de Estoque</title>
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
                <a href="dashboard.php">Controle de Estoque</a>
                <a href="admin.php" class="active">Cadastrar</a>
                <a href="viewtable.php">Tabela de Remédios</a> </nav>
            <div class="sidebar-footer">
                <a href="backend/logout.php">Sair</a>
            </div>
        </aside>

        <main class="main-content">
            <header class="content-header">
                <h1>Histórico de Atividades</h1>
            </header>
            
            <div class="content-body">
                <div class="history-log">
                    <div class="log-item">
                        <p class="log-description"><strong>Ana Oliveira</strong> cadastrou o novo funcionário <strong>"Carlos Souza"</strong>.</p>
                        <p class="log-timestamp">29/09/2025 - 10:32</p>
                    </div>
                    <div class="log-item">
                        <p class="log-description">O item <strong>"Loratadina 10mg"</strong> foi removido do estoque.</p>
                        <p class="log-timestamp">28/09/2025 - 17:15</p>
                    </div>
                    <div class="log-item">
                        <p class="log-description">A quantidade do item <strong>"Dipirona 500mg"</strong> foi alterada de <strong>230</strong> para <strong>210</strong>.</p>
                        <p class="log-timestamp">28/09/2025 - 16:58</p>
                    </div>
                     <div class="log-item">
                        <p class="log-description">O novo item <strong>"Nimesulida 100mg"</strong> foi adicionado ao estoque com <strong>120</strong> unidades.</p>
                        <p class="log-timestamp">27/09/2025 - 11:21</p>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script src="script.js"></script>
</body>
</html>