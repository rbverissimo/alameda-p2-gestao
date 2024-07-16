import { anoMesMascara, dataMascara, mascaraValorDinheiro, writeMascaraValorDinheiro } from "../validators/view-masks.js";
import { isDataValida, isReferenciaValida } from "../validators/view-validation.js";

const anoMesInput = document.getElementById('ano-mes-input');
const valorInput = document.getElementById('input-valor-comprovante');
const dataInput = document.getElementById('data-input');

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

document.addEventListener('DOMContentLoaded', () => {

    valorInput.value = writeMascaraValorDinheiro(valorInput.value);
});