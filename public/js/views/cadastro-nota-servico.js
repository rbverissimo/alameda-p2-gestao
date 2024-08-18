import { getInputValueFromIDB, iniciarObjectStores, salvarIDBInput } from "../db/indexed.js";
import { gerarDeletarButton } from "../dynamic-micro-components/icons.js";
import { divCol, divRow, headerDivisor, input, label } from "../dynamic-micro-components/layouts.js";
import { getModalTable, onPickedSelection, toggleModalPicker } from "../dynamic-micro-components/modal-picker.js";
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

const selectionContainer = document.getElementById('selection-container');

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

    setSelecionarServicoExclusive();

    document.addEventListener('onPickedSelection', (event) => {
        resetSelection();
        renderSelection(event.detail);
    });

    
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

function setSelecionarServicoExclusive(){
   const table = getModalTable('pick-servicos');
   const liveCheckboxes  = table.getElementsByTagName('input');
   const checkboxes = Array.from(liveCheckboxes);

   checkboxes.forEach(checkboxEl => {
       const checkboxName = checkboxEl.getAttribute('name');
       const identifier = checkboxName.split('-').pop();
       const tableRow = document.getElementById(`tr-${identifier}`);

        checkboxEl.addEventListener('click', (event) => {
            for(const input of liveCheckboxes){
                const inputName = input.getAttribute('name');
                if(checkboxName !== inputName){
                    input.checked = false; 
                }
            }

            const codigo = tableRow.children[1].children[0].textContent;
            const nome = tableRow.children[2].children[0].textContent;
            
            onPickedSelection({
                codigo: codigo,
                nome: nome
            });
        });
   });
}

function resetSelection(){
    selectionContainer.innerHTML = '';
}

function renderSelection(data){
    const newRow = divRow('outline');

    const col3 = divCol(3);
    const labelInputCodigo = label('input-servico-codigo', 'Código:');
    const inputCodigo = input('servico-codigo', 'input-servico-codigo', true, true);
    inputCodigo.value = data.codigo;

    const col6 = divCol(6);
    const labelInputNome = label('input-servico-nome', 'Nome: ')
    const inputNome = input('servico-nome', 'input-servico-nome', true, true);
    inputNome.value = data.nome;

    const col3b = divCol(3);
    const labelButton = label('remover-selecao-button', 'Clique para:');
    const button = gerarDeletarButton('Remover');
    button.id = 'remover-selecao-button';
    button.type = 'button';

    button.addEventListener('click', (event) => {
        
        const checkbox = document.getElementsByName(`check-pick-servicos-${data.codigo}`)[0];
        checkbox.checked = false;
        
        resetSelection();
    });

    col3.appendChild(labelInputCodigo);
    col3.appendChild(inputCodigo);

    col6.appendChild(labelInputNome);
    col6.appendChild(inputNome);

    col3b.appendChild(labelButton);
    col3b.appendChild(button);

    newRow.appendChild(col3);
    newRow.appendChild(col6);
    newRow.appendChild(col3b);

    const header = headerDivisor('secondary-divisor', 'Serviço para o qual essa nota foi emitida');

    selectionContainer.append(header, newRow);
}
