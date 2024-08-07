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
export function gerarInputLabelSpanErrors(divCol, name, textLabel, required = false){
    const label = label(`${name}-input`, textLabel, `label-${name}-input`);
    const input = input(name, `${name}-input`, required);
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
