import { cancelarButton, confirmarButton, loadMessages, toggleModal } from "./partials/simple-modal.js";
import { toggleOverlay } from "./partials/spinner.js";

export function setLiveRoute(rota){
      localStorage.setItem('liveRoute', rota);

}

export function setOldRoute(rota){
      localStorage.setItem('oldRoute', rota);
}

export function getOldRoute(){
      return localStorage.getItem('oldRoute');
}

export function getLiveRoute(){
      return localStorage.getItem('liveRoute');
}

export function navigateToLastRoute(){
      window.location.href = getOldRoute();
}

window.addEventListener("DOMContentLoaded", function(){
      if(isNullOrUndefined(getLiveRoute()) || isBlank(getLiveRoute())){
            setLiveRoute(window.location.href);
      } else {

            if(getLiveRoute() === window.location.href) return; 
            
            setOldRoute(getLiveRoute());
            setLiveRoute(window.location.href);
      }
      
});

document.addEventListener("DOMContentLoaded", () => {
      displayMensagemErro();
});


export function showMensagem(mensagem, tipo, temporizador = 4000){

      let mensagemElement = undefined; 

      if(tipo === 'sucesso'){
            mensagemElement = document.getElementById('sucesso-mensagem');
            document.getElementById('mensagem-container').style.backgroundColor = '#DFF2BF'; 
      } else if(tipo === 'falha') {
            mensagemElement = document.getElementById('falha-mensagem');
            document.getElementById('mensagem-container').style.backgroundColor = '#FFCDD2'; 
      } else if(tipo === 'neutra') {
            mensagemElement = document.getElementById('neutra-mensagem');
            document.getElementById('mensagem-container').style.backgroundColor = '#DBD8F0';
      }
      mensagemElement.textContent = mensagem;
      showMensagemContainer(temporizador);
      
}

function showMensagemContainer(temporizador) {
      const messageContainer = document.getElementById('mensagem-container');
      messageContainer.style.display = 'block';

      setTimeout(() => {
            messageContainer.style.display = 'none';
            document.getElementById('sucesso-mensagem').textContent = '';
            document.getElementById('falha-mensagem').textContent = '';
            document.getElementById('neutra-mensagem').textContent = '';
      }, temporizador);
}

/**
 * Esse método busca pela div de erros retornados pela Session.
 * Uma vez encontrada ele transmite a string para o modal de mensagens
 * através do método showMensagem();
 */
export function displayMensagemErro(){
      const divErros = document.getElementById('mensagem-erro-session');
      if(divErros != null){
            showMensagem(divErros.textContent, 'falha', 5000);
      }
}


export function apenasNumeros(event) {
            
      // Allow: backspace, delete, tab, escape, enter
      if (event.key === "Backspace" || event.key === "Delete" || event.key === "ArrowLeft" || event.key === "ArrowRight"
            || event.key === "Tab" || event.key === "Escape" || event.key === "Enter") {
            return;
      }

      if ((event.ctrlKey === true || event.metaKey === true) 
            && ((event.key === "a" || event.key === "A") || (event.key === "c" || event.key === "C") 
            || (event.key === "v" || event.key === "V"))) {
            return;
      }

      // Testa se apenas números estão sendo usados
      if (!/^[0-9]$/.test(event.key)) {
            event.preventDefault();
      }
}

/**
 * 
 * @param {InputEvent} event 
 */
export function dataMascara(event) {
      let inputValue = event.target.value;
      inputValue = inputValue.replace(/\D/g, '');
      inputValue = inputValue.slice(0, 8);

      if (inputValue.length >= 6) {
            inputValue = inputValue.slice(0, 2) + '-' + inputValue.slice(2, 4) + '-' + inputValue.slice(4);
      }

      event.target.value = inputValue;
}

export function isDataValida(dateString) {
      const regex = /^\d{2}-\d{2}-\d{4}$/;
      if(!regex.test(dateString)){
            return false;
      }

      
      const month = parseInt(dateString.slice(3, 5), 10);
      const day = parseInt(dateString.slice(0, 2), 10);

      return month >= 1 && month <= 12 && day >= 1 && day <= 31;
}

/**
 * Recebe um evento do tipo Input e extrai dele seu valor
 * O valor recebe uma máscara de acordo com a seguinte: ddddd-ddd
 * Essa máscara é retornada ao evento à medida que o usuário digita
 * 
 * @param {InputEvent} event 
 */
export function cepMascara(event){
      let inputValue = event.target.value;
      inputValue = inputValue.replace(/\D/g, '');

      // Define o tamanho máximo de retorno
      inputValue = inputValue.slice(0, 8);

      if(inputValue.length > 4){
            inputValue = inputValue.slice(0, 5) + '-' + inputValue.slice(5);
      }

      event.target.value = inputValue;

}

/**
 * Esse método recebe um evento do tipo Input e volta um value
 * para esse evento formando a máscara: (dd)ddddd-dddd
 * 
 * @param {InputEvent} event 
 */
