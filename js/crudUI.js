// CrudUI.js
export class CrudUI {
    constructor(config) {
        this.config = config;
        this.s = config.selectors;
        this.urls = config.urls;
        this.entityName = config.entityName || "registro";
        this.rowIdPrefix = config.rowIdPrefix || "tr";

        this.els = {};
    }

    init() {
        // Seleção segura: Só tenta selecionar se o seletor for definido na configuração
        if (this.s.searchInput)  this.els.searchInput  = document.querySelector(this.s.searchInput);
        if (this.s.searchButton) this.els.searchButton = document.querySelector(this.s.searchButton);
        if (this.s.tableBody)    this.els.tableBody    = document.querySelector(this.s.tableBody);
        if (this.s.saveButton)   this.els.saveButton   = document.querySelector(this.s.saveButton);
        if (this.s.createButton) this.els.createButton = document.querySelector(this.s.createButton);

        this.registerEvents();
    }

    registerEvents() {
        // Só adiciona evento se o botão de PESQUISAR existir na página
        if (this.els.searchButton) {
            this.els.searchButton.addEventListener("click", (e) => {
                e.preventDefault();
                this.search();
            });
        }

        // Só adiciona evento se o botão de SALVAR EDIÇÃO existir na página
        if (this.els.saveButton) {
            this.els.saveButton.addEventListener("click", (e) => {
                e.preventDefault();
                this.saveEdit();
            });
        }

        // Só adiciona evento se o botão de CADASTRAR existir na página
        if (this.els.createButton) {
            this.els.createButton.addEventListener("click", (e) => {
                e.preventDefault();
                this.createItem();
            });
        }

        // CLIQUES NA TABELA (editar/deletar) - Só adiciona se a tabela existir
        if (this.els.tableBody) {
            this.els.tableBody.addEventListener("click", (e) => {
                const btn = e.target;

                if (btn.classList.contains("btn-deletar")) {
                    this.deleteItem(btn.dataset.id);
                }

                if (btn.classList.contains("btn-editar")) {
                    const row = this.getRow(btn.dataset.id);
                    this.fillFormFromRow(row);
                    this.openModal();
                }
            });
        }
    }

    // ------------------------------
    // MÉTODOS COMUNS
    // ------------------------------

    search() {
        const term = this.els.searchInput.value;

        fetch(this.urls.search, {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: this.buildSearchBody(term)
        })
        .then(r => r.json())
        .then(items => {
            this.els.tableBody.innerHTML = this.renderRows(items);
        })
        .catch(err => console.error("Erro ao pesquisar " + this.entityName + ":", err));
    }

    saveEdit() {
        const data = this.getFormData();

        fetch(this.urls.update, {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: this.buildUpdateBody(data)
        })
        .then(r => r.json())
        .then(json => {
            alert(json.mensagem || json.message || (this.entityName + " atualizado com sucesso!"));
            this.closeModal();
            this.search();
        })
        .catch(err => console.error("Erro ao atualizar " + this.entityName + ":", err));
    }

    deleteItem(id) {
        if (!confirm("Deseja excluir este " + this.entityName + "?")) return;

        fetch(this.urls.delete, {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: this.buildDeleteBody(id)
        })
        .then(r => r.json())
        .then(json => {
            alert(json.mensagem || json.message || (this.entityName + " excluído!"));
            const row = this.getRow(id);
            if (row) row.remove();
        })
        .catch(err => console.error("Erro ao deletar " + this.entityName + ":", err));
    }

    // CADASTRAR
    createItem() {
        const data = this.getCreateData();

        fetch(this.urls.create, {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: this.buildCreateBody(data)
        })
        .then(r => r.json())
        .then(json => {
            alert(json.mensagem || json.message || (this.entityName + " cadastrado com sucesso!"));

            
            if (this.els.searchInput) {
            this.search();
        }

            // opcional: limpar formulário de cadastro
            if (this.s.createForm) {
                const form = document.querySelector(this.s.createForm);
                if (form) form.reset();
            }
        })
        .catch(err => console.error("Erro ao cadastrar " + this.entityName + ":", err));
    }

    // ------------------------------
    // MÉTODOS ABSTRACT (sobrescritos nas filhas)
    // ------------------------------
    buildSearchBody(term)   { throw "Implementar em classe filha"; }
    buildDeleteBody(id)     { throw "Implementar em classe filha"; }
    buildUpdateBody(data)   { throw "Implementar em classe filha"; }
    buildCreateBody(data)   { throw "Implementar em classe filha"; }

    getFormData()           { throw "Implementar em classe filha"; }
    getCreateData()         { throw "Implementar em classe filha"; }

    fillFormFromRow(row)    { throw "Implementar em classe filha"; }
    renderRows(items)       { throw "Implementar em classe filha"; }
}