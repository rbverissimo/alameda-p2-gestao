import { call } from "./reactive.js";
import { createOptions } from "./select-option.js";

let dataMap = {};

export function getAdicionarButtons(){
      return document.querySelectorAll('[id^="adicionar-button-"]');
}

export function addStateAdicionarButtons(adicionarButtons, optionsData){
      adicionarButtons.forEach(button => {
            const buttonId = button.id;
            const patternName = buttonId.substring('adicionar-button-'.length);
            const wrapper = document.getElementById(`dynamic-wrapper-${patternName}`);

            button.addEventListener('click', (event) => {
                  const newDivRow = criarSelect(patternName);
                  event.preventDefault();
            });
      });
}

export function criarSelect(patternName, labelText = 'Selecione: ', optionsData = []){

      if(optionsData.length === 0){

      }

      const counter = Math.floor(Math.random() * (99999 - 10000 + 1)) + 10000;

      const divRow = document.createElement('div');
      divRow.classList.add('row');
      divRow.classList.add('outline');

      const divCol8 = document.createElement('div');
      divCol8.classList.add('col-8');

      const divCol3 = document.createElement('div');
      divCol3.classList.add('col-3');

      const label = document.createElement('label');
      const select = document.createElement('select');

      select.id = label.for = `${patternName}-input-${counter}`;
      select.name = `${patternName}-${counter}`;
      label.id = `label-${select.id}`;
      label.textContent = labelText;
      createOptions(optionsData, select);
      divCol8.appendChild(label);
      divCol8.appendChild(select);

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

      divRow.appendChild(divCol8);
      divRow.appendChild(divCol3);

      return divRow;
}

function getOptionsData(patternName){
      const url = '';
      const options = call(url);
}