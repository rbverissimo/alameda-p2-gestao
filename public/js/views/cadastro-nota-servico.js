import { getInputValueFromIDB, getStoredValue, iniciarObjectStores, salvarIDBInput } from "../db/indexed.js";
import { isNullOrUndefined, isStrValueNuloOuVazio } from "../validators/null-safe.js";
import { dataMascara, formatarDataParaSalvar, mascaraValorDinheiro, removerMascaraValorDinheiro, writeDataMascara, writeMascaraValorDinheiro } from "../validators/view-masks.js";
import { apenasNumeros } from "../validators/view-validation.js";

const userDb = 'my-favorite-user';

const dataEmissaoInput = document.getElementById('form-data-emissao');
const valorBrutoInput = document.getElementById('form-valor-bruto');
const notaSerieInput = document.getElementById('form-nota-serie');
const numeroDocumentoInput = document.getElementById('form-numero-documento');

document.addEventListener('DOMContentLoaded', async () => {

    iniciarObjectStores(userDb, 'cadastro-nfs-data-emissao', 'cadastro-nfs-valor-bruto', 'cadastro-nfs-nota-serie', 'cadastro-nfs-numero-documento');

    dataEmissaoInput.addEventListener('change', (event) => {
        const saveValue = formatarDataParaSalvar(event.target.value);
        salvarIDBInput(userDb, 'cadastro-nfs-data-emissao', 'form-data-emissao', saveValue);
    });
   
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
    
    dataEmissaoInput.value = writeDataMascara(dataEmissaoInput.value);

    await recriarState();

    
});

async function recriarState(){
    getInputValueFromIDB(userDb, 'cadastro-nfs-data-emissao', dataEmissaoInput, true, writeDataMascara);
    getInputValueFromIDB(userDb, 'cadastro-nfs-valor-bruto', valorBrutoInput, true, writeMascaraValorDinheiro);
    getInputValueFromIDB(userDb, 'cadastro-nfs-nota-serie', notaSerieInput);
    getInputValueFromIDB(userDb, 'cadastro-nfs-numero-documento', numeroDocumentoInput);
}

dataEmissaoInput.addEventListener('input', dataMascara);
valorBrutoInput.addEventListener('input', mascaraValorDinheiro);
notaSerieInput.addEventListener('input', apenasNumeros);
numeroDocumentoInput.addEventListener('input', apenasNumeros);
