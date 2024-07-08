import { swapPontosVirgulas } from "../validators/view-masks.js";

const valorAluguelElements = document.getElementsByClassName('valor-aluguel-lista-inquilinos');

document.addEventListener('DOMContentLoaded', function(){
        Array.from(valorAluguelElements).forEach(e => {
            e.textContent = swapPontosVirgulas(e.textContent);
        });
});