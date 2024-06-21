
/**
 * Esse método faz o toggle do overlay de carregamento.
 * Esse overlay possui nele a animação do Spinner e, geralmente, é usado em
 * requests ao servidor que resultam em alguma mudança no estado da view da aplicação.
 * O conteúdo geralmente é renderizado dinamicamente;
 * 
 * @param {*} loadingOverlay 
 */
export function toggleOverlay(loadingOverlay){
    if(loadingOverlay.style.display === 'block'){
        loadingOverlay.style.display = 'none';
    } else {
        loadingOverlay.style.display = 'block';
    }
}

/**
 * O intuito de criar essa função é oferecer uma interface única e desacoplável 
 * para fazer o toggle tanto do overlay quando do wrapper do modal
 * 
 * @param {*} overlay 
 * @param {*} wrapperModal 
 */
export function toggleModal(overlay, wrapperModal){
    overlay.style.display = overlay.style.display === 'none' ? 'block' : 'none';
    wrapperModal.style.display = wrapperModal.style.display === 'none' ? 'block' : 'none';
}

