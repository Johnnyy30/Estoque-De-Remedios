<main class="main-content">
    <div class="container">
        <div class="table-container">
           <table  id="stockTable">
    <thead>
       <tr>
            <th>ID</th>
            <th>Nome do Remédio</th>
            <th>Data de Vencimento</th>
            <th>Lote</th>
            <th>Quantidade</th>
        </tr>
    </thead>
    <tbody></tbody>
</table>
<script>
    fetch("backend/ListarRemedio.php")
    .then(response => response.json())
    .then(produtos => {
        const tabela = document.querySelector("#stockTable tbody");

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
    .catch(error => console.error("Erro ao carregar produtos:", error))

</script>
        </div>
    </div>
</main>