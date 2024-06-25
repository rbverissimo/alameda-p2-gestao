export var fornecedores;

document.addEventListener('DOMContentLoaded', () => {
    buscarFornecedores();
});

async function buscarFornecedores(){
    try {
        const response = await fetch('/fornecedores/buscar');
        if(!response.ok){
            throw new Error(`Erro ao buscar as informações no servidor: ${response.status}`);
        }
        const data = await response.json();
        if(data !== null ){
            fornecedores = data;
            const searchInputsAvailable = criarSearchInputEvent(data);
            console.log(searchInputsAvailable);
            document.dispatchEvent(searchInputsAvailable);
        }
    } catch (error) {
        showMensagem(error, 'falha', 5000);
        console.log(error);
    }
}