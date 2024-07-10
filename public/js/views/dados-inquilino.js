import { loadMessages } from "../partials/simple-modal.js";


let idInquilino = null;
let appData = {};
const dominio = 'dados_inquilino';

document.addEventListener('DOMContentLoaded', () => {

      document.addEventListener('appData', (data) => {
            if(data['dominio'] === dominio){
                  appData = data.detail; 
                  loadMessages(`Você tem certeza que deseja consolidar o sald do(a) inquilino(a) ${appData.nome_inquilino} ?`);
                  idInquilino = appData['inquilino_id'];
            }
      });
});

const botaoMaisInfo = document.getElementById('mais-info-painel-inquilino');

const wrapperModal = document.getElementById('dashboard-modal-wrapper');
const overlay = document.getElementsByClassName('overlay')[0];
// Essa é a div do spinner
const loadingOverlay = document.getElementById('loading-overlay');

botaoMaisInfo.addEventListener('click', function(){
      /* TODO: resolver essa location para uma location
             relativa abandonando o helper route */
      //window.location.href = '{{ route("detalhar-inquilino", ["id" => $inquilino["id"]]) }}';
});


function toggleModal(){
      overlay.style.display = overlay.style.display === 'none' ? 'block' : 'none';
      wrapperModal.style.display = wrapperModal.style.display === 'none' ? 'block' : 'none';
}
      
      
function confirmarConsolidarSaldo(){
      toggleModal();
}
      
//Ao clicar no botão Cancelar do modal, ele faz o toggle do mesmo
document.getElementById('botao-cancelar-modal').addEventListener('click', function(){
      toggleModal();  
});
      
document.getElementById('consolidar-saldo-button-painel-inquilino').addEventListener('click', confirmarConsolidarSaldo);