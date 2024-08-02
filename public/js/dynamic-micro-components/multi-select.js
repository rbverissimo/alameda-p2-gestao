import { getRoute } from "../constants/pattern-names.js";
import { stringToArray } from "../validators/utils.js";
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

            const inputWidth = columnsDivision[0];
            const selectWidth = columnsDivision[1];
            const deleteWidth = columnsDivision[2];

            button.addEventListener('click', (event) => {
                  event.preventDefault();
            });

            button.addEventListener('click', async (event) => {
                  await criarElementos(mode, patternName, columnsDivision);
            });
      });
}

async function criarElementos(mode, patternName){
      const elements = stringToArray(mode, '-');
      let elementosParaAgregar = [];
      await elements.forEach(elemento =>  {
            elementosParaAgregar.push(criar(elemento, patternName));
      })
}

async function agregarElementos(elementos){
      
}

async function criar(elementoString, patternName){
      if(elementoString.toLowerCase().startsWith('select')){
            return await criarSelect(patternName);
      } else if(elementoString.toLowerCase().startsWith('input')) {
            return criarInput(patternName);
      }
}

function criarInput(patternName){

}

async function criarContainerRow(){
      const divRow = document.createElement('div');
      divRow.classList.add('row');
      divRow.classList.add('outline');
      return divRow;
}

async function criarSelect(patternName, labelText = 'Selecione: '){
      let optionsData = [];
      if(!data[patternName]){
            const options = await getOptionsData(patternName);
            dataMap[patternName] = options;
      }
      optionsData = dataMap[patternName];

      const counter = Math.floor(Math.random() * (99999 - 10000 + 1)) + 10000;

      const divCol8 = document.createElement('div');
      divCol8.classList.add('col-8');

      const label = document.createElement('label');
      const select = document.createElement('select');

      select.id = label.for = `${patternName}-input-${counter}`;
      select.name = `${patternName}-${counter}`;
      label.id = `label-${select.id}`;
      label.textContent = labelText;
      createOptions(optionsData, select);
      divCol8.appendChild(label);
      divCol8.appendChild(select);

      return divCol8;


}

function criarDeletarButton(){

      
      const divCol3 = document.createElement('div');
      divCol3.classList.add('col-3');

      const labelDelButton = document.createElement('label');
      labelDelButton.textContent = 'Clique para:';
      const deleteButton = gerarDeletarButton();
      deleteButton.addEventListener('click', (event) => {
            divRow.remove();
            event.preventDefault();
      });

      deleteButton.id = labelDelButton.for = `delete-button-${patternName}-${counter}`;
      divCol3.appendChild(labelDelButton);
      divCol3.appendChild(deleteButton);

}

async function getOptionsData(patternName){
      const url = getRoute(patternName);
      const options = await call(url);
      return options;
}