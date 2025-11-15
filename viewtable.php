<?php
include "backend/verify.php";
include "backend/conexao.php"; 
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View table</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <script src="script.js"></script>
<body>
<aside class="sidebar">
            <div class="user-profile">
                <img src="<?php echo $path; ?>" alt="Foto do Perfil" class="profile-pic">
                <p class="user-name"><?php echo htmlspecialchars($nome); ?></p>
                <p class="user-role">Administrador</p>
            </div>
            <nav class="sidebar-nav">
                <a href="dashboard.php">Controle de Estoque</a>
                <a href="admin.php">Cadastrar</a>
                <a href="historico.php">Histórico</a> </nav>
            <div class="sidebar-footer">
                <a href="backend/logout.php">Sair</a>
            </div>
        </aside>
        
  <main class="main-content">
    <div class="container">
        <div class="table-container">
            <table id="stockTable">
                <thead>
                    <tr>
                        <th>Nome do Remédio</th>
                        <th>Data de Vencimento</th>
                        <th>Lote</th>
                        <th>Quantidade em Estoque</th>
                    </tr>
                </thead>
                
                <tbody id="stockTableBody">
                    <?php
                    try {
                        $sql = "SELECT nome, data_vencimento, lote, quantidade FROM remedios ORDER BY nome ASC";
                        $stmt = $conexao->prepare($sql);
                        $stmt->execute();
                        
                        $remedios = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        if (count($remedios) > 0) {
                            foreach ($remedios as $row) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($row['nome']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['data_vencimento']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['lote']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['quantidade']) . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4'>Nenhum remédio cadastrado.</td></tr>";
                        }
                    } catch (PDOException $e) {
                        echo "<tr><td colspan='4' style='color: red;'>Erro ao carregar dados: " . $e->getMessage() . "</td></tr>";
                    }
                    ?>
                </tbody>
                          
            </table>
        </div>
    </div>
  </main>
    
</body>
</html>