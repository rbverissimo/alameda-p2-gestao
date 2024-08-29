import { renderSimpleModal } from "../dynamic-micro-components/layouts.js";
import { off } from "../dynamic-micro-components/reactive.js";
import { DELETAR_SERVICO } from "../routes.js";
import { writeMascaraValorDinheiro } from "../validators/view-masks.js";

const valores = document.getElementsByClassName('lista-servicos-valor');
const delIcons = document.getElementsByClassName('del-servico-icon');
const csrf  = document.getElementsByName('_token')[0]?.value;
const conteudoWrapper = document.getElementsByClassName('conteudo-wrapper')[0];

document.addEventListener('DOMContentLoaded', () => {
    Array.from(valores).forEach(v => {
        v.innerHTML = writeMascaraValorDinheiro(v.innerHTML);
    });

    if(delIcons.length > 0){
        Array.from(delIcons).forEach(icon => {
            icon.addEventListener('click', () => {
                const nomeServico = icon.getAttribute('data-nome');
                conteudoWrapper.append(renderSimpleModal(`Deseja realmente excluir o serviço "${nomeServico}" do registro de serviços? `, 
                    async () => {
                        const id = icon.getAttribute('data-registro');
                        const response = await off(DELETAR_SERVICO, `id=${id}`, csrf);
                        if(response.deletado){
                            showMensagem(`O serviço "${nomeServico}" foi deletado com sucesso!`, 'sucesso');
                            document.getElementById('simple-modal-container').remove();
                            location.reload();
                        }
                }));
            });
        });
    }
});