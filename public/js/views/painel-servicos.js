import { writeMascaraValorDinheiro } from "../validators/view-masks.js";

const valores = document.getElementsByClassName('lista-servicos-valor');

document.addEventListener('DOMContentLoaded', () => {
    Array.from(valores).forEach(v => {
        v.innerHTML = writeMascaraValorDinheiro(v.innerHTML);
    });
});