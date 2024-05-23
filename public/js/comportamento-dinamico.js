export function toggleOverlay(loadingOverlay){
    if(loadingOverlay.style.display === 'block'){
        loadingOverlay.style.display = 'none';
    } else {
        loadingOverlay.style.display = 'block';
    }
}