export function telefoneCelularMascara(event){
      let inputValue = event.target.value;

      inputValue = inputValue.slice(0, 14);

      if (inputValue.length === 3) {
            inputValue = '(' + inputValue.slice(0, 2) + ')' + inputValue.slice(2);
      }

      if(inputValue.length > 8){
            inputValue = '(' + inputValue.slice(1, 3) + ')' + inputValue.slice(4, 9) + '-' + inputValue.slice(10);
      }

      event.target.value = inputValue;
}

/**
 * Esse método recebe um InputEvent e retorna um value
 * de acordo com a máscara (dd)dddd-dddd que representa um 
 * número de telefone
 * 
 * @param {InputEvent} event 
 */
export function telefoneFixoMascara(event){
      let inputValue = event.target.value;

      inputValue = inputValue.slice(0, 13);

      if (inputValue.length === 3) {
            inputValue = '(' + inputValue.slice(0, 2) + ')' + inputValue.slice(2);
      }

      if(inputValue.length > 7){
            inputValue = '(' + inputValue.slice(1, 3) + ')' + inputValue.slice(4, 8) + '-' + inputValue.slice(9);
      }

      event.target.value = inputValue;
}

/**
 * máscara: ddd.ddd.ddd-dd
 * @param {*} event 
 */
export function cpfMascara(event){
      let inputValue = event.target.value;

      inputValue = inputValue.slice(0, 14);

      if(inputValue.length === 3){
            inputValue = inputValue.slice(0 , 3) + '.' + inputValue.slice(3, 7);
      }

      if(inputValue.length === 7){
            inputValue = inputValue.slice(0 , 7) +
            '.' + inputValue.slice(8, 11);
      }

      if(inputValue.length > 10 ){
            inputValue = inputValue.slice(0, 11) + '-' + inputValue.slice(12);
      }

      event.target.value = inputValue;
}

export function anoMesMascara(event) {
      let inputValue = event.target.value;

      // Remove non-numeric characters
      inputValue = inputValue.replace(/\D/g, '');

      // Ensure the input is not longer than 6 characters
      inputValue = inputValue.slice(0, 6);

      // Format the input as YYYY-MM
      if (inputValue.length >= 4) {
            inputValue = inputValue.slice(0, 4) + '-' + inputValue.slice(4);
      }

      // Update the input value
      event.target.value = inputValue;
}

/**
 * Esse método avalia se uma referência é válida.
 * 
 * @param {string} referencia 
 * @returns true, caso os meses da referência estejam corretos
 */
export function isReferenciaValida(referencia){
      const regex = /^\d{4}-\d{2}$/;
      if(!regex.test(referencia)){
            return false;
      }
      const month = parseInt(referencia.slice(5, 7), 10);
      return month > 0 && month < 13;
}

export function handleBackspaceHyphen(event) {
      // Allow backspace even if the value ends with a hyphen
      if (event.key === 'Backspace' && (event.target.value.endsWith('-')
            || event.target.value.endsWith(',')
            || event.target.value.endsWith('.') 
            || event.target.value.endsWith('(') 
            || event.target.value.endsWith(')'))) {
            event.target.value = event.target.value.slice(0, -1);
      }
}

export function mascaraCurrencyBr(event) {
      let inputValue = event.target.value;

      inputValue = inputValue.replace(/[^\d,]/g, '');

      // Replace dots with commas
      inputValue = inputValue.replace(/\./g, ',');

      // Remove commas in the thousands
      inputValue = inputValue.replace(/(\d)(,)(\d{3})/g, '$1$3');

      // Update the input value
      event.target.value = inputValue;
}

export function mascaraValoresEmReal(event){
      const valor = event.target.value; 
      let resultado = '';
      resultado = valor.replace(/^R\$/, "");
      

      if(resultado.includes(',')){
            let[parteInteira, parteDecimal] = resultado.split(',');

            parteInteira = parteInteira.replace(/[^0-9]/g, "");

            if(parteInteira === ''){
                  parteInteira = 0;
            }

            if(parteInteira > 999){
                  parteInteira = agrouparMilhares(parteInteira);
            }

            parteDecimal = parseInt(parteDecimal);
            if(parteDecimal > 9 && parteDecimal < 100){
                  resultado = parteInteira + ',' + parteDecimal;
            } else if(parteDecimal !== 0 && parteDecimal < 10){
                  resultado = parteInteira + ',0' + parteDecimal;
            } else {
                  resultado = parteInteira + ',' + '00';
            }
      } else {
            resultado = '0,00';
      }

      event.target.value = `R$${resultado}`;
}

function agrouparMilhares(valor){
      const arrNumeros = valor.split("").reverse();
      let resultado = '';

      for(let i = 0; i < arrNumeros.length; i++){
            if(i > 0 && i % 3 === 0){
                  resultado += '.';
            }
            resultado += arrNumeros[i];
      }

      return resultado.split("").reverse().join("");
} 

export function isNullOrUndefined(value){
      return value === null || value === undefined;
}

export function isNotNullOrUndefined(value){
      return value !== null || value !== undefined;
}

export function isBlank(value){
      return value === '';
}

export function isArrayEmpty(array){
      return array.lenght === 0 || array.length === undefined;
}

export function isStringValida(string){
      return isNotNullOrUndefined(string) && !isBlank(string);
}

