import { salvarIDBInput } from "../db/indexed.js";
import { dataMascara } from "../validators/view-masks.js";

const userDb = 'my-favorite-user';

const dataEmissaoInput = document.getElementById('form-data-emissao');
const valorBrutoInput = document.getElementById('form-valor-bruto');
const notaSerieInput = document.getElementById('form-nota-serie');
const numeroDocumentoInput = document.getElementById('form-numero-documento');

document.addEventListener('DOMContentLoaded', () => {

    dataEmissaoInput.addEventListener('change', (event) => {
        salvarIDBInput(userDb, 'cadastro-nfs-data-emissao', 'form-data-emissao', event.target.value);
    });

    valorBrutoInput.addEventListener('change', (event) => {

    });

    notaSerieInput.addEventListener('change', (event) => {

    });

    numeroDocumentoInput.addEventListener('change', (event) => {

    });

});

dataEmissaoInput.addEventListener('input', dataMascara);
