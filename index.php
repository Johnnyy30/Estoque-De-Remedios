<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Controle de Estoque de Farmácia</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                    <input type="Email" required id="email" name="email" placeholder="Digite seu E-mail de Usuário" >
                </div>
                <div class="input-group">
                    <label for="password">Senha</label>
                    <input type="password" required id="senha" name="senha" placeholder="Digite sua senha" >
                </div>
                <button type="submit" class="btn">LOGAR</button>
            </form>
            
            <div id="msg" style="margin-top: 15px; text-align: center;"></div>

        </div>
    </div>
<script>
    $(document).ready(function() {
        // Intercepta o evento de 'submit' do formulário
        $('#loginForm').on('submit', function(e) {
            
            //Previne o comportamento padrão do formulário
            e.preventDefault();

            var form = $(this);
            var url = form.attr('action');
            var method = form.attr('method');
            var data = form.serialize();

            $('#msg').html(''); // Limpa mensagens

            // 2. Envia a requisição AJAX
            $.ajax({
                type: method,
                url: url,
                data: data,
                dataType: 'json', 
                
                success: function(res) {
                    // 3. Trata a resposta do servidor
                    if (res.status === "ok") {
                        $('#msg').html('<span style="color: green;">' + res.message + '</span>');
                        
                        setTimeout(function() {
                            window.location.href = "viewtable.php";
                        }, 1000); 
                        
                    } else {
                        // Erro (ex: "Usuário ou senha incorretos")
                        $('#msg').html('<span style="color: red;">' + res.message + '</span>');
                    }
                },
                error: function() {
                    // Erro na própria requisição (ex: 404, 500)
                    $('#msg').html('<span style="color: red;">Erro ao conectar com o servidor.</span>');
                }
            });
        });
    });
    </script>
</body>
</html>