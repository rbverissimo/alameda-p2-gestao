import { mascaraCEP, mascaraCnpj, mascaraTelefone, writeMascaraCEP, writeMascaraCnpj, writeMascaraTelefone } from "../validators/view-masks.js";
import { apenasLetras, apenasNumeros, inputStateValidation, isCNPJValido, isUFValida } from "../validators/view-validation.js";

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
        const spanErrors = document.getElementById('errors-cnpj');
        const labelCnpj = document.getElementById('label-cnpj-fornecedor')
        const spanMessage = 'O CNPJ não está correto.';
        inputStateValidation(labelCnpj, inputCnpjFornecedor, spanErrors, event.target.value, isCNPJValido, spanMessage);
        
    })

    inputTelefoneFornecedor.value = writeMascaraTelefone(inputTelefoneFornecedor.value);
    inputTelefoneFornecedor.addEventListener('input', mascaraTelefone);
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