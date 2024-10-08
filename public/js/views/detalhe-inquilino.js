import { writeMascaraCpf } from "../validators/view-masks.js";

let appData = {};
let idInquilino = 0;
let nomeInquilino = '';
    
const wrapperModal = document.getElementById('dashboard-modal-wrapper');
const overlay = document.getElementsByClassName('overlay')[0];
const inativarInquilinoBotao = document.getElementById('botao-inativar-inquilino-painel');
const spanSituacao = document.getElementById('span-situacao');

document.getElementById('botao-confirmar-modal').addEventListener('click', function(){
    const request = new XMLHttpRequest();
    request.open("GET", "/inquilino/toggle-inquilino/"+ idInquilino, true);
    request.send();
    request.responseType = "json";
    request.onload = () => {
        if(request.readyState == 4 && request.status == 200){
            const data = request.response;
            toggleModal();
            showMensagem("Situação alterada para: " + converterSituacao(data['inquilino']['situacao']), "sucesso");

            setTimeout(function() {
                location.reload();
            }, 1600);
        } else {
            console.log(`Erro: ${request.status}`);
            toggleModal();
            showMensagem("Não foi possível modificar a situação do inquilino " + nomeInquilino, "falha");
        }
    }
}); 

document.getElementById('botao-cancelar-modal').addEventListener('click', function(){
    wrapperModal.style.display = 'none';   
    overlay.style.display = 'none';    
});

inativarInquilinoBotao.addEventListener('click', function(){
    overlay.style.display = 'block';
    wrapperModal.style.display = 'block';
});

document.addEventListener('DOMContentLoaded', function(){
    decodificarSituacaoInquilino();

    document.addEventListener('appData', (data) => {
        if(data['dominio'] === 'detalhes_inquilino'){
            appData = data.detail;
            idInquilino = appData.id_inquilino;
            nomeInquilino = appData.nome_inquilino;
        }
    });

});

    function decodificarSituacaoInquilino(){
        if(spanSituacao.textContent === 'A'){
            spanSituacao.textContent = 'Ativo';
        } else if(spanSituacao.textContent === 'I'){
            spanSituacao.textContent = 'Inativo';
        } else {
            spanSituacao.textContent = 'Não identificada';
        }
    }

    function toggleModal(){
        overlay.style.display = overlay.style.display === 'none' ? 'block' : 'none';
        wrapperModal.style.display = wrapperModal.style.display === 'none' ? 'block' : 'none';
    }

    function converterSituacao(situacao){
        return situacao === 'A' ? 'Ativo' : 'Inativo';
    }