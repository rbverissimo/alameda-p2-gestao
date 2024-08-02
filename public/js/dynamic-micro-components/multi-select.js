import { getRoute } from "../constants/pattern-names.js";
import { stringToArray } from "../validators/utils.js";
import { gerarDeletarButton } from "./icons.js";
import { divCol, divRow, input, label, spanErrors } from "./layouts.js";
import { call } from "./reactive.js";
import { createOptions } from "./select-option.js";

let dataMap = {};


export function createState(){
      const buttonsMapeados = getAdicionarButtons();
      addStateAdicionarButtons(buttonsMapeados);
}

function getAdicionarButtons(){
      return document.querySelectorAll('[id^="adicionar-button-"]');
}

function addStateAdicionarButtons(adicionarButtons){
      adicionarButtons.forEach(button => {
            const buttonId = button.id;
            const patternName = buttonId.substring('adicionar-button-'.length);
            const wrapper = document.getElementById(`dynamic-wrapper-${patternName}`);
            const mode = wrapper.getAttribute('mode');
            const columnsDivision = stringToArray(wrapper.getAttribute('columns-division'));
            const inputAttrName = wrapper.getAttribute('input-attr-name');


            button.addEventListener('click', (event) => { 
                  event.preventDefault();
            })
            
            button.addEventListener('click', async (event) => {

                  if(!dataMap[patternName]){
                        await getOptionsData(patternName).then(
                              options => {
                                    dataMap[patternName] = options;
                              }).then(
                              render => {
                                    const elementosAgregados = criarElementos(mode, patternName, columnsDivision, inputAttrName);
                                    wrapper.appendChild(elementosAgregados);
                              }).catch(error => {
                                    const msgError = error.response;
                                    showMensagem(msgError.mensagem, msgError.status);
                              })
                  } else {
                        const elementosAgregados = criarElementos(mode, patternName, columnsDivision, inputAttrName);
                        wrapper.appendChild(elementosAgregados); 
                  }
            });
      });
}

function criarElementos(mode, patternName, columnsDivision, inputAttrName){

      const elements = stringToArray(mode, '-');
      const serial = Math.floor(Math.random() * (99999 - 10000 + 1)) + 10000;
      let elementosParaAgregar = [];
            elements.forEach(elemento =>  {
            elementosParaAgregar.push(criar(elemento, patternName, columnsDivision, serial, inputAttrName));
      });

      const containerRow =  criarContainerRow();
      const deleteWidth = columnsDivision[2];
      const delBtn = criarDeletarButton(containerRow, patternName, serial, deleteWidth);

      elementosParaAgregar.push(containerRow, delBtn);

      return agregarElementos(elementosParaAgregar);
}

function agregarElementos(elementos){
      const container = Array.from(elementos).find(el => el.getAttribute('context') === 'container');
      const input = Array.from(elementos).find(el => el.getAttribute('context') === 'input');
      const select = Array.from(elementos).find(el => el.getAttribute('context') === 'select');
      const button = Array.from(elementos).find(el => el.getAttribute('context') === 'button');
      container.appendChild(input);
      container.appendChild(select);
      container.appendChild(button);
      return container;
}

function criar(elementoString, patternName, columnsDivision, serial, inputAttrName){
      if(elementoString.toLowerCase().startsWith('select')){
            const selectWidth = columnsDivision[1];
            return criarSelect(patternName, selectWidth, serial);
      } else if(elementoString.toLowerCase().startsWith('input')) {
            const inputWidth = columnsDivision[0];
            return criarInput(patternName, inputWidth, serial, inputAttrName);
      }
}

function criarInput(patternName, inputWidth, serial, inputAttrName, labelText = 'Digite:'){
      const newDiv = divCol(inputWidth); 
      const newInput = input(inputAttrName, `${patternName}-input-${serial}`, true);
      const newLabel = label(`${patternName}-input-${serial}`, labelText, `label-${inputAttrName}-${serial}`);
      const newSpanErrors = spanErrors(`span-errors-${patternName}-${serial}`);
      newDiv.appendChild(newLabel);
      newDiv.appendChild(newInput);
      newDiv.appendChild(newSpanErrors);

      newDiv.setAttribute('context', 'input');
      return newDiv;

}

function criarContainerRow(){
      const containerRow = divRow('outline');
      containerRow.setAttribute('context', 'container');
      return containerRow;
}

function criarSelect(patternName, selectWidth, serial, labelText = 'Selecione: '){
      let optionsData = dataMap[patternName].options;

      const divCol = document.createElement('div');
      divCol.classList.add(`col-${selectWidth}`);

      const label = document.createElement('label');
      const select = document.createElement('select');

      select.id = label.for = `${patternName}-select-${serial}`;
      select.name = `${patternName}-${serial}`;

      label.id = `label-${select.id}`;
      label.textContent = labelText;

      createOptions(optionsData, select);

      divCol.appendChild(label);
      divCol.appendChild(select);
      divCol.setAttribute('context', 'select');

      return divCol;
}

function criarDeletarButton(divContainerRow, patternName, serial, deleteWidth, labelText = 'Clique para:'){
      const divDelBtn = divCol(deleteWidth);
      const labelDelButton = document.createElement('label');
      labelDelButton.textContent = labelText;
      const deleteButton = gerarDeletarButton();
      deleteButton.addEventListener('click', (event) => {
            divContainerRow.remove();
            event.preventDefault();
      });
      deleteButton.id = labelDelButton.for = `delete-button-${patternName}-${serial}`;
      divDelBtn.appendChild(labelDelButton);
      divDelBtn.appendChild(deleteButton);
      divDelBtn.setAttribute('context', 'button');
      return divDelBtn;
}

function getOptionsData(patternName){
      const url = getRoute(patternName);
      const options = call(url);
      return options;
}