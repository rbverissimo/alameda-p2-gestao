import { anoMesMascara, 
    colocaMascaraReferencia, 
    dataMascara, 
    mascaraValorDinheiro, 
    writeDataMascara, 
    writeMascaraValorDinheiro } from "../validators/view-masks.js";
import { isDataValida, isReferenciaValida } from "../validators/view-validation.js";
import { checarOptionsVisiveis, getSelectOptions  } from "../dynamic-micro-components/select-option.js";
import { LISTAR_INQUILINOS_IMOVEL } from "../routes.js";

const anoMesInput = document.getElementById('ano-mes-input');
const valorInput = document.getElementById('input-valor-comprovante');
const dataInput = document.getElementById('data-input');
const imoveisSelect = document.getElementById('select-imovel');
const inquilinosSelect = document.getElementById('select-inquilino');
const labelInquilinosSelect = document.getElementById('label-select-inquilino');

anoMesInput.addEventListener('input', anoMesMascara);
anoMesInput.addEventListener('blur', (e) => {
    if(!isReferenciaValida(e.target.value)){
        e.target.value = '';
        showMensagem("A referência passada é inválida.", "neutra");
    }
})

dataInput.addEventListener('input', dataMascara);
dataInput.addEventListener('blur', function(event) {
    if (!isDataValida(event.target.value)) {
        // Reset the value if it is not a valid date
        event.target.value = '';
    }
});

valorInput.addEventListener('input', mascaraValorDinheiro);

imoveisSelect.addEventListener('change', (option) => {
    getSelectOptions(inquilinosSelect, labelInquilinosSelect, option.target.value, LISTAR_INQUILINOS_IMOVEL);
});

document.addEventListener('DOMContentLoaded', () => {
    valorInput.value = writeMascaraValorDinheiro(valorInput.value);
    dataInput.value = writeDataMascara(dataInput.value);
    anoMesInput.value = colocaMascaraReferencia(anoMesInput.value);

    checarOptionsVisiveis(labelInquilinosSelect, inquilinosSelect);
});