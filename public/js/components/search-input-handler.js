document.addEventListener('onSearchInputsAvailable', (event) => {
    const searchObjects = event.detail;
    console.log('Objetos recibidos: ' + searchObjects.length);
});