import { isBlank, isStringValida } from "./null-safe.js";

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

export function writeDataMascara(str){
    let resultado = '';
    if(!isStringValida(str)){
        return resultado;
    }
    const [ano, mes, dia] = str.split('-');
    return `${dia}/${mes}/${ano}`;
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

export function writeMascaraValorDinheiro(str){

    let resultado = '';
    if(!isStringValida(str)){
        return resultado;
    }
    const [parteInteira, parteDecimal] = str.split('.');

    if(!parteDecimal) return `R$${parteInteira},00`;

    resultado = `R$${parteInteira},${parteDecimal}`;

    if(parteDecimal.length == 1){
        return resultado+'0';
    }
    
    return resultado;
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
    let resultado = '';
    
    if(!isStringValida(str)){
        return resultado;
    }

    const resizeStr = str.slice(0, 14);

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
 * máscara: ddd.ddd.ddd-dd
 * @param {*} event 
 */
export function cpfMascara(event){
    const inputValue = event.target.value;
    const cleanInput = removerMascara(inputValue);
    const resizedInput = cleanInput.slice(0, 11);
    let resultado = '';

    if(resizedInput.length > 9){
        resultado = resizedInput.slice(0, 3) + '.'
            + resizedInput.slice(3, 6) + '.'
            + resizedInput.slice(6, 9) + '-'
            + resizedInput.slice(9);
    } else if(resizedInput.length > 6 && resizedInput.length <= 9){
        resultado = resizedInput.slice(0, 3) + '.'
            + resizedInput.slice(3, 6) + '.'
            + resizedInput.slice(6);
    } else if(resizedInput.length > 3 && resizedInput.length <= 6 ){
        resultado = resizedInput.slice(0, 3) + '.'
            + resizedInput.slice(3);
    } else {
        resultado = resizedInput;
    }

    event.target.value = resultado;
}

/**
 * 
 * @param {string} str 
 * @returns Uma string com uma máscara de CPF adicionada
 */
export function writeMascaraCpf(str){
    let resultado = '';
    if(!isStringValida(str)){
        return resultado;
    }
    const resizeStr = str.slice(0, 14);

    if(resizeStr.length > 9){
        resultado = resizeStr.slice(0, 3) + '.'
            + resizeStr.slice(3, 6) + '.'
            + resizeStr.slice(6, 9) + '-'
            + resizeStr.slice(9);
    }
    return resultado;
}



/**
 * Esse método recebe um InputEvent e retorna um value
 * de acordo com o tamanho do value do input event. 
 * 
 * Se o input for menor do que 11 dígitos, o algoritimo entende que 
 * se trata de um telefone fixo e monta a máscara: (dd)dddd-dddd
 * Caso seja um input de 11 dígitos, ele montará a máscara: (dd)ddddd-dddd
 * 
 * 
 * @param {InputEvent} event 
 */
export function mascaraTelefone(event){
    const inputValue = event.target.value;
    const cleanInput = removerMascara(inputValue, ['(', ')', '-']);
    const resizedInput = cleanInput.slice(0, 11);

    let resultado = '';

    if(resizedInput.length > 10){
        resultado =  '(' + resizedInput.slice(0, 2) + ')' + resizedInput.slice(2, 7) + '-' + resizedInput.slice(7);
    }
    else if(resizedInput.length > 6 && resizedInput.length <= 10){
        resultado = '(' + resizedInput.slice(0, 2) + ')' + resizedInput.slice(2, 6) + '-' + resizedInput.slice(6);
    } else if(resizedInput.length > 2 && resizedInput.length <= 6){
        resultado = '(' + resizedInput.slice(0, 2) + ')' + resizedInput.slice(2);
    } else {
        resultado = resizedInput;
    }

    event.target.value = `${resultado}`;
}

export function writeMascaraTelefone(strInput){
    let resultado = '';
    if(!isStringValida(strInput)){
        return resultado;
    }

    const cleanInput = removerMascara(strInput, ['(', ')', '-']);
    const resizedInput = cleanInput.slice(0, 11);

    if(resizedInput.length > 10){
        resultado =  '(' + resizedInput.slice(0, 2) + ')' + resizedInput.slice(2, 7) + '-' + resizedInput.slice(7);
    } else if(resizedInput.length > 6 && resizedInput.length <= 10){
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
    const resizedInput = str.slice(0, 8);
    let resultado = resizedInput;

    if(resizedInput.length > 6){
        resultado = resizedInput.slice(0, 5) + '-' + resizedInput.slice(5);
    }

    return resultado;
}


/**
 * 
 * @param {InputEvent} event 
 * @returns 0 ao value do Input se o valor digitado for maior do que 1
 */
export function mascaraFatorDivisor(event){
    const fator = event.target.value;
    const fatorNormalizado = fator.replace(/[^0-9]/g, "");
    const arrFator = fatorNormalizado.split("");
    let resultado = '';
    
    if(arrFator[0] > 1){
          event.target.value = 0;
          return;
    }

    
    for(let i = 0; i < arrFator.length; i++){
          if(i === 1){
                resultado += '.';
          }
          resultado += arrFator[i];
    }
    

    event.target.value = resultado;  
}


export function swapPontosVirgulas(valor){
    if (valor.includes('.')) {
          return valor.replace(/\./g, ',');
    } else if(valor.includes(',')) {
          return valor.replace(/,/g, '.');
    } else {
          return valor; 
    }
}

/**
 * 
 * @param {string} strValue 
 * @param {string[]} charsToRemove
 * @returns uma string limpa dos caractéres passados no array charsToRemove
 */
function removerMascara(strValue, charsToRemove = ['.', '-', '(', ')', '/']){
    let cleanString = "";
  for (let i = 0; i < strValue.length; i++) {
    const char = strValue[i];
    if (!charsToRemove.includes(char)) {
      cleanString += char;
    }
  }
  return cleanString;
}


/**
 * Esse método torna uma referência com 6 digitos formatada para AAAAmm
 * 
 * @param {*} referencia o parâmetro que será mascarado
 * @returns o parâmetro recebido no formato AAAA-mm 
 */
export function colocaMascaraReferencia(referencia){
    if(referencia.length != 6) return referencia; 

    const ano = referencia.substring(0,4);
    const mes = referencia.substring(4);

    return `${ano}-${mes}`;
}


/**
 * Esse método adiciona uma máscara de referência ao input. 
 * Não é necessário lidar com inputs que não sejam números, nem com o hifen
 * que acontece no meio da máscara. Máscara resultado: AAAA-mm. 
 * 
 * @param {*} event 
 */
export function anoMesMascara(event) {
    let inputValue = event.target.value;

    inputValue = inputValue.replace(/\D/g, '');
    inputValue = inputValue.slice(0, 6);
    
    if (inputValue.length > 4) {
          inputValue = inputValue.slice(0, 4) + '-' + inputValue.slice(4);
    }

    event.target.value = inputValue;
}

/**
 * 
 * @param {*} str 
 * @returns 
 */
export function writeMascaraContadaQuitada(str){
    const valid = ['S', 's', 'N', 'n'];
    if(!valid.includes(str)){
        return;
    }
    return str === 'S' ? 'Sim' : 'Não';
}
