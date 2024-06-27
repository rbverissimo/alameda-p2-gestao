import { criarComponenteEnderecoSimplificado } from "../dynamic-micro-components/endereco.js";

const dominio = 'fornecedores';
var objetoSelecionado;

document.addEventListener('DOMContentLoaded', () => {
    buscarFornecedores();
});

document.addEventListener('onSearchInputSelected', (event) => {
    if(dominio === event['dominio']){
        renderizarFormulario(event['detail']);
    }
});

async function buscarFornecedores(){
    try {
        const response = await fetch('/fornecedores/buscar');
        if(!response.ok){
            throw new Error(`Erro ao buscar as informações no servidor: ${response.status}`);
        }
        const data = await response.json();
        if(data !== null ){
            const searchInputsAvailable = criarSearchInputEvent(data, dominio);
            document.dispatchEvent(searchInputsAvailable);
        }
    } catch (error) {
        showMensagem(error, 'falha', 5000);
        console.log(error);
    }
}

function renderizarFormulario(objToCreate){
    console.log(objToCreate);

    // ACESSOS GLOBAIS
    const divRenderSpace = document.getElementById('render-space');
    document.getElementById('dynamic-wrapper')?.remove();

    //<div id="dynamic-wrapper> conteúdo do formulário </div>"
    const divDynamicWrapper = document.createElement('div');
    divDynamicWrapper.id = 'dynamic-wrapper';
    divRenderSpace.appendChild(divDynamicWrapper);
    
    //<div class="row"></div>
    const divRow1 = document.createElement('div');
    divRow1.classList.add('row');

    divRow1.appendChild(inputCnpjFornecedor(objToCreate));
    divRow1.appendChild(inputNomeFornecedor(objToCreate));
    divRow1.appendChild(inputTelefoneFornecedor(objToCreate));

    const divRow2 = document.createElement('div');
    divRow2.classList.add('row');
    
    divRow2.appendChild(criarComponenteEnderecoSimplificado(objToCreate?.value?.endereco, 'Endereço do fornecedor: '));

    divDynamicWrapper.append(divRow1);
    divDynamicWrapper.append(divRow2);

}

function inputNomeFornecedor(objToCreate){

    //<div class="col-6"></div>
    const divWrapperInputNomeFornecedor = document.createElement('div');
    divWrapperInputNomeFornecedor.classList.add('col-4');
    
    const inputNomeFornecedor = document.createElement('input');
    inputNomeFornecedor.id = 'input-nome-fornecedor'
    inputNomeFornecedor.name = 'nome-fornecedor';
    inputNomeFornecedor.value = objToCreate?.value?.nome_fornecedor ?? '';
    inputNomeFornecedor.required = true;


    divWrapperInputNomeFornecedor.appendChild(createLabel(inputNomeFornecedor.id, 'Nome do fornecedor: '));
    divWrapperInputNomeFornecedor.appendChild(inputNomeFornecedor);

    return divWrapperInputNomeFornecedor;

}

function inputCnpjFornecedor(objToCreate){

    //<div class="col-4"></div>
    const divWrapperInputCnpjFornecedor = document.createElement('div');
    divWrapperInputCnpjFornecedor.classList.add('col-3');

    const inputCnpjFornecedor = document.createElement('input');
    inputCnpjFornecedor.id = 'input-cnpj-fornecedor';
    inputCnpjFornecedor.name = 'cnpj-fornecedor';
    inputCnpjFornecedor.value = objToCreate?.value?.cnpj ?? '';
    inputCnpjFornecedor.required = true;
    inputCnpjFornecedor.maxLength = 18;

    divWrapperInputCnpjFornecedor.appendChild(createLabel(inputCnpjFornecedor.id, 'CNPJ cadastrado: '))
    divWrapperInputCnpjFornecedor.appendChild(inputCnpjFornecedor);

    return divWrapperInputCnpjFornecedor;

}

function inputTelefoneFornecedor(objToCreate){

    //<div class="col-4"></div>
    const divWrapperTelefoneFornecedor = document.createElement('div');
    divWrapperTelefoneFornecedor.classList.add('col-2');

    const inputTelefoneFornecedor = document.createElement('input');
    inputTelefoneFornecedor.id = 'input-telefone-fornecedor';
    inputTelefoneFornecedor.name = 'telefone-fornecedor';
    inputTelefoneFornecedor.value = objToCreate?.value?.telefone ?? '';
    inputTelefoneFornecedor.required = true;

    divWrapperTelefoneFornecedor.appendChild(createLabel(inputTelefoneFornecedor.id, 'Telefone: '))
    divWrapperTelefoneFornecedor.appendChild(inputTelefoneFornecedor);

    return divWrapperTelefoneFornecedor;

}

function createLabel(forInput, text){
    const label = document.createElement('label');
    label.for = forInput;
    label.innerHTML = text;
    return label; 
}