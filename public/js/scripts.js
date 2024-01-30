export function showMensagem(mensagem, tipo){

      let mensagemElement = undefined; 

      if(tipo === 'sucesso'){
            mensagemElement = document.getElementById('sucesso-mensagem');
            document.getElementById('mensagem-container').style.backgroundColor = '#DFF2BF'; 
      } else if(tipo === 'falha') {
            mensagemElement = document.getElementById('falha-mensagem');
            document.getElementById('mensagem-container').style.backgroundColor = '#FFCDD2'; 
      }
      mensagemElement.textContent = mensagem;
      showMensagemContainer();
      
}

function showMensagemContainer() {
      const messageContainer = document.getElementById('mensagem-container');
      messageContainer.style.display = 'block';

      setTimeout(() => {
            messageContainer.style.display = 'none';
      }, 3000);
}