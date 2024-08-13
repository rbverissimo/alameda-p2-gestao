import {  gerarFocusState, gerarKeyUp } from "../components/search-input.js";
import { gerarInputAcoes } from "../dynamic-micro-components/layouts.js";
import {  debounce } from "../dynamic-micro-components/reactive.js";
import { getSelectOptions } from "../dynamic-micro-components/select-option.js";
import { LISTAR_IMOVEIS_IMOBILIARIA, LISTAR_PRESTADORES, LISTAR_SALAS } from "../routes.js";
import { dataMascara, mascaraValorDinheiro } from "../validators/view-masks.js";
import { apenasNumeros, inputStateValidation, isDataValida, isRequired, isValorDinheiroValido } from "../validators/view-validation.js";

let prestadores = []; 
const searchEl = document.getElementById('search');
const dominio = document.getElementById('dominio').getAttribute('data-dominio');
const prestadorContainer = document.getElementById('prestador-container');
let counter = 101;


const labelImobiliariaSelect = document.getElementById('label-imobiliaria-select');
const imobiliariaSelect = document.getElementById('imobiliaria-select-input');

const labelImovelSelect = document.getElementById('label-imovel-select');
const imovelSelect = document.getElementById('imovel-select-input');

const labelSalaSelect = document.getElementById('label-sala-select');
const salaSelect = document.getElementById('sala-select-input');

const dataInput = document.getElementsByClassName('data-input');

const labelValorServicoInput = document.getElementById('label-valor-servico-input');
const valorServicoInput = document.getElementById('valor-servico-input');
const spanErrorsValorServicoInput = document.getElementById('span-errors-valor-servico-input');

const codigoServicoInputLabel = document.getElementById('label-input-codigo-servico');
const codigoServicoInputSpanErrors = document.getElementById('span-errors-codigo-servico');
const codigoServicoInput = document.getElementById('form-codigo-servico');

const nomeServicoInputLabel = document.getElementById('label-input-nome-servico');
const nomeServicoInputSpanErrors = document.getElementById('span-errors-nome-servico');
const nomeServicoInput = document.getElementById('form-nome-servico');

valorServicoInput.addEventListener('input', mascaraValorDinheiro);
valorServicoInput.addEventListener('blur', (event) => {
    inputStateValidation(labelValorServicoInput, valorServicoInput, spanErrorsValorServicoInput, 
        event.target.value, isValorDinheiroValido, 'O valor declarado não é válido. ');
});

nomeServicoInput.addEventListener('blur', (event) => {
    inputStateValidation(nomeServicoInputLabel, nomeServicoInput, nomeServicoInputSpanErrors,
        event.target.value, isRequired, 'O nome do serviço é obrigatório.'
    )
});

codigoServicoInput.addEventListener('keydown', apenasNumeros);
codigoServicoInput.addEventListener('blur', (event) => {
    inputStateValidation(codigoServicoInputLabel, codigoServicoInput, codigoServicoInputSpanErrors,
        event.target.value, isRequired, 'O código do serviço é obrigatório. '
    )
});


for(const dataEl of dataInput){

    const idDataEl = dataEl.getAttribute('id');
    const label = document.getElementById(`label-${idDataEl}`);
    const spanErrors = document.getElementById(`span-errors-${idDataEl}`);

    dataEl.addEventListener('input', dataMascara);
    dataEl.addEventListener('blur', (event) => {
        inputStateValidation(label, dataEl, spanErrors, event.target.value, isDataValida, 'A data fornecida não está correta');
    });
}

document.addEventListener('DOMContentLoaded', () => {

    imobiliariaSelect.addEventListener('change', (event) => {
        getSelectOptions(imovelSelect, labelImovelSelect, event.target.value, LISTAR_IMOVEIS_IMOBILIARIA);
    });

    imovelSelect.addEventListener('change', (event) => {
        getSelectOptions(salaSelect, labelSalaSelect, event.target.value, LISTAR_SALAS);
    });

    document.addEventListener('onSearchInputSelected', (event) => {
        if('prestadores_servicos' === event.dominio){
            const prestadorSelecionado = event.detail;
            renderPrestadorSelecionado(prestadorSelecionado);
            searchEl.value = '';
        }
    });

    document.addEventListener('onSearchInputsAvailable', (event) => {
        if(dominio === event.dominio){
            prestadores = event.detail;
        }
    });
    

});

function renderPrestadorSelecionado(prestador){
    const verificador = ++counter;
    const newDiv = gerarInputAcoes('prestador', verificador, false, true);

    const nestedDiv = newDiv.children[0];
    const inputPrestador = nestedDiv.children[0];
    inputPrestador.value = prestador.nome; 

    const delButton = newDiv.children[2];
    delButton.addEventListener('click', (event) => {
        prestadorContainer.removeChild(newDiv);
        event.preventDefault();
    });

    const data = document.createElement('data');
    data.setAttribute('prestador-id', prestador.id);
    data.hidden = true;
    newDiv.appendChild(data);

    prestadorContainer.appendChild(newDiv);
}

searchEl.addEventListener('focus', async (event) => {
    gerarFocusState(LISTAR_PRESTADORES, prestadores, 'nome', dominio);
});

searchEl.addEventListener('keyup', debounce( async (event) => {
    const param = event.target.value;
    gerarKeyUp(param, LISTAR_PRESTADORES, prestadores, 'nome', dominio);
}, 400));