import { cpfMascara, mascaraFatorDivisor } from "../validators/view-masks.js";
import { apenasNumeros } from "../validators/view-validation.js";


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
    const imovelSelecionado = option.target.value;
    const url = '/salas/listar-salas/' + imovelSelecionado;
    salasSelect.innerHTML = '';
    salasSelect.style.display = 'none';

    fetch(url)
        .then(response => {
            if(response.status === 200){
                return response.json();
            } else {
                throw new Error(`Erro ao buscar as informações no servidor ${response.status}`);
            }
        })
        .then(data => {
            createSalasOptions(data);
        })
        .catch(err => {
            showMensagem(err, 'falha', 5000);
            console.error(err);
        })

});

function createSalasOptions(data){
    for(const object of data){
        const option = document.createElement('option');
        option.value = object.id;
        option.text = object.nomesala;

        salasSelect.appendChild(option);
    }
    
    if(data.length > 0){
        salasSelect.style.display = 'block';
    }
    
}



