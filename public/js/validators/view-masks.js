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

export function mascaraValorDinheiro(event){
    const input = event.target.value.trim();
    let resultado = '';
    const semCaracterizacaoMoeda = input.replace(/^R\$/, "");
    resultado = +semCaracterizacaoMoeda.replace(',', ''); 

    if(resultado < 100){
          let numerosPequenos = resultado;
          if(resultado < 10){
                numerosPequenos = `0${numerosPequenos}`;
          }
          resultado = `0,${numerosPequenos}`;
    } else {
          resultado = resultado.toString();
          const ultimosDoisDigitos = resultado.slice(-2);
          const parteNaoDecimal = resultado.slice(0, -2);


          resultado = `${parteNaoDecimal},${ultimosDoisDigitos}`;
    }

    event.target.value = `R$${resultado}`;
    
}