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