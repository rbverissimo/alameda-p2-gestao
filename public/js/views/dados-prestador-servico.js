import { gerarDeleteIcon } from "../dynamic-micro-components/icons.js";
import { createOptions } from "../dynamic-micro-components/select-option.js";

const dominio = 'dados_prestador_servico';
let tiposPrestador = [];
let counter = 1;
let prefixTipoPrestador = 'tipo-prestador';

const tipoWrapper = document.getElementById('tipo-wrapper');
const adicionarTipoButton = document.getElementById('adicionar-tipo-button');

adicionarTipoButton.addEventListener('click', (event) => {
    tipoWrapper.appendChild(criarTipoPrestadorSelect());
    event.preventDefault();
});

document.addEventListener('appData', (appData) => {
    if(dominio === appData.dominio){
        tiposPrestador = appData.detail['tipos_prestador'];
    }
});

document.addEventListener('DOMContentLoaded', () => {


});


export function criarTipoPrestadorSelect(){
    const divRow = document.createElement('div');
    divRow.classList.add('row');
    divRow.classList.add('outline');

    const divCol8 = document.createElement('div');
    divCol8.classList.add('col-8');

    const divCol4 = document.createElement('div');
    divCol4.classList.add('col-4');

    const label = document.createElement('label');
    const select = document.createElement('select');

    select.id = label.for = `${prefixTipoPrestador}-input-${counter}`;
    select.name = `${prefixTipoPrestador}-${counter}`;
    label.id = `label-${select.id}`;
    label.textContent = 'Indique o tipo de serviço prestado pelo prestado: ';
    counter++; 
    createOptions(tiposPrestador, select);
    divCol8.appendChild(label);
    divCol8.appendChild(select);

    const deleteIcon = gerarDeleteIcon();
    divCol4.appendChild(deleteIcon);

    divRow.appendChild(divCol8);
    divRow.appendChild(divCol4);

    return divRow;
}