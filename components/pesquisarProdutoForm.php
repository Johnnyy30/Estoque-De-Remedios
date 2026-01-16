<h1 class="w3-text-teal">Pesquisar Remédio</h1>
<div class="container">
    <form id="pesquisarProdutoForm" class="w3-container w3-card-4 w3-padding">
        <div class="input-group">
            <label>Nome do Remédio</label>
            <input class="w3-input" id="nome_pesquisa" name="nome" type="text" required>
        </div>
        <p>
            <button type="button" id="pesquisar_produto_btn" class="btn">
                Pesquisar
            </button>
        </p>
    </form>

    <table class="w3-table-all w3-hoverable" id="tabela-produtos" style="margin-top:20px;">
        <thead>
            <tr class="w3-black">
                <th>ID</th>
                <th>Nome</th>
                <th>Vencimento</th>
                <th>Lote</th>
                <th>Qtd.</th>
            </tr>
        </thead>
        <tbody>
            </tbody>
    </table>
</div>

<script>
document.addEventListener("click", function (event) {
    if (event.target && event.target.id === "pesquisar_produto_btn") {
        
        const nomeValue = document.getElementById("nome_pesquisa").value;

        
        fetch("backend/pesquisarProduto.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: "nome=" + encodeURIComponent(nomeValue)
        })
        .then(response => response.json())
        .then(produtos => {
            const tabela = document.querySelector("#tabela-produtos tbody");
            tabela.innerHTML = ""; // Limpa a tabela antes de preencher

            if (produtos.length === 0) {
                tabela.innerHTML = "<tr><td colspan='5'>Nenhum remédio encontrado.</td></tr>";
                return;
            }

            produtos.forEach(p => {
                
                tabela.innerHTML += `
                    <tr>
                        <td>${p.id}</td>
                        <td>${p.nome}</td>
                        <td>${p.data_vencimento}</td>
                        <td>${p.lote}</td>
                        <td>${p.quantidade}</td>
                    </tr>
                `;
            });
        })
        .catch(error => {
            console.error("Erro ao pesquisar:", error);
            alert("Erro ao conectar com o servidor.");
        });
    }
});
</script>