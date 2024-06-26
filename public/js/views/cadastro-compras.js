const dominio = 'fornecedores';
var objetoSelecionado;

document.addEventListener('DOMContentLoaded', () => {
    buscarFornecedores();
});

document.addEventListener('onSearchInputSelected', (event) => {
    if(dominio === event['dominio']){
        objetoSelecionado = event['detail'];
        console.log(objetoSelecionado);
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