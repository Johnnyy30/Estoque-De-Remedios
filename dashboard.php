<?php
include "verify.php";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Controle de Estoque</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
       <aside class="sidebar">
            <div class="user-profile">
                <img src="img/channels4_profile.jpg" alt="Foto do Perfil" class="profile-pic">
                <p class="user-name"><?php echo htmlspecialchars($nome); ?></p>
                <p class="user-role">Administrador</p>
            </div>
            <nav class="sidebar-nav">
                <a href="viewtable.php">Tabela de Remédios</a>
                <a href="admin.php" class="active">Cadastrar</a>
                <a href="historico.php">Histórico</a> </nav>
            <div class="sidebar-footer">
                <a href="backend/logout.php">Sair</a>
            </div>
        </aside>

<main  class="main-content" >
    <div class="container">
        <div class="table-container">
            <table id="stockTable">
                <thead>
                    <tr>
                        <th>Nome do Remédio</th>
                        <th>Data de Vencimento</th>
                        <th>Lote</th>
                        <th>Quantidade em Estoque</th></tr>
                </thead>
                    <tbody id="stockTableBody">
                        <tr>
                            <td>Paracetamol 750mg</td>
                            <td>2025-12-31</td>
                            <td>A54G8</td>
                            <td contenteditable="true">150</td>
                        </tr>
                        <tr>
                            <td>Dipirona 500mg</td>
                            <td>2026-08-15</td>
                            <td>B22F1</td>
                            <td contenteditable="true">230</td>
                        </tr>
                        <tr>
                            <td>Amoxicilina 500mg</td>
                            <td>2025-05-20</td>
                            <td>C98D5</td>
                            <td contenteditable="true">80</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td><input type="text" id="newMedName" placeholder="Nome do remédio"></td>
                            <td><input type="date" id="newExpDate"></td>
                            <td><input type="text" id="newLote" placeholder="Lote"></td>
                            <td><input type="number" id="newQuantity" placeholder="Qtd."></td>
                            <td><button id="addMedBtn" class="btn-add">Adicionar</button></td>
                        </tr>
                    </tfoot>
                                </table>
                            </div>
                            <div class="actions-footer">
                                <button id="saveChangesBtn" class="btn">Salvar Alterações</button>
                            </div>
                        </div>
                </main>

    <script src="script.js"></script>
</body>
</html>