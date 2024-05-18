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
      if (event.key === "Backspace" || event.key === "Delete" || 
            event.key === "Tab" || event.key === "Escape" || event.key === "Enter") {
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

export function dataMascara(event) {
      let inputValue = event.target.value;

      // Remove caracteres não numéricos
      inputValue = inputValue.replace(/\D/g, '');

      // Garante que o input não em mais do que 8 dígitos
      inputValue = inputValue.slice(0, 8);

      // Formata a máscara de AAAA-mm-dd
      if (inputValue.length >= 6) {
            inputValue = inputValue.slice(0, 2) + '-' + inputValue.slice(2, 4) + '-' + inputValue.slice(4);
      }

      // Coloca no input o tratamento feito pela máscara
      event.target.value = inputValue;
}

export function isDataValida(dateString) {
      const regex = /^\d{2}-\d{2}-\d{4}$/;
      if(!regex.test(dateString)){
            return false;
      }

      //20-12-2023
      //0123456789
      
      const month = parseInt(dateString.slice(3, 5), 10);
      const day = parseInt(dateString.slice(0, 2), 10);

      // Check if month is between 1 and 12, and day is between 1 and 31
      return month >= 1 && month <= 12 && day >= 1 && day <= 31;
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

export function handleBackspaceHyphen(event) {
      // Allow backspace even if the value ends with a hyphen
      if (event.key === 'Backspace' && event.target.value.endsWith('-')) {
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
 *
 * Esse método busca pelas referências fornecidas no carrossel 
 * e adiciona máscara a cada uma delas;
 */
export function mascaraReferenciaSlider(){
      const container = document.querySelector('.carousel-container');
      if(container){
          const itensCarrossel = container.querySelectorAll('.slide-carousel');
          itensCarrossel.forEach(item => {
              const referenciaItem = item.textContent.trim();
              const referenciaComMascara = colocaMascaraReferencia(referenciaItem);
              item.textContent = referenciaComMascara;
          });
      } else {
          throw new Error('Erro ao ler a referência. ');
      }
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