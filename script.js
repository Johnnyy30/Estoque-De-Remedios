// Aguarda o conteúdo da página ser totalmente carregado
document.addEventListener("DOMContentLoaded", () => {
  // --- Lógica para a Página de Login ---
  const loginForm = document.getElementById("loginForm");
  if (loginForm) {
    loginForm.addEventListener("submit", (event) => {
      event.preventDefault();
      alert("Login realizado com sucesso!");
      window.location.href = "viewtable.html";
    });
  }

  // --- Lógica para o Dashboard ---
  const stockTable = document.getElementById("stockTable");
  if (stockTable) {
    const addMedBtn = document.getElementById("addMedBtn");
    const saveChangesBtn = document.getElementById("saveChangesBtn");
    const tableBody = document.getElementById("stockTableBody");

    // Função para adicionar um novo remédio à tabela
    addMedBtn.addEventListener("click", () => {
      const name = document.getElementById("newMedName").value;
      const expDate = document.getElementById("newExpDate").value;
      const lote = document.getElementById("newLote").value;
      const quantity = document.getElementById("newQuantity").value;

      // Validação simples para não adicionar linhas vazias
      if (!name || !expDate || !lote || !quantity) {
        alert(
          "Por favor, preencha todos os campos para adicionar um novo remédio."
        );
        return;
      }

      // Cria a nova linha (tr) e suas células (td)
      const newRow = document.createElement("tr");
      newRow.innerHTML = `
                <td>${name}</td>
                <td>${expDate}</td>
                <td>${lote}</td>
                <td contenteditable="true">${quantity}</td>
                <td><button class="btn-remove">Remover</button></td>
            `;

      // Adiciona a nova linha ao corpo da tabela
      tableBody.appendChild(newRow);

      // Limpa os campos de input
      document.getElementById("newMedName").value = "";
      document.getElementById("newExpDate").value = "";
      document.getElementById("newLote").value = "";
      document.getElementById("newQuantity").value = "";
    });

    // Função para remover um remédio (usando delegação de evento)
    tableBody.addEventListener("click", (event) => {
      // Verifica se o elemento clicado é um botão de remover
      if (event.target.classList.contains("btn-remove")) {
        // Pega a linha (tr) pai do botão e a remove
        const rowToRemove = event.target.closest("tr");
        if (confirm("Tem certeza que deseja remover este item?")) {
          rowToRemove.remove();
        }
      }
    });

    // Função para "salvar" as alterações
    saveChangesBtn.addEventListener("click", () => {
      // Em uma aplicação real, aqui você enviaria os dados para um servidor.
      // Para este exemplo, apenas exibimos um alerta de sucesso.
      alert("Alterações salvas com sucesso!");
      window.location.assign("viewtable.html")
    });
  }
});
