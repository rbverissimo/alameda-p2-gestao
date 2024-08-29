const modalOverlay = document.getElementById('simple-modal-shade-overlay');
const modalWrapper = document.getElementById('dashboard-modal-wrapper');

export const mensagemModal = document.getElementById('mensagem-modal');
export const confirmarButton = document.getElementById('botao-confirmar-modal');
export const cancelarButton = document.getElementById('botao-cancelar-modal');


export function loadSimpleModal(textMensagemModal, textConfirmar = 'Sim', textCancelar = 'Cancelar', handlerConfirmar){

    mensagemModal.textContent = textMensagemModal;
    confirmarButton.textContent = textConfirmar;
    cancelarButton.textContent = textCancelar;

    cancelarButton.addEventListener('click', (event) => {
        toggleModal();
        confirmarButton.removeEventListener('click', handlerConfirmar, {once: true});
        event.stopPropagation();
    }, {once: true});

    toggleModal();

    confirmarButton.addEventListener('click', handlerConfirmar, {once: true});

}

/**
 * O modo simples recebe dois parâmetros: o texto do modal e o handler do confirmar
 * Esse método é direcionado ao caso de uso em que o modal carregado na view terá apenas
 * um propósito e não será necessário ficar montando e desmontando o modal a cada clique em
 * um botão. Para esse fim, use o método loadSimpleModal que é mais flexível e seguro em relação
 * ao bubbling do evento de clique
 * 
 * @param {*} textMensagemModal 
 * @param {*} handlerConfirmar 
 */
export function loadModalModoSimples(textMensagemModal, handlerConfirmar){
    loadMessages(textMensagemModal);

    cancelarButton.addEventListener('click', (event) => {
        toggleModal();
    });

    confirmarButton.addEventListener('click', handlerConfirmar);
}

export function loadMessages(textMensagemModal, textConfirmar = 'Sim', textCancelar = 'Cancelar'){
    mensagemModal.textContent = textMensagemModal;
    confirmarButton.textContent = textConfirmar;
    cancelarButton.textContent = textCancelar;
}

/**
 * O intuito de criar essa função é oferecer uma interface única e desacoplável 
 * para fazer o toggle tanto do overlay quando do wrapper do modal
 * 
 * @param {*} overlay 
 * @param {*} wrapperModal 
 */
export function toggleModal(){

    if(modalOverlay.style.display === '' && modalWrapper.style.display === ''){
        modalOverlay.style.display = 'none';
        modalWrapper.style.display = 'none';
    }

    modalOverlay.style.display = modalOverlay.style.display === 'none' ? 'block' : 'none';
    modalWrapper.style.display = modalWrapper.style.display === 'none' ? 'block' : 'none';
}