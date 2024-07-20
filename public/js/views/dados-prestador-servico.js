const dominio = 'dados_prestador_servico';
let tiposPrestador = [];

const tipoWrapper = document.getElementById('tipo-wrapper');
const adicionarTipoButton = document.getElementById('adicionar-tipo-button');

adicionarTipoButton.addEventListener('click', (event) => {
    event.preventDefault();
});

document.addEventListener('appData', (appData) => {
    if(dominio === appData.dominio){
        tiposPrestador = appData.detail['tipos_prestador'];
        console.log(tiposPrestador);
    }
});

document.addEventListener('DOMContentLoaded', () => {


});


export function criarTipoPrestadorSelect(){
    const divRow = document.createElement('div');
    divRow.classList.add('row');

    const select = document.createElement('select');

    


    return divRow;
}