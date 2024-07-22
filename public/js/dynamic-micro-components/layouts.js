export const divisorTypes = {
    PRIMARY: 'primary-divisor',
    SECONDARY: 'secondary-divisor',
    SPECIAL: 'special-divisor',
    ALERT: 'alert-divisor'
};


export function divRow(){
    const div = document.createElement('div');
    div.classList.add('row');
    return div;
}

export function divCol(columns){
    const div = createElement('div');
    div.classList.add(`col-${columns}`);
    return div; 
}

export function lightDashboard(){
    const div = createElement('div');
    div.classList.add('dashboard');
    div.classList.add('light-dashboard');
    return div;
}

export function headerDivisor(divisor, text){
    const div = createElement('div');
    div.classList.add('divisor-header');
    div.classList.add(divisor);
    div.textContent = text; 
    return div;
}

export function input(name, id, required = false){
    const input = document.createElement('input');
    input.name = name;
    input.id = id;
    input.required = required;
}

export function label(forElement, text, id = null){
    const label = document.createElement('label');
    label.id = id;
    label.for = forElement;
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
 * para serem renderizados dinamicamente na tela. Esse método segue algumas convencoes
 * para nomeacao de IDs e outros atributos dependentes do mesmo.
 * 
 * @param {HTMLElement} divRow 
 * @param {string} name 
 * @param {string} textLabel 
 * @param {boolean} required 
 * @returns uma div.col com os elementos 
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
