<?php
// Verifica se foi passado o parâmetro "status"
$status = $_REQUEST["status"] ?? null;
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Controle de Estoque de Farmácia</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container login-container">
        <div class="form-box">
            <header>
                <h1>Controle de Estoque</h1>
                <p>Faça login para continuar</p>
            </header>
            <form id="loginForm" action="backend/login.php" method="post">
                <div class="input-group">
                    <label for="username">Usuário</label>
                    <input type="Email" id="username" name="email" placeholder="Digite seu E-mail de Usuário" required>
                </div>
                <div class="input-group">
                    <label for="password">Senha</label>
                    <input type="password" id="password" name="senha" placeholder="Digite sua senha" required>
                </div>
                <button type="submit" class="btn">Entrar</button>
            </form>

            <!-- Exibe mensagens de erro de login -->
            <?php if ($status == 1): ?>
                <p style="color:red;">Senha incorreta!</p>
            <?php elseif ($status == 2): ?>
                <p style="color:red;">Não existe usuário cadastrado com este nome</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
