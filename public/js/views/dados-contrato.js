import { dataMascara, mascaraValorDinheiro } from "../validators/view-masks.js";
import { apenasNumeros, isDataValida, inputStateValidation, isValorDinheiroValido } from "../validators/view-validation.js";

const inputValorAluguel = document.getElementById('input-valor-aluguel');
const inputDataAssinatura = document.getElementById('contrato-input-data-assinatura');
const inputDataExpiracao = document.getElementById('contrato-input-data-expiracao');

inputValorAluguel.addEventListener('input', mascaraValorDinheiro);
inputValorAluguel.addEventListener('keydown', apenasNumeros);
inputValorAluguel.addEventListener('blur', (event) => {
    const label = document.getElementById('label-input-valor-aluguel');
    const span = document.getElementById('span-errors-valor-aluguel');
    const spanMessage = 'Valor inválido';
    inputStateValidation(label, inputValorAluguel, span, event.target.value, isValorDinheiroValido, spanMessage);
})

inputDataAssinatura.addEventListener('input', dataMascara);
inputDataAssinatura.addEventListener('keydown', apenasNumeros);
inputDataAssinatura.addEventListener('blur', (event) => {
        const label = document.getElementById('label-input-data-assinatura');
        const span = document.getElementById('span-errors-data-assinatura');
        const spanMessage = 'A data não é válida.';
        inputStateValidation(label, inputDataAssinatura, span, event.target.value, isDataValida, spanMessage);
    
});


inputDataExpiracao.addEventListener('input', dataMascara);
inputDataExpiracao.addEventListener('keydown', apenasNumeros);
inputDataExpiracao.addEventListener('blur', (event) => {
        const labelDataExpiracao = document.getElementById('label-input-data-expiracao');
        const spanDataExpiracao = document.getElementById('span-errors-data-expiracao');
        const spanMessage = 'A data não é válida.';
        inputStateValidation(labelDataExpiracao, inputDataExpiracao, spanDataExpiracao, event.target.value, isDataValida, spanMessage);

});
