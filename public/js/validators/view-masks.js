import { isStringValida } from "./null-safe.js";

/**
 * Monta uma máscara de acordo com o evento de Input recebido
 * Essa máscara é uma máscara de data tal qual 01/01/2024
 * 
 * @param {InputEvent} event 
 */
export function dataMascara(event) {
    let inputValue = event.target.value;
    inputValue = inputValue.replace(/\D/g, '');
    inputValue = inputValue.slice(0, 8);

    if (inputValue.length >= 6) {
          inputValue = inputValue.slice(0, 2) + '/' + inputValue.slice(2, 4) + '/' + inputValue.slice(4);
    }

    event.target.value = inputValue;
}

export function mascaraValorDinheiro(event){
    const input = event.target.value.trim();
    let resultado = '';
    const semCaracterizacaoMoeda = input.replace(/^R\$/, "");
    resultado = +semCaracterizacaoMoeda.replace(',', ''); 

    if(resultado < 100){
          let numerosPequenos = resultado;
          if(resultado < 10){
                numerosPequenos = `0${numerosPequenos}`;
          }
          resultado = `0,${numerosPequenos}`;
    } else {
          resultado = resultado.toString();
          const ultimosDoisDigitos = resultado.slice(-2);
          const parteNaoDecimal = resultado.slice(0, -2);


          resultado = `${parteNaoDecimal},${ultimosDoisDigitos}`;
    }

    event.target.value = `R$${resultado}`;
    
}

/**
 * Esse método coloca uma máscara de acordo com 
 * o padrão de 18 dígitos de máscara de CNPJ usado
 * exclusivamente até 2025
 * 
 * @param {InputEvent} event 
 */
export function mascaraCnpj(event){
    //12.345.678/0001-00
    const input = event.target.value;
    const cleanInput = removerMascara(input, ['.', '/', '-']);
    const resizedInput = cleanInput.slice(0, 14);
    let resultado = '';

    if(resizedInput.length > 12){
        resultado = resizedInput.slice(0, 2) + '.' 
            + resizedInput.slice(2, 5) 
            + '.' + resizedInput.slice(5, 8) 
            + '/' + resizedInput.slice(8, 12) 
            + '-' + resizedInput.slice(12);
    } else if(resizedInput.length > 8 && resizedInput.length <= 12){
        resultado = cleanInput.slice(0, 2) + '.' 
            + resizedInput.slice(2, 5) 
            + '.' + resizedInput.slice(5, 8) 
            + '/' + resizedInput.slice(8); 
    } else if(resizedInput.length > 5 && resizedInput.length <= 8){
        resultado = resizedInput.slice(0, 2) + '.' 
            + resizedInput.slice(2, 5) 
            + '.' + resizedInput.slice(5); 
    } else if(resizedInput.length > 2 && resizedInput.length <= 5){
        resultado = resizedInput.slice(0, 2) + '.' + resizedInput.slice(2);
    } else {
        resultado = resizedInput;
    }

    event.target.value = `${resultado}`;

}

export function writeMascaraCnpj(str){
    if(!isStringValida(str)){
        return;
    }
    const resizeStr = str.slice(0, 14);
    let resultado = '';

    if(resizeStr.length > 12){
        resultado = resizeStr.slice(0, 2) + '.' 
            + resizeStr.slice(2, 5) 
            + '.' + resizeStr.slice(5, 8) 
            + '/' + resizeStr.slice(8, 12) 
            + '-' + resizeStr.slice(12);
    }
    return resultado;
}


/**
 * Esse método recebe um InputEvent e retorna um value
 * de acordo com a máscara (dd)dddd-dddd que representa um 
 * número de telefone
 * 
 * @param {InputEvent} event 
 */
export function mascaraTelefoneFixo(event){
    const inputValue = event.target.value;
    const cleanInput = removerMascara(inputValue, ['(', ')', '-']);
    const resizedInput = cleanInput.slice(0, 10);

    let resultado = '';

    if(resizedInput.length > 6){
        resultado = '(' + resizedInput.slice(0, 2) + ')' + resizedInput.slice(2, 6) + '-' + resizedInput.slice(6);
    } else if(resizedInput.length > 2 && resizedInput.length <= 6){
        resultado = '(' + resizedInput.slice(0, 2) + ')' + resizedInput.slice(2);
    } else {
        resultado = resizedInput;
    }

    event.target.value = `${resultado}`;
}

export function writeMascaraTelefoneFixo(strInput){
    if(!isStringValida(strInput)){
        return;
    }
    const resizedInput = strInput.slice(0, 10);
    let resultado = '';

    if(resizedInput.length > 6){
        resultado = '(' + resizedInput.slice(0, 2) + ')' + resizedInput.slice(2, 6) + '-' + resizedInput.slice(6);
    }

    return resultado;
}

/**
 * CEP ddddd-ddd
 * 
 * @param {*} event 
 */
export function mascaraCEP(event){
    const inputValue = event.target.value;
    const cleanInput = removerMascara(inputValue, ['-']);
    const resizedInput = cleanInput.slice(0, 8);

    let resultado = resizedInput;

    if(resizedInput.length > 5){
        resultado = resizedInput.slice(0, 5) + '-' + resizedInput.slice(5);
    } 

    event.target.value = `${resultado}`
}

export function writeMascaraCEP(str){
    if(!isStringValida(str)){
        return;
    }
    const resizedInput = strInput.slice(0, 8);
    let resultado = resizedInput;

    if(resizedInput.length > 6){
        resultado = resizedInput.slice(0, 5) + '-' + resizedInput.slice(5);
    }

    return resultado;
}


/**
 * 
 * @param {string} strValue 
 * @param {string[]} charsToRemove
 * @returns uma string limpa dos caractéres passados no array charsToRemove
 */
function removerMascara(strValue, charsToRemove){
    let cleanString = "";
  for (let i = 0; i < strValue.length; i++) {
    const char = strValue[i];
    if (!charsToRemove.includes(char)) {
      cleanString += char;
    }
  }
  return cleanString;
}