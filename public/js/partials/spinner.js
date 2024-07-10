
/**
 * Esse método faz o toggle do overlay de carregamento.
 * Esse overlay possui nele a animação do Spinner e, geralmente, é usado em
 * requests ao servidor que resultam em alguma mudança no estado da view da aplicação.
 * O conteúdo geralmente é renderizado dinamicamente;
 * 
 * @param {*} loadingOverlay 
 */
export function toggleOverlay(loadingOverlay = document.getElementById('loading-overlay')){
    if(loadingOverlay.style.display === 'block'){
        loadingOverlay.style.display = 'none';
    } else {
        loadingOverlay.style.display = 'block';
    }
}
