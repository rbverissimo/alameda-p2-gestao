import { colocaMascaraReferencia } from "../validators/view-masks.js";

export const prevButton = document.querySelector('.prev-carousel');
export const nextButton = document.querySelector('.next-carousel');

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


export function getCarouselData(){
    const items = document.getElementsByClassName('slide-carousel');
    if(items.length > 0){
        return items;
    }
}

