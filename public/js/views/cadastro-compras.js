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
    const divRenderSpace = document.getElementById('render-space');

    const divRow1 = document.createElement('div');
    divRow1.classList.add('row');


    const divWrapperInputNomeFornecedor = document.createElement('div');
    divWrapperInputNomeFornecedor.classList.add('col-6');
    
    const inputNomeFornecedor = document.createElement('input');
    inputNomeFornecedor.name = 'nome-fornecedor';
    inputNomeFornecedor.value = objToCreate?.value?.nome_fornecedor ?? '';

    divWrapperInputNomeFornecedor.appendChild(inputNomeFornecedor)

    divRow1.appendChild(divWrapperInputNomeFornecedor);
    divRenderSpace.append(divRow1);
}