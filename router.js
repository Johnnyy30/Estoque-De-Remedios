// router.js
$(document).ready(function () {
    function loadPage(page) {
      const content = $('#main');
      
        content.load("components/"+page+".php", function (response, status) {
          if (status === "success") {
          } else {
            content.html('<div class="alert alert-danger">Página não encontrada.</div>').fadeIn(200);
          }
      });
    }
  
    // Carrega página inicial (opcional, por padrão "home")
    loadPage('home');
  
    // Captura cliques nos itens do menu com data-page
    $('[data-page]').on('click', function (e) {
      e.preventDefault();
      const page = $(this).data('page');
      loadPage(page);
      
    });

  });
  
  