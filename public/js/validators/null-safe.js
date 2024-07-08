export function isNullOrUndefined(value){
    return value === null || value === undefined;
}

/**
 * Esse método checa a validade de um objeto como não null e não undefined
 * 
 * @param {any} value 
 * @returns boolean se o objeto for ao mesmo tempo não nulo e não undefined
 */
export function isNotNullOrUndefined(value){
    return value !== null && value !== undefined;
}

export function isBlank(value){
    let trimmedString = value.trim();
    return trimmedString === '';
}

export function isArrayEmpty(array){
    return array.length === 0 || array.length === undefined;
}

/**
 * Checa se a string fornecida no parâmetro não é
 * null, undefined ou está vazia
 * 
 * @param {string} str 
 * @returns 
 */
export function isStringValida(str){
    return isNotNullOrUndefined(str) && !isBlank(str);
}