/**
 * Esse script se refere à lista de comprovantes do _components.lista_comprovantes.blade.php
 */

import { colocaMascaraReferencia, writeDataMascara, writeMascaraValorDinheiro } from "../validators/view-masks.js";

const spanValorTabela = document.getElementsByClassName('span-valor-tabela');
const spanDataTabela = document.getElementsByClassName('span-data-tabela');


document.addEventListener('DOMContentLoaded', () => {

    Array.from(spanValorTabela).forEach( valor => {
        valor.textContent = writeMascaraValorDinheiro(valor.textContent);
    });   
    
    Array.from(spanDataTabela).forEach( data => {
        data.textContent = writeDataMascara(data.textContent);
    });
});