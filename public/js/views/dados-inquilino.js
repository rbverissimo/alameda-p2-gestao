import { loadModalModoSimples, toggleModal } from "../partials/simple-modal.js";
import { spinnerOverlay, toggleOverlay } from "../partials/spinner.js";


let idInquilino = null;
let appData = {};
const dominio = 'dados_inquilino';
const botaoConsolidarSaldo = document.getElementById('consolidar-saldo-button-painel-inquilino');
const routeConsolidarSaldo = '/inquilino/consolidar/s/';

document.addEventListener('DOMContentLoaded', () => {

      document.addEventListener('appData', (data) => {
            if(data['dominio'] === dominio){
                  appData = data.detail; 
                  loadModalModoSimples(`Você tem certeza que deseja consolidar o saldo do(a) inquilino(a) ${appData.nome_inquilino} ?`, consolidarSaldo);
                  idInquilino = appData['inquilino_id'];
            }
      });

      botaoConsolidarSaldo.addEventListener('click', () => {
            toggleModal();
      })

});

//TODO: refatorar para o template usando um onclick na div
const botaoMaisInfo = document.getElementById('mais-info-painel-inquilino');
botaoMaisInfo.addEventListener('click', function(){
      window.location.href = '/inquilino/detalhe/' + idInquilino;
});


function consolidarSaldo(){
      fetch(routeConsolidarSaldo + idInquilino)
            .then(response => {
                  toggleOverlay();
                  if(!response.ok){
                        throw new Error('Não foi possível se conectar com o servidor');
                  }
                  return response.json();
            })
            .then(data => {
                  const mensagem = data['mensagem'];
                  showMensagem(mensagem['mensagem'], mensagem['status'], 5000);

                  if(mensagem['status'] === 'falha'){
                        throw new Error(mensagem['mensagem']);
                  }
            })
            .catch(error => {
                  console.log("Não foi possível completar a operação", error);

            }).then(complete => {
                  toggleModal();
                  toggleOverlay();
            });
        
}

function renderizarResultado(){

      /**
       * TODO: implementar o resultado de renderização do saldo na tela
       */
}