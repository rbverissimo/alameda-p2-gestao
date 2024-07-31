import { getSelectOptions } from "../dynamic-micro-components/select-option.js";
import { loadMessages } from "../partials/simple-modal.js";
import { LISTAR_SALAS } from "../routes.js";
import { cpfMascara, mascaraFatorDivisor, writeMascaraCpf } from "../validators/view-masks.js";
import { apenasNumeros } from "../validators/view-validation.js";


let appData = {};
const dominio = 'detalhes_inquilino';

const inputCpf = document.getElementById('form-inquilino-cpf');
const inputFatorDivisor = document.getElementById('input-fator-divisor');

const salasSelect = document.getElementById('sala-select');



inputCpf.addEventListener('input', cpfMascara);
inputCpf.addEventListener('keydown', apenasNumeros);
inputCpf.value = writeMascaraCpf(inputCpf.value);


inputFatorDivisor.addEventListener('input', mascaraFatorDivisor);
inputFatorDivisor.addEventListener('keydown', apenasNumeros);


imoveisSelect.addEventListener('change', (option) => {
    getSelectOptions(salasSelect, option.target.value, LISTAR_SALAS);
});


document.addEventListener('DOMContentLoaded', () => {

    document.addEventListener('appData', (data) => {
        if(data['dominio'] === dominio){
            appData = data.detail; 
            loadMessages(`Você tem certeza que deseja alterar a situação do inquilino ${appData.nome_inquilino} ?`);
        }
    });

    if(salasSelect.childElementCount > 0){
        salasSelect.style.display = 'block';
    }
})



