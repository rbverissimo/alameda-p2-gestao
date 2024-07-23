import { mascaraReferenciaSlider } from "../partials/simple-carousel.js";
import { loadSimpleModal, toggleModal } from "../partials/simple-modal.js";
import { toggleOverlay } from "../partials/spinner.js";
import { isArrayEmpty } from "../validators/null-safe.js";
import { colocaMascaraReferencia } from "../validators/view-masks.js";
import { divCol, divRow, divRow } from "../dynamic-micro-components/layouts.js";


const dominio = 'painel-calcular-contas';
const pathReferencia = '/imoveis/executar-calculo/{id}/{ref?}';
const pathExecutar = '/imoveis/executar-calculo/c/{id}/{ref}';

const resultadoCalculoContainer = document.getElementById('resultado-calculo-container');

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

        fetch(pathExecutar.replace('{id}', idImovel).replace('{ref}', referenciaCalculo))
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
        const numeroRegistros = data.length;
        let divRow = divRow();
        let counter = 0;
        for (let i = 0; i < numeroRegistros; i++) {
            ++counter;
            if(counter === 5){
                counter = 0;
                divRow = divRow();
            }
            const div = divCol(3);

            const divNome = document.createElement('div');
            divNome.textContent = `Nome: ${data[i].nome}`;
            div.appendChild(divNome);
            const divValorAluguel = document.createElement('div');
            divValorAluguel.textContent = `Aluguel: ${data[i].valorAluguel}`;
            div.appendChild(divValorAluguel);

            data[i].contas_inquilinos.forEach(conta => {
                const divConta = document.createElement('div');
                divConta.textContent = `${conta.descricao}: ${conta.valorinquilino}`;
                div.appendChild(divConta);
            });
            
        }

        
        let html = '<div class="col-12">';
        data.forEach(function(inquilino) {
            html += `<div class="col-3"><div>Nome: ${inquilino.nome}</div><div>Aluguel: ${inquilino.valorAluguel}</div>`;

            inquilino.contas_inquilino.forEach(e => {
                html += `<div> ${e.descricao}: ${e.valorinquilino}</div>`;
            })
            html += '</div>';
        });
        
        html += '</div>';
        resultadoCalculoContainer.innerHTML = html;
    }
}

function escolherReferenciaAnterior(){
    redirecionarPara(pathReferencia.replace('{id}', idImovel).replace('{ref?}', referenciaCalculo - 1));
}

function escolherReferenciaPosterior(){
    redirecionarPara(pathReferencia.replace('{id}', idImovel).replace('{ref?}', referenciaCalculo + 1));
}
