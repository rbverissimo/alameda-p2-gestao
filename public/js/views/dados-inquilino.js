import { loadModalModoSimples, toggleModal } from "../partials/simple-modal.js";
import { toggleOverlay } from "../partials/spinner.js";
import { isNotNullOrUndefined } from "../validators/null-safe.js";
import { colocaMascaraReferencia, writeMascaraTelefone, writeMascaraValorDinheiro } from "../validators/view-masks.js";


let idInquilino = null;
let appData = {};
const dominio = 'dados_inquilino';
const botaoConsolidarSaldo = document.getElementById('consolidar-saldo-button-painel-inquilino');

const spanSaldo = document.getElementById('saldo');
const spanValorSaldoAtual = document.getElementById('span-valor-saldo-atual');
const spanDataUltimoSaldoAtual = document.getElementById('span-data-ultimo-saldo-atual');
const spanSaldoDefasado = document.getElementById('span-saldo-defasado');
const spanTelefoneCelularInquilino = document.getElementById('span-telefone-celular-inquilino');
const spanReferenciaSituacaoFinanceira = document.getElementById('span-referencia-situacao-financeira');
const spanValores = document.getElementsByClassName('span-valores-contas-aluguel');

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

      getCorSaldo(spanValorSaldoAtual);
      getCorSaldo(spanSaldo);

      spanTelefoneCelularInquilino.textContent = writeMascaraTelefone(spanTelefoneCelularInquilino.textContent);
      spanReferenciaSituacaoFinanceira.textContent = colocaMascaraReferencia(spanReferenciaSituacaoFinanceira.textContent);

      for (let i = 0; i < spanValores.length; i++) {
            spanValores[i].textContent = writeMascaraValorDinheiro(spanValores[i].textContent);
      }

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

                  spanValorSaldoAtual.textContent = data['saldo_atual'];
                  getCorSaldo(spanValorSaldoAtual);

                  spanDataUltimoSaldoAtual.textContent = data['data_atualizacao'];
                  
                  if(isNotNullOrUndefined(spanSaldoDefasado)){
                        removerSaldoDefasado();
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

function getCorSaldo(span){
      const valorSaldoAtual = +span.textContent;
      if(valorSaldoAtual < 0.00){
            span.style.color = '#AE2709';
      }
}


function removerSaldoDefasado(){
      spanSaldoDefasado.textContent = '';
      spanSaldoDefasado.style.display = 'none';
}