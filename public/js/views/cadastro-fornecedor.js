import { mascaraCEP, mascaraCnpj, mascaraTelefoneFixo, writeMascaraCEP, writeMascaraCnpj, writeMascaraTelefoneFixo } from "../validators/view-masks.js";
import { apenasLetras, apenasNumeros, isCNPJValido, isUFValida } from "../validators/view-validation.js";

const inputCnpjFornecedor = document.getElementById('input-cnpj-fornecedor');
const inputTelefoneFornecedor = document.getElementById('input-telefone-fornecedor');
const inputCep = document.getElementById('input-cep');
const inputNumeroEndereco = document.getElementById('input-numero-endereco');
const inputUf = document.getElementById('input-uf');

document.addEventListener('DOMContentLoaded', () => {

    inputCnpjFornecedor.value = writeMascaraCnpj(inputCnpjFornecedor.value);
    inputCnpjFornecedor.addEventListener('input', mascaraCnpj);
    inputCnpjFornecedor.addEventListener('keydown', apenasNumeros);
    inputCnpjFornecedor.addEventListener('blur', (event) => {
        if(!isCNPJValido(event.target.value)){
            inputCnpjFornecedor.classList.add('error-state');
        } else {
            if(inputCnpjFornecedor.classList.contains('error-state')){
                inputCnpjFornecedor.classList.remove('error-state');
            }
        }
    })

    inputTelefoneFornecedor.value = writeMascaraTelefoneFixo(inputTelefoneFornecedor.value);
    inputTelefoneFornecedor.addEventListener('input', mascaraTelefoneFixo);
    inputTelefoneFornecedor.addEventListener('keydown', apenasNumeros);

    inputCep.value = writeMascaraCEP(inputCep.value);
    inputCep.addEventListener('keydown', apenasNumeros);
    inputCep.addEventListener('input', mascaraCEP);

    inputNumeroEndereco.addEventListener('keydown', apenasNumeros);
    
    inputUf.addEventListener('keydown', apenasLetras);
    inputUf.addEventListener('blur', (event) => {
        if(!isUFValida(event.target.value)){
            inputUf.classList.add('error-state');
        } else {
            if(inputUf.classList.contains('error-state')){
                inputUf.classList.remove('error-state');
            }
        }
    });

});