import { createState } from "../dynamic-micro-components/multi-select.js";
import { getSelectOptions } from "../dynamic-micro-components/select-option.js";
import { loadMessages } from "../partials/simple-modal.js";
import { LISTAR_IMOVEIS_IMOBILIARIA, LISTAR_SALAS } from "../routes.js";
import { cpfMascara, mascaraFatorDivisor, writeMascaraCpf } from "../validators/view-masks.js";
import { apenasNumeros } from "../validators/view-validation.js";


let appData = {};
const dominio = 'detalhes_inquilino';

const inputCpf = document.getElementById('form-inquilino-cpf');
const inputFatorDivisor = document.getElementById('input-fator-divisor');

const imobiliariasSelect = document.getElementById('imobiliarias-select-input');

const labelImovelSelect = document.getElementById('label-imoveis-select');
const imoveisSelect = document.getElementById('imoveis-select-input');

const labelSalasSelect = document.getElementById('label-sala-select');
const salasSelect = document.getElementById('sala-select-input');

imobiliariasSelect.addEventListener('change', (event) => {
    const imobiliaria = event.target.value;
    getSelectOptions(imoveisSelect, labelImovelSelect, imobiliaria, LISTAR_IMOVEIS_IMOBILIARIA);
});

imoveisSelect.addEventListener('change', (event) => {
    const imovel = event.target.value;
    getSelectOptions(salasSelect, labelSalasSelect, imovel, LISTAR_SALAS);
});



inputCpf.addEventListener('input', cpfMascara);
inputCpf.addEventListener('keydown', apenasNumeros);
inputCpf.value = writeMascaraCpf(inputCpf.value);


inputFatorDivisor.addEventListener('input', mascaraFatorDivisor);
inputFatorDivisor.addEventListener('keydown', apenasNumeros);


document.addEventListener('DOMContentLoaded', () => {

    document.addEventListener('appData', (data) => {
        if(data['dominio'] === dominio){
            appData = data.detail; 
            loadMessages(`Você tem certeza que deseja alterar a situação do inquilino ${appData.nome_inquilino} ?`);
        }
    });

    createState();

    if(salasSelect.childElementCount > 0){
        salasSelect.style.display = 'block';
    }
})



