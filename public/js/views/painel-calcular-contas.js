import { mascaraReferenciaSlider } from "../partials/simple-carousel.js";
import { loadSimpleModal, toggleModal } from "../partials/simple-modal.js";
import { toggleOverlay } from "../partials/spinner.js";
import { isArrayEmpty } from "../validators/null-safe.js";
import { colocaMascaraReferencia, writeMascaraValorDinheiro } from "../validators/view-masks.js";
import { divCol, divRow } from "../dynamic-micro-components/layouts.js";


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
        resultadoCalculoContainer.innerHTML = '';
        
        const numeroRegistros = data.length;
        let newDivRow = divRow();
        let counter = 0;
        for (let i = 0; i < numeroRegistros; i++) {
            ++counter;
            if(counter === 5){
                resultadoCalculoContainer.appendChild(divRow);
                counter = 0;
                newDivRow = divRow();
            }
            const div = divCol(3);

            const divNome = document.createElement('div');
            divNome.textContent = `Nome: ${data[i].nome}`;
            
            const divValorAluguel = document.createElement('div');
            divValorAluguel.textContent = `Aluguel: ${ writeMascaraValorDinheiro(data[i].valorAluguel)}`;
            
            div.appendChild(divNome);
            div.appendChild(divValorAluguel);

            data[i].contas_inquilino.forEach(conta => {
                const divConta = document.createElement('div');
                divConta.textContent = `${conta.descricao}:  ${ writeMascaraValorDinheiro(conta.valorinquilino)}`;
                div.appendChild(divConta);
            });

            const divValorTotal = document.createElement('div');
            divValorTotal.textContent = `Total: ${ writeMascaraValorDinheiro(data[i].total)}`;
            div.appendChild(divValorTotal);

            newDivRow.appendChild(div);
            
        }

        resultadoCalculoContainer.appendChild(newDivRow);
    }
}

function escolherReferenciaAnterior(){
    redirecionarPara(pathReferencia.replace('{id}', idImovel).replace('{ref?}', referenciaCalculo - 1));
}

function escolherReferenciaPosterior(){
    redirecionarPara(pathReferencia.replace('{id}', idImovel).replace('{ref?}', referenciaCalculo + 1));
}
