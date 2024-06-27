/**
 * Monta uma máscara de acordo com o evento de Input recebido
 * Essa máscara é uma máscara de data tal qual 01/01/2024
 * 
 * @param {InputEvent} event 
 */
export function dataMascara(event) {
    let inputValue = event.target.value;
    inputValue = inputValue.replace(/\D/g, '');
    inputValue = inputValue.slice(0, 8);

    if (inputValue.length >= 6) {
          inputValue = inputValue.slice(0, 2) + '/' + inputValue.slice(2, 4) + '/' + inputValue.slice(4);
    }

    event.target.value = inputValue;
}