<?php
include "backend/verify.php";
include "backend/conexao.php"; 
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
                <img src="<?php echo $path; ?>" alt="Foto do Perfil" class="profile-pic">
                <p class="user-name"><?php echo htmlspecialchars($nome); ?></p>
                <p class="user-role">Administrador</p>
            </div>
            <nav class="sidebar-nav">
                <a href="dashboard.php">Controle de Estoque</a>
                <a href="admin.php">Cadastrar</a>
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
                    
                    <?php
                   
                    try {
                        // Busca os logs, formatando a data, e ordena do mais novo para o mais antigo
                        $sql = "SELECT usuario_nome, acao, 
                                       DATE_FORMAT(data_acao, '%d/%m/%Y - %H:%i') AS data_formatada
                                FROM historico_logs 
                                ORDER BY data_acao DESC";
                        
                        $stmt = $conexao->prepare($sql);
                        $stmt->execute();
                        $logs = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        if (count($logs) > 0) {
                            // Loop para imprimir cada item do log
                            foreach ($logs as $log) {
                                echo '<div class="log-item">';
                                echo '  <p class="log-description"><strong>' . htmlspecialchars($log['usuario_nome']) . '</strong> ' . htmlspecialchars($log['acao']) . '</p>';
                                echo '  <p class="log-timestamp">' . $log['data_formatada'] . '</p>';
                                echo '</div>';
                            }
                        } else {
                            echo '<div class="log-item"><p class="log-description">Nenhuma atividade registrada ainda.</p></div>';
                        }
                    } catch (PDOException $e) {
                         echo '<div class="log-item"><p class="log-description" style="color: red;">Erro ao carregar histórico: ' . $e->getMessage() . '</p></div>';
                    }
                    ?>
                    
                </div>
            </div>
        </main>
    </div>

    <script src="script.js"></script>
</body>
</html>