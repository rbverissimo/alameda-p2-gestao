import { getSalasSelectedImovel } from "../components/imoveis-search.js";
import { loadMessages } from "../partials/simple-modal.js";
import { cpfMascara, mascaraFatorDivisor } from "../validators/view-masks.js";
import { apenasNumeros } from "../validators/view-validation.js";


let appData = {};

const inputTelefoneCelular = document.getElementById('form-inquilino-telefone-celular');
const inputTelefoneTrabalho = document.getElementById('form-inquilino-telefone-trabalho');
const inputTelefoneFixo = document.getElementById('form-inquilino-telefone-fixo');
const inputCpf = document.getElementById('form-inquilino-cpf');
const inputFatorDivisor = document.getElementById('input-fator-divisor');

const imoveisSelect = document.getElementById('imoveis-conta-select');
const salasSelect = document.getElementById('sala-select');

inputCpf.addEventListener('input', cpfMascara);
inputCpf.addEventListener('keydown', apenasNumeros);


inputFatorDivisor.addEventListener('input', mascaraFatorDivisor);
inputFatorDivisor.addEventListener('keydown', apenasNumeros);


imoveisSelect.addEventListener('change', (option) => {
    getSalasSelectedImovel(salasSelect, option.target.value);
});


document.addEventListener('DOMContentLoaded', () => {

    document.addEventListener('appData', (data) => {
        if(data['dominio'] === 'detalhes_inquilino'){
            appData = data.detail; 
            loadMessages(`Você tem certeza que deseja alterar a situação do inquilino ${appData.nome_inquilino} ?`);
        }
    });

    if(salasSelect.childElementCount > 0){
        salasSelect.style.display = 'block';
    }

})



