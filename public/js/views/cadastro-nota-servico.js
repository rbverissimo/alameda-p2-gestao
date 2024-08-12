import { iniciarObjectStores, salvarIDBInput } from "../db/indexed.js";
import { dataMascara, limparMascara, mascaraValorDinheiro, removerMascaraValorDinheiro, writeDataMascara } from "../validators/view-masks.js";
import { apenasNumeros } from "../validators/view-validation.js";

const userDb = 'my-favorite-user';

const dataEmissaoInput = document.getElementById('form-data-emissao');
const valorBrutoInput = document.getElementById('form-valor-bruto');
const notaSerieInput = document.getElementById('form-nota-serie');
const numeroDocumentoInput = document.getElementById('form-numero-documento');

document.addEventListener('DOMContentLoaded', () => {

    iniciarObjectStores(userDb, 'cadastro-nfs-data-emissao', 'cadastro-nfs-valor-bruto', 'cadastro-nfs-nota-serie', 'cadastro-nfs-numero-documento');

    dataEmissaoInput.addEventListener('change', (event) => {
        const saveValue = limparMascara(event.target.value);
        salvarIDBInput(userDb, 'cadastro-nfs-data-emissao', 'form-data-emissao', saveValue);
    });

    dataEmissaoInput.value = writeDataMascara(dataEmissaoInput.value);

    valorBrutoInput.addEventListener('change', (event) => {
        const saveValue = removerMascaraValorDinheiro(event.target.value);
        salvarIDBInput(userDb, 'cadastro-nfs-valor-bruto', 'form-valor-bruto', saveValue);
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
