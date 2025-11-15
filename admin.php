<?php
include "backend/verify.php";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administração - Controle de Estoque</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                <a href="viewtable.php">Tabela de Remédios</a>
                <a href="dashboard.php">Controle de Estoque</a>
                <a href="historico.php">Histórico</a> 
            </nav>
            <div class="sidebar-footer">
                <a href="backend/logout.php">Sair</a>
            </div>
        </aside>
        
        <main class="main-content">            
            <div class="content-body">
                <div class="form-box-admin">
                    <h2>Cadastrar Novo Funcionário</h2>
                    
                    <form enctype="multipart/form-data" id="newUserForm" action="backend/CadastroUsuario.php" method="post">
                        <div class="input-group">
                            <label for="newUserName">Nome Completo (Login)</label>
                            <input type="text" id="usuario" name="usuario" required> 
                        </div>
                        <div class="input-group">
                            <label for="newUserEmail">Email</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                        <!--
                        <div class="input-group">
                            <label for="newUserRole">Cargo</label>
                            <select id="newUserRole" name="cargo" required> 
                                <option value="" disabled selected>Selecione um cargo</option>
                                <option value="Administrador">Administrador</option>
                                <option value="Farmacêutico">Farmacêutico</option>
                                <option value="Atendente">Atendente</option>
                            </select>
                        </div>
                        -->
                        <div class="input-group">
                            <label for="newUserPassword">Senha</label>
                            <input type="password" id="password" name="password" required> 
                        </div>

                        <div class="input-group">
                            <label for="foto">Foto de Perfil (Opcional)</label>
                            <input type="file" id="foto" name="foto" accept="image/png, image/jpeg, image/gif">
                        </div>
                        <button class="btn" type="submit">CADASTRAR</button>
                    </form>
                    <div id="msg" style="margin-top: 15px; text-align: center;"></div>
                </div>
            </div>
        </main>
    </div>

    <script>
    $(document).ready(function() {
        $('#newUserForm').on('submit', function(e) {
            e.preventDefault();
            var form = $(this);
            var url = form.attr('action');
            var method = form.attr('method');
            var data = new FormData(this); 

            $('#msg').html(''); 

            $.ajax({
                type: method,
                url: url,
                data: data,
                contentType: false, 
                processData: false, 
                dataType: 'json',   
                
                success: function(res) {
                    if (res.status === "ok") {
                        $('#msg').html('<span style="color: green;">' + res.message + '</span>');
                        form[0].reset(); 
                    } else {
                        $('#msg').html('<span style="color: red;">' + res.message + '</span>');
                    }
                },
                error: function() {
                    $('#msg').html('<span style="color: red;">Erro ao conectar com o servidor.</span>');
                }
            });
        });
    });
    </script>
</body>
</html>