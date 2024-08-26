import { gerarDeletarButton, gerarInfoButton } from "./icons.js";

export const divisorTypes = {
    PRIMARY: 'primary-divisor',
    SECONDARY: 'secondary-divisor',
    SPECIAL: 'special-divisor',
    ALERT: 'alert-divisor'
};

/**
 * Esse método recebe qualquer número de strings que definem classes de CSS
 * para serem adicionadas à div
 * 
 * @param  {...string} cssClasses 
 * @returns um elmento div.row com as classes passadas no parâmetro adicionadas
 */
export function divRow(...cssClasses){
    const div = document.createElement('div');
    div.classList.add('row');
    cssClasses.forEach(css => div.classList.add(css));
    return div;
}

export function divCol(columns){
    const div = document.createElement('div');
    div.classList.add(`col-${columns}`);
    return div; 
}

export function lightDashboard(){
    const div = document.createElement('div');
    div.classList.add('dashboard');
    div.classList.add('light-dashboard');
    return div;
}

export function headerDivisor(divisor, text){
    const div = document.createElement('div');
    div.classList.add('divisor-header');
    div.classList.add(divisor);
    div.textContent = text; 
    return div;
}

export function input(name, id, required = false, readonly = false){
    const input = document.createElement('input');
    input.name = name;
    input.id = id;
    input.required = required;
    input.readOnly = readonly;
    return input;
}

export function label(forElement, text, id = null){
    const label = document.createElement('label');
    label.id = id;
    label.htmlFor = forElement;
    label.innerHTML = text;
    return label; 
}

export function spanErrors(id){
    const span = document.createElement('span');
    span.classList.add('errors-highlighted');
    span.id = id;
    return span;
}

export function td(text, ...cssClasses){
    const td = document.createElement('td');
    const span = document.createElement('span');
    span.textContent = text;
    span.classList.add(...cssClasses); 

    td.appendChild(span);
    return td;
}

export function tableRow(dataParams, acoesElements){

    const tr = document.createElement('tr');
    tr.classList.add('table-row');
    dataParams.forEach((el) => {
        tr.appendChild(td(el.text, el.cssClasses.split(',')));
    });

    tr.appendChild(acoesElements);
    return tr;
}

export function tableAcoesListaInquilinos(idInquilino){
    const td = document.createElement('td');
    td.innerHTML = '<img class="crud-icon" src="/icons/edit-icon.svg" alt="mais informações">' 
    + '<img class="crud-icon" src="/icons/info-icon.svg" alt="detalhar inquinlino">';

    const imgInfo = td.childNodes[0];
    imgInfo.addEventListener('click', () => {
        redirecionarPara(`/inquilino/${idInquilino}`);
    });
    const imgEdit = td.childNodes[1];
    imgEdit.addEventListener('click', () => {
        redirecionarPara(`/inquilino/detalhe/${idInquilino}`);
    });


    return td; 
}

/**
 * Esse é um atalho para construir um label, input e span em conjunto
 * para serem renderizados dinamicamente na tela. Esse método segue algumas conveções
 * para nomeacao de IDs e outros atributos dependentes do mesmo.
 * A divCol passada no primeiro parâmetro é retornada com os elementos criados adicionados.
 * 
 * @param {HTMLElement} divRow 
 * @param {string} name 
 * @param {string} textLabel 
 * @param {boolean} required 
 * @returns uma div.col com os elementos adicionados
 */
export function gerarInputLabelSpanErrors(divCol, name, textLabel, required = false, readonly = false){
    const label = label(`${name}-input`, textLabel, `label-${name}-input`);
    const input = input(name, `${name}-input`, required, readonly);
    const span = spanErrors(`span-errors-${name}`);
    divCol.appendChild(label);
    divCol.appendChild(input);
    divCol.appendChild(span);
    return divCol;
}

export function gerarInputAcoes(inputName, verificador, required, readonly){

    const newRow = divRow('outline');
    const divCol6 = divCol(6);
    const divDelIcon = divCol(3);
    const divInfoIcon = divCol(3);

    const newInput = input(`${inputName}-${verificador}`, `${inputName}-input-${verificador}`, required, readonly);
    const delIcon = gerarDeletarButton();
    const infoIcon = gerarInfoButton();

    divCol6.appendChild(newInput);
    divDelIcon.appendChild(delIcon);
    divInfoIcon.appendChild(infoIcon);

    newRow.appendChild(divCol6);
    newRow.appendChild(divInfoIcon);
    newRow.appendChild(divDelIcon);

    return newRow;
}

/**
 * Esse método busca de forma recursiva por uma tag como <input> <select> <textarea> 
 * passada no primeiro parâmetro a partir de um elemento passado no segundo parâmetro.
 * 
 * @param {*} tagToFind 
 * @param {*} element 
 * @returns 
 */
export function findElements(tagToFind, element){

    const foundElArr = [];
    if(element.nodeType === Node.ELEMENT_NODE){
        if(element.tagName.toLowerCase() === tagToFind){
            foundElArr.push(element);
        }
    }

    for (let i = 0; i < element.childNodes.length; i++) {
        foundElArr.push(...findElements(tagToFind, element.childNodes[i]));
        
    }

    return foundElArr;

}
