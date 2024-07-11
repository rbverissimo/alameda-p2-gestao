import { mascaraReferenciaSlider } from "../partials/simple-carousel.js";
import { loadSimpleModal, toggleModal } from "../partials/simple-modal.js";
import { toggleOverlay } from "../partials/spinner.js";
import { isArrayEmpty } from "../validators/null-safe.js";
import { colocaMascaraReferencia } from "../validators/view-masks.js";


const dominio = 'painel-calcular-contas';
const pathReferencia = '/imoveis/executar-calculo/{id}/{ref?}';
let referenciaCalculo = 0;
let idImovel = 0;
let nomeImovel = '';
let contas = [];


document.querySelector('.prev-carousel').addEventListener('click', () => {
    escolherReferenciaAnterior();
});


document.addEventListener('DOMContentLoaded', () => {

    try {
        mascaraReferenciaSlider();

        // Esse event listener tem de ser setado depois do click no botão para evitar um loop infinito de clicks
        document.querySelector('.next-carousel').addEventListener('click', () => {
            escolherReferenciaPosterior();
        });
            
    } catch (error) {
        showMensagem(error.message, "falha");
    }

    document.addEventListener('appData', (data) => {
        if(data['dominio'] === dominio){
            referenciaCalculo = +data.detail['referencia_calculo'];
            idImovel = data.detail['idImovel'];
            nomeImovel = data.detail['nome_imovel'];
            contas.push(data.detail['contas_imovel']);

            if(!isArrayEmpty(contas[0])){

                const referenciaComMascara = colocaMascaraReferencia(referenciaCalculo.toString());

                document.getElementById('botao-realizar-calculos').addEventListener('click', () => {
                    loadSimpleModal(
                        `Deseja realizar cálculos das contas do imóvel ${nomeImovel} para a referência  ${referenciaComMascara}?`, 
                        'Sim', 'Cancelar', confirmarCalcularContasHandler);
                });
            }
        }
    });

});


function confirmarCalcularContasHandler(){

        fetch("{{ route('realizar-calculo', ['id' => $idImovel, 'ref' => $referencia_calculo])}}")
            .then(response => {
                toggleOverlay(); 
                if(!response.ok){
                    throw new Error('Não foi possível se conectar com o servidor. ');
                }
                return response.json();
            })
            .then(data => {
                toggleOverlay();
                console.log(data);
                renderizarResultado(data['inquilinos']);
                showMensagem(data['mensagem']['mensagem'], data['mensagem']['status']);
            })
            .catch(error => {
                toggleOverlay();
                console.error('Não foi possível concluir a operação', error);
            }).then(complete => {
                toggleModal();
            });

}

function renderizarResultado(data){
    if(data !== undefined){
        const divResultado = document.getElementById('resultado-calculo');
        let html = '<div class="col-12">';
        data.forEach(function(inquilino) {
            html += `<div class="col-3"><div>Nome: ${inquilino.nome}</div><div>Aluguel: ${inquilino.valorAluguel}</div>`;

            inquilino.contas_inquilino.forEach(e => {
                html += `<div> ${e.descricao}: ${e.valorinquilino}</div>`;
            })
            html += '</div>';
        });
        
        html += '</div>';
        divResultado.innerHTML = html;
    }
}

function escolherReferenciaAnterior(){
    // referenciaCalculo-1
    redirecionarPara(pathReferencia.replace('{id}', idImovel).replace('{ref?}', referenciaCalculo - 1));
}

function escolherReferenciaPosterior(){
    redirecionarPara(pathReferencia.replace('{id}', idImovel).replace('{ref?}', referenciaCalculo + 1));
}
