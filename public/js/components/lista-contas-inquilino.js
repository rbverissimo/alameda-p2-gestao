import { writeDataMascara, writeMascaraContadaQuitada, writeMascaraValorDinheiro } from "../validators/view-masks.js";

const tableDataView = document.getElementsByClassName('table-data-view');
const tableValoresView = document.getElementsByClassName('table-valores-em-real');
const tableQuitacaoView = document.getElementsByClassName('table-quitacao-view');

document.addEventListener('DOMContentLoaded', () => {

    Array.from(tableDataView).forEach(data => {
        data.textContent = writeDataMascara(data.textContent);
    });

    Array.from(tableValoresView).forEach(valor => {
        valor.textContent = writeMascaraValorDinheiro(valor.textContent);
    });

    Array.from(tableQuitacaoView).forEach(quitacao => {  
        quitacao.textContent = writeMascaraContadaQuitada(quitacao.textContent);
    });

});