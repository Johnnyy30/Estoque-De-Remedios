<main class="main-content">
    <div class="container">

        <div id="msg" style="text-align: center; padding: 10px;"></div>

        <div class="form-box-admin">
            <h1 class="w3-text-teal">Cadastro de Produto</h1>

            <form id="cadastroRemedioForm" class="w3-container w3-card-4">

                <div class="input-group">
                    <label>Nome</label>
                    <input type="text" id="nome" name="nome" required>
                </div>

                <div class="input-group">
                    <label>Data</label>
                    <input type="date" id="data" name="data" required>
                </div>

                <div class="input-group">
                    <label>Lote</label>
                    <input type="text" id="lote" name="lote" required>
                </div>

                <div class="input-group">
                    <label>Quantidade</label>
                    <input type="number" id="quantidade" name="quantidade" required>
                </div>

                <button type="button" id="cadastro_remedio_btn" class="btn">Cadastrar</button>

            </form>
        </div>
    </div>
</main>
<script type="module">

import { ProdutoCrud } from "./js/ProdutoCrud.js";

const produtoCrud = new ProdutoCrud({

    entityName: "produto",
    rowIdPrefix: "tr",

    selectors: {
        // FORMULÁRIO DE CADASTRO
        createForm: "#cadastroRemedioForm",
        createButton: "#cadastro_remedio_btn",
        createFields: {
            nome: "#nome",
            data: "#data",
            lote: "#lote",
            quantidade: "#quantidade"
        }
    },

    urls: {
        create: "backend/CadastroRemedio.php"
    }
});

produtoCrud.init();

</script>