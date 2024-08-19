import { criarComponenteEnderecoSimplificado } from "../dynamic-micro-components/endereco.js";
import { gerarDeletarButton } from "../dynamic-micro-components/icons.js";
import { divCol, divRow, label } from "../dynamic-micro-components/layouts.js";
import { createOptions } from "../dynamic-micro-components/select-option.js";
import { cpfMascara, mascaraCnpj, mascaraTelefone, writeMascaraCnpj, writeMascaraCpf, writeMascaraTelefone } from "../validators/view-masks.js";

const dominio = 'dados_prestador_servico';
let tiposPrestador = [];
export const prefixTipoPrestador = 'tipo-prestador';

const telefoneInput = document.getElementById('telefone-trabalho-input');
const cnpjInput = document.getElementById('cnpj-prestador-input');
const cpfInput = document.getElementById('cpf-prestador-input');

const enderecoContainer = document.getElementById('endereco-container');
const tipoWrapper = document.getElementById('tipo-wrapper');
const adicionarTipoButton = document.getElementById('adicionar-tipo-button');

const cadastrarEnderecoToggle = document.getElementById('cadastrar-endereco-toggle-checkbox');

adicionarTipoButton.addEventListener('click', (event) => {
    tipoWrapper.appendChild(criarTipoPrestadorSelect(prefixTipoPrestador, tiposPrestador));
    event.preventDefault();
});




document.addEventListener('appData', (appData) => {
    if(dominio === appData.dominio){
        tiposPrestador = appData.detail['tipos_prestador'];
    }
});

telefoneInput.addEventListener('input', mascaraTelefone);
cnpjInput.addEventListener('input', mascaraCnpj);
cpfInput.addEventListener('input', cpfMascara);

document.addEventListener('DOMContentLoaded', () => {

    telefoneInput.value = writeMascaraTelefone(telefoneInput.value);
    cnpjInput.value = writeMascaraCnpj(cnpjInput.value);
    cpfInput.value = writeMascaraCpf(cpfInput.value);

    if(cadastrarEnderecoToggle !== null){
        setCadastrarEnderecoState();
    }

    setHydrateDelButtons();

});


export function criarTipoPrestadorSelect(prefix, optionsData){

    const tiposPrestador = optionsData;
    const counter = Math.floor(Math.random() * (99999 - 10000) + 10000);

    const newRow = divRow('outline');

    const divCol8 = divCol(8);
    const divCol3 = divCol(3);

    const newLabel = label(`${prefix}-input-${counter}`, 'Indique o tipo de serviço prestado: ', `label-${prefix}-input-${counter}`);
    
    const newSelect = document.createElement('select');
    newSelect.id = `${prefix}-input-${counter}`;
    newSelect.name = `${prefix}-${counter}`;

    createOptions(tiposPrestador, newSelect);
    divCol8.appendChild(newLabel);
    divCol8.appendChild(newSelect);
    
    const labelDelButton = document.createElement('label');
    labelDelButton.textContent = 'Clique para:';
    const deleteButton = gerarDeletarButton();
    deleteButton.type = 'button';
    deleteButton.addEventListener('click', () => {
        newRow.remove();
    });
    
    
    deleteButton.id = labelDelButton.for = `delete-button-${prefix}-${counter}`;
    divCol3.appendChild(labelDelButton);
    divCol3.appendChild(deleteButton);

    newRow.appendChild(divCol8);
    newRow.appendChild(divCol3);
    
    return newRow;
}

function setCadastrarEnderecoState() {
    cadastrarEnderecoToggle.addEventListener('change', function(){
        if(!this.checked){
        enderecoContainer.style.display = 'none';
        while(enderecoContainer.firstChild){
            enderecoContainer.removeChild(enderecoContainer.firstChild);
        }
        return;
        }
        enderecoContainer.style.display = 'block';
        const enderecoForm = criarComponenteEnderecoSimplificado({},'Endereço da empresa ou prestador de serviço', true);
        enderecoContainer.appendChild(enderecoForm);
    });
}

function setHydrateDelButtons(){
    const buttons = document.getElementsByClassName('dynamic-delete-button');
    Array.from(buttons).forEach(button => {
        const buttonId = button.id.split('-');
        const patternName = buttonId.slice(1, buttonId.length - 1).join('-');
        const verificador = buttonId[buttonId.length - 1];

        const container = document.getElementById(`dynamic-select-${patternName}-${verificador}`);
        button.addEventListener('click', (event) => {
            container.remove();
        });
    });
}