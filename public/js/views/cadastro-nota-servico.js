import { getInputValueFromIDB, iniciarObjectStores, salvarIDBInput } from "../db/indexed.js";
import { toggleModalPicker } from "../dynamic-micro-components/modal-picker.js";
import { dataMascara, 
    formatarDataParaSalvar, 
    mascaraValorDinheiro, 
    removerMascaraValorDinheiro, 
    writeDataMascara, 
    writeMascaraValorDinheiro } from "../validators/view-masks.js";
import { apenasNumeros } from "../validators/view-validation.js";

const userDb = 'my-favorite-user';

const dataEmissaoInput = document.getElementById('form-data-emissao');
const valorBrutoInput = document.getElementById('form-valor-bruto');
const notaSerieInput = document.getElementById('form-nota-serie');
const numeroDocumentoInput = document.getElementById('form-numero-documento');
const selecionarServicoButton = document.getElementById('selecionar-servico-button');
const fecharModalButton = document.getElementById('fechar-modal-pick-servicos');

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

    selecionarServicoButton.addEventListener('click', (event) => {
        toggleModalPicker('pick-servicos');
        event.preventDefault();
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



fecharModalButton.addEventListener('click', (event) => { 
    toggleModalPicker('pick-servicos');
    event.preventDefault();
});
