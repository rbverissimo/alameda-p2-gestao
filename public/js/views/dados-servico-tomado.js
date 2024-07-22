import { getSelectOptions } from "../dynamic-micro-components/select-option.js";
import { LISTAR_SALAS } from "../routes.js";
import { dataMascara, mascaraValorDinheiro } from "../validators/view-masks.js";
import { inputStateValidation, isDataValida, isValorDinheiroValido } from "../validators/view-validation.js";

const labelImoveisSelect = document.getElementById('label-imoveis-servico-select');
const imoveisSelect = document.getElementById('imoveis-servico-select');

const labelSalaSelect = document.getElementById('label-sala-select');
const salaSelect = document.getElementById('sala-select');

const dataInput = document.getElementsByClassName('data-input');

const labelValorServicoInput = document.getElementById('label-valor-servico-input');
const valorServicoInput = document.getElementById('valor-servico-input');
const spanErrorsValorServicoInput = document.getElementById('span-errors-valor-servico-input');

valorServicoInput.addEventListener('input', mascaraValorDinheiro);
valorServicoInput.addEventListener('blur', (event) => {
    inputStateValidation(labelValorServicoInput, valorServicoInput, spanErrorsValorServicoInput, 
        event.target.value, isValorDinheiroValido, 'O valor declarado não é válido');
})


for(const dataEl of dataInput){

    const idDataEl = dataEl.getAttribute('id');
    const label = document.getElementById(`label-${idDataEl}`);
    const spanErrors = document.getElementById(`span-errors-${idDataEl}`);

    dataEl.addEventListener('input', dataMascara);
    dataEl.addEventListener('blur', (event) => {
        inputStateValidation(label, dataEl, spanErrors, event.target.value, isDataValida, 'A data fornecida não está correta');
    });
}

document.addEventListener('DOMContentLoaded', () => {

    imoveisSelect.addEventListener('change', (option) => {
        getSelectOptions(salaSelect, labelSalaSelect, option.target.value, LISTAR_SALAS);
    });

});