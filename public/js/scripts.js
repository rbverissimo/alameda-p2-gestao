

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

window.showMensagem = showMensagem;