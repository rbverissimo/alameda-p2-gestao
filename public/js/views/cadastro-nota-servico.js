import { salvarIDBInput } from "../db/indexed.js";
import { dataMascara, mascaraValorDinheiro, writeDataMascara } from "../validators/view-masks.js";
import { apenasNumeros } from "../validators/view-validation.js";

const userDb = 'my-favorite-user';

const dataEmissaoInput = document.getElementById('form-data-emissao');
const valorBrutoInput = document.getElementById('form-valor-bruto');
const notaSerieInput = document.getElementById('form-nota-serie');
const numeroDocumentoInput = document.getElementById('form-numero-documento');

document.addEventListener('DOMContentLoaded', () => {

    dataEmissaoInput.addEventListener('change', (event) => {
        salvarIDBInput(userDb, 'cadastro-nfs-data-emissao', 'form-data-emissao', event.target.value);
    });

    dataEmissaoInput.value = writeDataMascara(dataEmissaoInput.value);

    valorBrutoInput.addEventListener('change', (event) => {
        salvarIDBInput(userDb, 'cadastro-nfs-valor-bruto', 'form-valor-bruto', event.target.value);
    });

    notaSerieInput.addEventListener('change', (event) => {
        salvarIDBInput(userDb, 'cadastro-nfs-nota-serie', 'form-nota-serie', event.target.value)
    });

    numeroDocumentoInput.addEventListener('change', (event) => {
        salvarIDBInput(userDb, 'cadastro-nfs-numero-documento', 'form-numero-documento', event.target.value);
    });

});

dataEmissaoInput.addEventListener('input', dataMascara);
valorBrutoInput.addEventListener('input', mascaraValorDinheiro);
notaSerieInput.addEventListener('input', apenasNumeros);
numeroDocumentoInput.addEventListener('input', apenasNumeros);
