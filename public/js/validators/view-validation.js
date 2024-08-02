import { isStringValida } from "./null-safe.js";

const unidadesFederativas = [
      'AL',
      'AM',
      'RO',
      'AC',
      'RR',
      'PA',
      'AP',
      'TO',
      'MA',
      'PI',
      'CE',
      'RN',
      'PB',
      'PE',
      'BA',
      'MG',
      'MT',
      'MS',
      'GO',
      'SP',
      'ES',
      'PR',
      'SC',
      'RS',
      'RJ',
      'DF'
];

export function apenasNumeros(event) {
            
    // Permissões
    if (event.key === "Backspace" || event.key === "Delete" || event.key === "ArrowLeft" || event.key === "ArrowRight"
          || event.key === "Tab" || event.key === "Escape" || event.key === "Enter") {
          return;
    }

    //Permissões para Ctrl+C Ctrl+A etc
    if ((event.ctrlKey === true || event.metaKey === true) 
          && ((event.key === "a" || event.key === "A") || (event.key === "c" || event.key === "C") 
          || (event.key === "v" || event.key === "V"))) {
          return;
    }

    if (!/^[0-9]$/.test(event.key)) {
          event.preventDefault();
    }
}

export function apenasLetras(event) {

      if (event.key === "Backspace" || event.key === "Delete" || event.key === "ArrowLeft" || event.key === "ArrowRight"
            || event.key === "Tab" || event.key === "Escape" || event.key === "Enter") {
            return;
      }

      const char = String.fromCharCode(event.keyCode);
      const isLetra = char.match(/[a-zA-Z]/);
      if (!isLetra) {
        event.preventDefault();
      }
}

export function isDataValida(dateString) {
      const regexForwardSlahes = /\/+/g;
      const date = dateString.replace(regexForwardSlahes, "-");
      const regex = /^\d{2}-\d{2}-\d{4}$/;
      if(!regex.test(date)){
            return false;
      }

      
      const month = parseInt(dateString.slice(3, 5), 10);
      const day = parseInt(dateString.slice(0, 2), 10);

      return month >= 1 && month <= 12 && day >= 1 && day <= 31;
}

export function isCNPJValido(cnpj){
      const cleanInput = cnpj.replace(/\D/g, '');
      console.log(cleanInput);
      return cleanInput.length === 14;
}

export function isUFValida(uf){
      if(uf.length !== 2){
            return false;
      }
      return unidadesFederativas.includes(uf);
}

export function isValorDinheiroValido(valor){

      if(!isStringValida){
            return false;
      }

      const semCaracterizacaoMoeda = valor.replace(/^R\$/, "");
      const cleanInputAsFloat = parseFloat(semCaracterizacaoMoeda.replace(',', '.')); 
      return cleanInputAsFloat > 0.00;
}

export function isReferenciaValida(referencia){
      const regex = /^\d{4}-\d{2}$/;
      if(!regex.test(referencia)){
            return false;
      }
      const month = parseInt(referencia.slice(5, 7), 10);
      return month > 0 && month < 13;
}

export function isRequired(value){
      return !(value === undefined || value.trim() === '' || value === null)
}


export function inputStateValidation(label, input, span, value, isValid, spanMessage){
      if(!isValid(value)){
            input.classList.add('error-state');
            span.textContent = spanMessage;
            label.style.color = '#fb7a53';
      } else {
            if(input.classList.contains('error-state')){
                  input.classList.remove('error-state');
                  span.textContent = '';
                  label.style.color = '#333';
            }
      }
}