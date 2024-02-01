

export function showMensagem(mensagem, tipo){

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
      showMensagemContainer();
      
}

function showMensagemContainer() {
      const messageContainer = document.getElementById('mensagem-container');
      messageContainer.style.display = 'block';

      setTimeout(() => {
            messageContainer.style.display = 'none';
            document.getElementById('sucesso-mensagem').textContent = '';
            document.getElementById('falha-mensagem').textContent = '';
            document.getElementById('neutra-mensagem').textContent = '';
      }, 3500);
}

export function apenasNumeros(event) {
            
      // Allow: backspace, delete, tab, escape, enter
      if (event.key === "Backspace" || event.key === "Delete" || event.key === "Tab" || event.key === "Escape" || event.key === "Enter") {
            return;
      }

      // Allow: Ctrl+A, Command+A
      if ((event.ctrlKey === true || event.metaKey === true) && ((event.key === "a" || event.key === "A") || (event.key === "c" || event.key === "C") || (event.key === "v" || event.key === "V"))) {
            return;
      }

      // Ensure only numbers are allowed
      if (!/^[0-9]$/.test(event.key)) {
            event.preventDefault();
      }
}

export function dataMascara(event) {
      let inputValue = event.target.value;

      // Remove non-numeric characters
      inputValue = inputValue.replace(/\D/g, '');

      // Ensure the input is not longer than 8 characters
      inputValue = inputValue.slice(0, 8);

      // Format the input as YYYY-MM-DD
      if (inputValue.length >= 6) {
            inputValue = inputValue.slice(0, 4) + '-' + inputValue.slice(4, 6) + '-' + inputValue.slice(6);
      }

      // Update the input value
      event.target.value = inputValue;
}

export function isDataValida(dateString) {
      const regex = /^\d{4}-\d{2}-\d{2}$/;
      if(!regex.test(dateString)){
            return false;
      }

      // Extract year, month, and day
      const year = parseInt(dateString.slice(0, 4), 10);
      const month = parseInt(dateString.slice(5, 7), 10);
      const day = parseInt(dateString.slice(8, 10), 10);

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

window.showMensagem = showMensagem;
window.apenasNumeros = apenasNumeros;
window.anoMesMascara = anoMesMascara;
window.mascaraCurrencyBr = mascaraCurrencyBr;