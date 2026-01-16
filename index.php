<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Controle de Estoque de Farmácia</title>
    <link rel="stylesheet" href="style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
    <div class="container login-container" id="login">
        <div class="form-box">
            <header>
                <h1>Controle de Estoque</h1>
                <p>Faça login para continuar</p>
            </header>
            
            <!-- Formulário de login -->
            <form id="loginForm">
            <div class="input-group">
                    <label for="username">Usuário</label>
            <input class="w3-input w3-padding-16 w3-border" type="email" placeholder="E-mail" required id="emailLogin" name="email"></div>
      <div class="input-group">
        <label for="password">Senha</label>
        <input type="password" placeholder="Senha" required id="senhaLogin" name="senha"></div>
      <p><button id="login_btn" class="btn" type="button">LOGAR</button></p>
    </form>
          <script>
            function login()
            {
              $.post("backend/login.php",

              $("#loginForm").serialize(),

              function(data){

              var $response = JSON.parse(data);

              if($response.status == "redirect")
                  window.location.href = $response.url;

              else
                  $("#mensagemLogin").text($response.mensagem);
              })
            }
          </script>

    <p id="mensagemLogin"></p>
           
        </div>
    </div>
<script>
  $(document).ready(function(){

  //adiciona evento ao botão de login
  $("#login_btn").click(function(){
    login();
  });
})
</script>
</body>
</html>
