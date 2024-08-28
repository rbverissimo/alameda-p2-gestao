import { off } from "../dynamic-micro-components/reactive.js";
import { DELETAR_SERVICO } from "../routes.js";
import { writeMascaraValorDinheiro } from "../validators/view-masks.js";

const valores = document.getElementsByClassName('lista-servicos-valor');
const delIcons = document.getElementsByClassName('del-servico-icon');
const csrf  = document.getElementsByName('_token')[0].value;

document.addEventListener('DOMContentLoaded', () => {
    Array.from(valores).forEach(v => {
        v.innerHTML = writeMascaraValorDinheiro(v.innerHTML);
    });

    if(delIcons.length > 0){
        Array.from(delIcons).forEach(icon => {
            icon.addEventListener('click', async () => {
                const id = icon.getAttribute('data-registro');
                const response = await off(DELETAR_SERVICO, `id=${id}`, csrf);
                console.log(response);
            })
        });
    }

});