import { apenasNumeros } from "../validators/view-validation.js";
import { mascaraValorDinheiro, writeDataMascara, writeMascaraValorDinheiro } from "../validators/view-masks.js";

const inputValorInquilino = document.getElementById('input-valor-inquilino');
const inputDataVencimento = document.getElementById('input-data-vencimento');
const inputDataPagamento = document.getElementById('input-data-pagamento');



inputValorInquilino.addEventListener('input', mascaraValorDinheiro);
inputValorInquilino.addEventListener('keydown', apenasNumeros);

inputDataPagamento.addEventListener('input', writeDataMascara);
inputDataPagamento.addEventListener('keydown', apenasNumeros);


document.addEventListener('DOMContentLoaded', () => {

    inputValorInquilino.value = writeMascaraValorDinheiro(inputValorInquilino.value);
    inputDataVencimento.value = writeDataMascara(inputDataVencimento.value);

});