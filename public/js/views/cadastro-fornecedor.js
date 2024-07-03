import { writeMascaraCEP } from "../validators/view-masks";

const inputCnpjFornecedor = document.getElementById('input-cnpj-fornecedor');

document.addEventListener('DOMContentLoaded', () => {

    inputCnpjFornecedor.addEventListener('change', colocarMascaraCnpj);

});

function colocarMascaraCnpj(event){
    event.target.value = writeMascaraCEP(event.target.value);
}
