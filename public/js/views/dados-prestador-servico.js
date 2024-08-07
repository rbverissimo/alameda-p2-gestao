import { criarComponenteEnderecoSimplificado } from "../dynamic-micro-components/endereco.js";
import { gerarDeletarButton } from "../dynamic-micro-components/icons.js";
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

});


export function criarTipoPrestadorSelect(prefix, optionsData){

    const tiposPrestador = optionsData;
    const counter = Math.floor(Math.random() * (99999 - 10000 + 1)) + 10000;

    const divRow = document.createElement('div');
    divRow.classList.add('row');
    divRow.classList.add('outline');

    const divCol8 = document.createElement('div');
    divCol8.classList.add('col-8');

    const divCol3 = document.createElement('div');
    divCol3.classList.add('col-3');

    const label = document.createElement('label');
    const select = document.createElement('select');

    select.id = label.for = `${prefix}-input-${counter}`;
    select.name = `${prefix}-${counter}`;
    label.id = `label-${select.id}`;
    label.textContent = 'Indique o tipo de serviço prestado: ';
    createOptions(tiposPrestador, select);
    divCol8.appendChild(label);
    divCol8.appendChild(select);
    
    const labelDelButton = document.createElement('label');
    labelDelButton.textContent = 'Clique para:';
    const deleteButton = gerarDeletarButton();
    deleteButton.addEventListener('click', (event) => {
        divRow.remove();
        event.preventDefault();
    });
    
    
    deleteButton.id = labelDelButton.for = `delete-button-${prefix}-${counter}`;
    divCol3.appendChild(labelDelButton);
    divCol3.appendChild(deleteButton);

    divRow.appendChild(divCol8);
    divRow.appendChild(divCol3);
    
    return divRow;
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