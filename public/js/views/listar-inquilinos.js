import { writeMascaraValorDinheiro } from "../validators/view-masks.js";

const valorAluguelElements = document.getElementsByClassName('valor-aluguel-lista-inquilinos');
const ativosInativosSelect = document.getElementById('ativos-inativos-select');

document.addEventListener('DOMContentLoaded', function(){
        Array.from(valorAluguelElements).forEach(e => {
            e.textContent = writeMascaraValorDinheiro(e.textContent);
        });
});

ativosInativosSelect.addEventListener('change', (event) => {
    
});