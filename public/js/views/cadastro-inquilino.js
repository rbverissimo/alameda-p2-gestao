import { getSalasSelectedImovel } from "../components/imoveis-search.js";
import { loadMessages } from "../partials/simple-modal.js";
import { cpfMascara, mascaraFatorDivisor, mascaraTelefone, writeMascaraCpf, writeMascaraTelefone } from "../validators/view-masks.js";
import { apenasNumeros } from "../validators/view-validation.js";


let appData = {};
const dominio = 'detalhes_inquilino';

const inputTelefoneCelular = document.getElementById('form-inquilino-telefone-celular');
const inputTelefoneTrabalho = document.getElementById('form-inquilino-telefone-trabalho');
const inputTelefoneFixo = document.getElementById('form-inquilino-telefone-fixo');
const inputCpf = document.getElementById('form-inquilino-cpf');
const inputFatorDivisor = document.getElementById('input-fator-divisor');

const imoveisSelect = document.getElementById('imoveis-conta-select');
const salasSelect = document.getElementById('sala-select');


inputTelefoneCelular.addEventListener('input', mascaraTelefone);
inputTelefoneCelular.addEventListener('keydown', apenasNumeros);

inputTelefoneTrabalho.addEventListener('input', mascaraTelefone);
inputTelefoneTrabalho.addEventListener('keydown', apenasNumeros);

inputTelefoneFixo.addEventListener('input', mascaraTelefone);
inputTelefoneFixo.addEventListener('keydown', apenasNumeros);

inputCpf.addEventListener('input', cpfMascara);
inputCpf.addEventListener('keydown', apenasNumeros);
inputCpf.value = writeMascaraCpf(inputCpf.value);


inputFatorDivisor.addEventListener('input', mascaraFatorDivisor);
inputFatorDivisor.addEventListener('keydown', apenasNumeros);


imoveisSelect.addEventListener('change', (option) => {
    getSalasSelectedImovel(salasSelect, option.target.value);
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

    inputTelefoneCelular.value = writeMascaraTelefone(inputTelefoneCelular.value);
    inputTelefoneFixo.value = writeMascaraTelefone(inputTelefoneFixo.value);
    inputTelefoneTrabalho.value = writeMascaraTelefone(inputTelefoneTrabalho.value);

})



