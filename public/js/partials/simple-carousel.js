import { colocaMascaraReferencia } from "../validators/view-masks.js";

/**
*
* Esse método busca pelas referências fornecidas no carrossel 
* e adiciona máscara a cada uma delas;
*/
export function mascaraReferenciaSlider(){
    const container = document.querySelector('.carousel-container');
    if(container){
        const itensCarrossel = container.querySelectorAll('.slide-carousel');
        itensCarrossel.forEach(item => {
            const referenciaItem = item.textContent.trim();
            const referenciaComMascara = colocaMascaraReferencia(referenciaItem);
            item.textContent = referenciaComMascara;
        });
    } else {
        throw new Error('Erro ao ler a referência. ');
    }
}

