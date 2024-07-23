import { getCarouselData, nextButton, prevButton } from "../partials/simple-carousel.js";
import { colocaMascaraReferencia, writeMascaraValorDinheiro } from "../validators/view-masks.js";

const dominio = 'painel_situacao_financeira';
const listaComprovantes = document.getElementById('lista-comprovantes');
const saldoDiv = document.getElementById('painel-financeiro-saldo');

const spanValoresPainelDetalhado = document.getElementsByClassName('span-valores-painel-detalhado');

let referencia = 0;
let idInquilino = 0;

const pathSituacaoFinanceira = '/inquilino/show-situacao-financeira/{id}/{ref?}';

document.addEventListener('DOMContentLoaded', () => {
    try {
        showListaComprovantes();
        mudarCorSaldo();
    } catch (error) {
        showMensagem(error.message, "falha");
    }

    document.addEventListener('appData', (data) => {
        if(data['dominio'] === dominio){
            idInquilino = +data.detail['inquilino_id'];
            referencia = +data.detail['referencia'];
      }
    });

    Array.from(spanValoresPainelDetalhado).forEach(valor => {
        valor.textContent = writeMascaraValorDinheiro(valor.textContent);
    });

    const referencias = getCarouselData();
    for (let i = 0; i < referencias.length; i++) {
        const r = referencias[i];
        r.textContent = colocaMascaraReferencia(r.textContent.trim());
    }

});


prevButton.addEventListener('click', () => {
    console.log(pathSituacaoFinanceira.replace('{id}',idInquilino).replace('{ref?}', referencia-1));
     redirecionarPara(pathSituacaoFinanceira.replace('{id}',idInquilino).replace('{ref?}', referencia-1));
});

nextButton.addEventListener('click', () => {
     redirecionarPara(pathSituacaoFinanceira.replace('{id}',idInquilino).replace('{ref?}', referencia+1));
});

function showListaComprovantes(){
    if(listaComprovantes != null){
        listaComprovantes.style.display = 'block';
    }
}

function mudarCorSaldo(){
    if(+saldoDiv.textContent >= 0){
        saldoDiv.style.backgroundColor = '#0C72C0';
    }
}


