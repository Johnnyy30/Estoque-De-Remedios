<div class="admin-layout">
        <main class="main-content">            
            <div class="content-body">
                <div class="form-box-admin">
                    <h2>Cadastrar Novo Funcionário</h2>
        
                    <form enctype="multipart/form-data" id="cadastroForm" action="backend/CadastroUsuario.php" method="post">
                        <div class="input-group">
                            <label for="newUserName">Nome Completo</label>
                            <input type="text" placeholder="Nome" required id="nomeCad" name="nome"> 
                        </div>
                        <div class="input-group">
                            <label for="newUserEmail">Email</label>
                            <input type="email" placeholder="E-mail" required id="emailCad" name="email">
                        </div>
                    
                        <div class="input-group">
                            <label for="newUserPassword">Senha</label>
                            <input type="password" placeholder="Senha" required id="senhaCad" name="senha"> 
                        </div>
                       
                        <button id="cadastro_btn" class="btn" type="button">CADASTRAR</button>
                    </form>
                   <script>

    function cadastrar()
    {
      $.post("backend/CadastroUsuario.php", 
              $("#cadastroForm").serialize(),
              function(data){
                  var response = JSON.parse(data);
                  $("#mensagemCadastro").text(response.mensagem);
              }
      )
      .fail(function(xhr, status, error) {
              console.error("Erro: ", error);
            }
      );

    }
    </script>
    <p id="mensagemCadastro"></p>
                </div>
            </div>
        </main>
    </div>
    <script>
        $(document).ready(function(){

    //adiciona evetno ao botão de cadastro
  $("#cadastro_btn").click(function(){
    cadastrar();
  })
})
    </script>