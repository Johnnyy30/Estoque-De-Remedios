<?php
include "backend/verify.php";
include "backend/conexao.php"; 
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Controle de Estoque</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
       <aside class="sidebar">
            <div class="user-profile">
                <img src="<?php echo $path; ?>" alt="Foto do Perfil" class="profile-pic">
                <p class="user-name"><?php echo htmlspecialchars($nome); ?></p>
                <p class="user-role">Administrador</p>
            </div>
            <nav class="sidebar-nav">
                <a href="viewtable.php">Tabela de Remédios</a>
                <a href="admin.php">Cadastrar</a>
                <a href="historico.php">Histórico</a> </nav>
            <div class="sidebar-footer">
                <a href="backend/logout.php">Sair</a>
            </div>
        </aside>

<main class="main-content">
    <div class="container">
        <div id="msg" style="text-align: center; padding: 10px;"></div>

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
                        
                        $sql = "SELECT id, nome, data_vencimento, lote, quantidade FROM remedios ORDER BY nome ASC";
                        $stmt = $conexao->prepare($sql);
                        $stmt->execute();
                        $remedios = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        if (count($remedios) > 0) {
                            foreach ($remedios as $row) {
                                echo "<tr data-id='" . htmlspecialchars($row['id']) . "'>";
                                echo "<td>" . htmlspecialchars($row['nome']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['data_vencimento']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['lote']) . "</td>";
                                
                               
                                $qtd_remedio = htmlspecialchars($row['quantidade']);
                                echo "<td contenteditable='true' class='editable-qty' data-original-qty='{$qtd_remedio}'>" . $qtd_remedio . "</td>";
                               

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

<script>
$(document).ready(function() {

    // --- FUNÇÃO 1 (Adicionar) ---
    $('#addMedBtn').on('click', function() {
        var nome = $('#newMedName').val();
        var data = $('#newExpDate').val();
        var lote = $('#newLote').val();
        var qtd = $('#newQuantity').val();

        if (!nome || !data || !lote || !qtd) {
            $('#msg').html('<span style="color: red;">Preencha todos os campos para adicionar.</span>');
            return;
        }

        $.ajax({
            url: 'backend/add_remedios.php',
            type: 'POST',
            data: { nome: nome, data_vencimento: data, lote: lote, quantidade: qtd },
            dataType: 'json',
            success: function(res) {
                if (res.status === 'ok') {
                    $('#msg').html('<span style="color: green;">' + res.message + '</span>');
                    
                    var newRow = "<tr data-id='" + res.new_id + "'>" +
                                 "<td>" + nome + "</td>" +
                                 "<td>" + data + "</td>" +
                                 "<td>" + lote + "</td>" +
                                 "<td contenteditable='true' class='editable-qty' data-original-qty='" + qtd + "'>" + qtd + "</td>" +
                                 "</tr>";
                    
                    if ($('#stockTableBody').find('td[colspan="4"]').length > 0) {
                        $('#stockTableBody').html(newRow);
                    } else {
                        $('#stockTableBody').append(newRow);
                    }
                    $('#newMedName, #newExpDate, #newLote, #newQuantity').val('');
                } else {
                    $('#msg').html('<span style="color: red;">' + res.message + '</span>');
                }
            },
            error: function() {
                $('#msg').html('<span style="color: red;">Erro ao conectar com o servidor (adicionar).</span>');
            }
        });
    });

    // --- FUNÇÃO 2 (Salvar) ---
    $('#saveChangesBtn').on('click', function() {
        var changes = []; 
        
        $('#stockTableBody tr').each(function() {
            var $row = $(this);
            if ($row.data('id')) { 
                var id = $row.data('id');
                var $qtyCell = $row.find('.editable-qty');
                
                var qty = $qtyCell.text().trim(); 
                var old_qty = $qtyCell.data('original-qty');
                
                if (qty != old_qty) {
                    changes.push({ id: id, qty: qty });
                }
            }
        });

        if (changes.length === 0) {
            $('#msg').html('<span style="color: blue;">Nenhuma alteração para salvar.</span>');
            return;
        }

        $.ajax({
            url: 'backend/updade_remedios.php',
            type: 'POST',
            contentType: 'application/json', 
            data: JSON.stringify({ changes: changes }), 
            dataType: 'json',
            success: function(res) {
                
                
                if (res.status === 'ok') {
                    $('#msg').html('<span style="color: green;">' + res.message + '</span>');
                
                    changes.forEach(function(change) {
                        $('#stockTableBody tr[data-id="' + change.id + '"]').find('.editable-qty').data('original-qty', change.qty);
                    });
                } else {
                    $('#msg').html('<span style="color: red;">' + res.message + '</span>');
                }
            
            },
            error: function() {
                $('#msg').html('<span style="color: red;">Erro ao conectar com o servidor (salvar).</span>');
            }
        });
    });

});
</script>

</body>
</html>