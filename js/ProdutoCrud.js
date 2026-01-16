// ProdutoCrud.js
import { CrudUI } from "./crudUI.js";

export class ProdutoCrud extends CrudUI {

    buildSearchBody(term) {
        return "termo=" + encodeURIComponent(term);
    }

    buildDeleteBody(id) {
        return "id=" + encodeURIComponent(id);
    }

    // Dados para EDITAR
    getFormData() {
        return {
            id: document.querySelector(this.s.hiddenId).value,
            nome: document.querySelector(this.s.formFields.nome).value,
            data: document.querySelector(this.s.formFields.data_vencimento).value,
            lote: document.querySelector(this.s.formFields.lote).value,
             quantidade: document.querySelector(this.s.formFields.quantidade).value
        };
    }

    buildUpdateBody(d) {
        return (
            "id=" + encodeURIComponent(d.id) +
            "&nome=" + encodeURIComponent(d.nome) +
            "&data_vencimento=" + encodeURIComponent(d.data) +
            "&lote=" + encodeURIComponent(d.lote) +
            "&quantidade=" + encodeURIComponent(d.quantidade)
        );
    }

    // Dados para CADASTRAR
    getCreateData() {
        const f = this.s.createFields;
        return {
            nome: document.querySelector(f.nome).value,
            data: document.querySelector(f.data).value,
            lote: document.querySelector(f.lote).value,
            quantidade: document.querySelector(f.quantidade).value
        };
    }

    buildCreateBody(d) {
        return (
            "nome=" + encodeURIComponent(d.nome) +
            "&data_vencimento=" + encodeURIComponent(d.data) +
            "&lote=" + encodeURIComponent(d.lote) +
            "&quantidade=" + encodeURIComponent(d.quantidade)
        );
    }

    fillFormFromRow(row) {
        const tds = row.getElementsByTagName("td");
        document.querySelector(this.s.hiddenId).value                           = tds[0].textContent;
             document.querySelector(this.s.formFields.nome).value               = tds[1].textContent;
             document.querySelector(this.s.formFields.data_vencimento).value    = tds[2].textContent;
             document.querySelector(this.s.formFields.lote).value               = tds[3].textContent;
             document.querySelector(this.s.formFields.quantidade).value         = tds[4].textContent;
       
    }

    renderRows(remedios) {
        return remedios.map(p => `
            <tr id="tr${p.id}">
                <td>${p.id}</td>
                <td>${p.nome}</td>
                <td>${p.data}</td>
                <td>${p.lote}</td>
                <td>${p.quantidade}</td>
                <td>
                    <button type="button" class="btn-editar" data-id="${p.id}">Editar</button> |
                    <button type="button" class="btn-deletar" data-id="${p.id}">Deletar</button>
                </td>
            </tr>
        `).join("");
    }
}