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