export function redirecionarPara(route){
      window.location.href = route;
}

export function deletarRegistro(route, idRegistro){

      const textMensagemModal = `Deseja mesmo excluir o registro ${idRegistro} ?`;
      loadMessages(textMensagemModal);

      toggleModal();

      cancelarButton.addEventListener('click', (event) => {
            toggleModal();
            confirmarButton.removeEventListener('click', (event) => {}, {once: true});
            event.stopImmediatePropagation();
      }, {once: true });

      confirmarButton.addEventListener('click', (event) => {
            const loadingOverlay = document.getElementById('loading-overlay');
            fetch(route)
                .then(response => {
                    toggleOverlay(loadingOverlay); 
                    if(!response.ok){
                        throw new Error('Não foi possível se conectar com o servidor. ');
                    }
                    return response.json();
                })
                .then(data => {
                    toggleOverlay(loadingOverlay);
                    console.log(data);
                    if(data > 0){
                        showMensagem(`Registro ${idRegistro} deletado com sucesso!`, 'sucesso');      
                    }
                })
                .catch(error => {
                    toggleOverlay(loadingOverlay);
                    console.error('Não foi possível concluir a operação', error);
                }).then(complete => {
                    toggleModal();
                    setTimeout(location.reload(), 8000);  
                });
                event.stopImmediatePropagation();
        } , {once: true});
      
}

/**
 * 
 * @param {*} referencia que será convertida, recebida em 6 dígitos no formato AAAAdd
 * @returns retorna uma string formatada em mm/AAAA
 */
export function converterReferencia(referencia){
      const ano = referencia.slice(0, 4);
      const mes = converterMes(referencia.slice(4));

      return mes+'/'+ano;

}

/**
 * 
 * @param {*} stringOriginal com os caracteres que serão removidos
 * @param {*} caracteresRemoviveis aqueles caracteres que precisam ser retirados da string
 * @returns a string limpa de caracteres
 */
export function removerCaracteres(stringOriginal, caracteresRemoviveis){
      const regex = new RegExp(`[${caracteresRemoviveis}]`, 'g');
      return stringOriginal.replace(regex, '');
}

export function converterMes(mes){

      let resultado = ''
      switch(mes){
            case '01':
            case '1':
                  resultado = 'Jan'
                  break;
            case '02':
            case '2':
                  resultado = 'Fev'
                  break;
            case '03':
            case '3':
                  resultado = 'Março'
                  break;
            case '04':
            case '4':
                  resultado = 'Abril'
                  break;
            case '05':
            case '5':
                  resultado = 'Maio'
                  break;
            case '06':
            case '6':
                  resultado = 'Junho'
                  break;
            case '07':
            case '7':
                  resultado = 'Julho'
                  break;
            case '08':
            case '8':
                  resultado = 'Agosto'
                  break;
            case '09':
            case '9':
                  resultado = 'Set'
                  break;
            case '10':
                  resultado = 'Out'
                  break;
            case '11':
                  resultado = 'Nov'
                  break;
            case '12':
                  resultado = 'Dez'
                  break;
            default:
                  resultado = 'N/A'
      }

      return resultado; 
}



export function navigateBack(rotaAnterior) {
      const voltarTrigger = document.getElementById('voltar-wrapper');
      voltarTrigger.addEventListener('click', function(){
          window.location.href = rotaAnterior; 
      });
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

export function showDataFormatadaDMY(data){
      const[ano, mes, dia] = data.split('-');
      return `${dia}-${mes}-${ano}`;
}

export function criarSearchInputEvent(obj, dominio){
      const event = new CustomEvent('onSearchInputsAvailable', {
            detail: obj
      });
      event.dominio = dominio;
      return event;
}

/**
 * 
 * @param {*} obj
 * @param {*} dominio 
 * @returns CustomEvent('onSearchInputSelected')
 */
export function criarSelectedSearchInputEvent(obj, dominio){
      const selectedEvent = new CustomEvent('onSearchInputSelected', {
            detail: obj
      });
      selectedEvent.dominio = dominio;
      return selectedEvent;
}

window.showMensagem = showMensagem;
window.apenasNumeros = apenasNumeros;
window.anoMesMascara = anoMesMascara;
window.dataMascara = dataMascara;
window.mascaraCurrencyBr = mascaraCurrencyBr;
window.isNotNullOrUndefined = isNotNullOrUndefined;
window.isBlank = isBlank;
window.handleBackspaceHyphen = handleBackspaceHyphen;
window.redirecionarPara = redirecionarPara;
window.converterMes = converterMes;
window.converterReferencia = converterReferencia;
window.navigateBack = navigateBack;
window.swapPontosVirgulas = swapPontosVirgulas;
window.showDataFormatadaDMY = showDataFormatadaDMY;
window.navigateToLastRoute = navigateToLastRoute;
window.criarSearchInputEvent = criarSearchInputEvent;
window.criarSelectedSearchInputEvent = criarSelectedSearchInputEvent;
window.deletarRegistro = deletarRegistro;
window.telefoneFixoMascara = telefoneFixoMascara;
window.telefoneCelularMascara = telefoneCelularMascara;