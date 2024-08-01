import { createOptions } from "./select-option.js";




export function criarSelect(prefix, labelText = 'Selecione: ', optionsData){

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

      select.id = label.for = `${prefix}-input-${counter}`;
      select.name = `${prefix}-${counter}`;
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

      deleteButton.id = labelDelButton.for = `delete-button-${prefix}-${counter}`;
      divCol3.appendChild(labelDelButton);
      divCol3.appendChild(deleteButton);

      divRow.appendChild(divCol8);
      divRow.appendChild(divCol3);

      return divRow;
}