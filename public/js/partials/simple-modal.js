const modalOverlay = document.getElementById('simple-modal-shade-overlay');
const modalWrapper = document.getElementById('dashboard-modal-wrapper');

const mensagemModal = document.getElementById('mensagem-modal');
export const confirmarButton = document.getElementById('botao-confirmar-modal');
export const cancelarButton = document.getElementById('botao-cancelar-modal');


export function loadSimpleModal(textMensagemModal, textConfirmar, textCancelar, confirmarButtonClickHandler){

    removeAllEventListenersFrom(confirmarButton);
    removeAllEventListenersFrom(cancelarButton);

    mensagemModal.textContent = textMensagemModal;
    confirmarButton.textContent = textConfirmar;
    cancelarButton.textContent = textCancelar;

    cancelarButton.addEventListener('click', toggleModal);
    confirmarButton.addEventListener('click', confirmarButtonClickHandler);

    toggleModal();

}

/**
 * O intuito de criar essa função é oferecer uma interface única e desacoplável 
 * para fazer o toggle tanto do overlay quando do wrapper do modal
 * 
 * @param {*} overlay 
 * @param {*} wrapperModal 
 */
function toggleModal(){
    modalOverlay.style.display = modalOverlay.style.display === 'none' ? 'block' : 'none';
    modalWrapper.style.display = modalWrapper.style.display === 'none' ? 'block' : 'none';
}

function removeAllEventListenersFrom(element){
    const listeners = element.eventListeners;
    if(listeners){
        for(let i = listeners.length - 1; i >= 0; i--){
            const listener = listeners[i];
            element.removeEventListener(listener.type, listener.handler);
        }
    }
}
