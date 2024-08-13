import { criarComponenteEnderecoSimplificado } from "../dynamic-micro-components/endereco.js";
import { apenasNumeros, inputStateValidation, isCNPJValido, isDataValida } from "../validators/view-validation.js";
import { mascaraCnpj, 
    writeMascaraCnpj, 
    writeMascaraTelefone,
    mascaraTelefone,
    mascaraValorDinheiro, dataMascara } from "../validators/view-masks.js";
import { gerarFocusState } from "../components/search-input.js"
import { LISTAR_FORNECEDORES } from "../routes.js";

const dominio = 'fornecedores';
let fornecedores = [];

const formaPagamentoSelect = document.getElementById('forma-pagamento-compra-select');
const inputQtdeDiasGarantia = document.getElementById('qtde-dias-garantia-input');
const inputQtdeParcelas = document.getElementById('qtde-parcelas-compra');

const valorCompraInput = document.getElementById('valor-compra-input');

const dataCompraInput = document.getElementById('data-compra-input');

const searchEl = document.getElementById('search');

document.addEventListener('DOMContentLoaded', () => {
    formaPagamentoSelect.addEventListener('change', habilitarQtdeParcelas);
    inputQtdeParcelas.addEventListener('keydown', apenasNumeros);
    inputQtdeDiasGarantia.addEventListener('keydown', apenasNumeros);

    valorCompraInput.addEventListener('input', mascaraValorDinheiro);
    valorCompraInput.addEventListener('keydown', apenasNumeros);

    dataCompraInput.addEventListener('keydown', apenasNumeros);
    dataCompraInput.addEventListener('input', dataMascara);
    dataCompraInput.addEventListener('blur', (event) => {
        const labelDataCompra = document.getElementById('label-input-data-compra');
        const spanDataCompra = document.getElementById('span-errors-data-compra');
        const spanMessage = 'A data não é válida.';
        inputStateValidation(labelDataCompra, dataCompraInput, spanDataCompra, event.target.value, isDataValida, spanMessage);

    });

    document.addEventListener('onSearchInputsAvailable', (event) => {
        if(dominio === event.dominio){
            fornecedores = event.detail;
        }
    });

});

searchEl.addEventListener('focus', (event) => {
    gerarFocusState(LISTAR_FORNECEDORES, fornecedores, 'cnpj', dominio);
});

document.addEventListener('onSearchInputSelected', (event) => {
    if(dominio === event['dominio']){
        renderizarFormulario(event['detail']);
    }
});

function renderizarFormulario(objToCreate){

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
    divWrapperInputCnpjFornecedor.classList.add('col-5');

    const inputCnpjFornecedor = document.createElement('input');
    inputCnpjFornecedor.id = 'input-cnpj-fornecedor';
    inputCnpjFornecedor.name = 'cnpj-fornecedor';
    inputCnpjFornecedor.value =  writeMascaraCnpj(objToCreate?.value?.cnpj) ?? '';
    inputCnpjFornecedor.required = true;
    inputCnpjFornecedor.maxLength = 18;
    inputCnpjFornecedor.addEventListener('keydown', apenasNumeros)
    inputCnpjFornecedor.addEventListener('input', mascaraCnpj);
    inputCnpjFornecedor.addEventListener('blur', (event) => {

        const labelCnpj = document.getElementById('label-cnpj-fornecedor');
        const spanCnpjErrors = document.getElementById('span-errors-cnpj-fornecedor');
        const spanMessage = 'O CPNJ não está correto. ';
        inputStateValidation(labelCnpj, inputCnpjFornecedor, spanCnpjErrors, event.target.value, isCNPJValido, spanMessage);

    })

    divWrapperInputCnpjFornecedor.appendChild(createLabel(inputCnpjFornecedor.id, 'CNPJ cadastrado: ', 'label-cnpj-fornecedor'));
    divWrapperInputCnpjFornecedor.appendChild(inputCnpjFornecedor);
    divWrapperInputCnpjFornecedor.appendChild(createSpanErrors('span-errors-cnpj-fornecedor'));

    return divWrapperInputCnpjFornecedor;

}

function inputTelefoneFornecedor(objToCreate){

    //<div class="col-4"></div>
    const divWrapperTelefoneFornecedor = document.createElement('div');
    divWrapperTelefoneFornecedor.classList.add('col-3');

    const inputTelefoneFornecedor = document.createElement('input');
    inputTelefoneFornecedor.id = 'input-telefone-fornecedor';
    inputTelefoneFornecedor.name = 'telefone-fornecedor';
    inputTelefoneFornecedor.value = writeMascaraTelefone(objToCreate?.value?.telefone) ?? '';
    inputTelefoneFornecedor.required = true;
    inputTelefoneFornecedor.addEventListener('keydown', apenasNumeros);
    inputTelefoneFornecedor.addEventListener('input', mascaraTelefone);

    divWrapperTelefoneFornecedor.appendChild(createLabel(inputTelefoneFornecedor.id, 'Telefone: '))
    divWrapperTelefoneFornecedor.appendChild(inputTelefoneFornecedor);

    return divWrapperTelefoneFornecedor;

}

function createLabel(forInput, text, id = null){
    const label = document.createElement('label');
    label.id = id;
    label.for = forInput;
    label.innerHTML = text;
    return label; 
}

function createSpanErrors(id){
    const span = document.createElement('span');
    span.classList.add('errors-highlighted');
    span.id = id;
    return span;
}

function habilitarQtdeParcelas(event){
    const codigoFormaPagamento = event.target.value;

    if(codigoFormaPagamento === '10001'){
        inputQtdeParcelas.disabled = false;
    } else {
        inputQtdeParcelas.disabled = true;
        inputQtdeParcelas.value = '';
    }
}