import { dataMascara, mascaraValorDinheiro  } from "../validators/view-masks.js";
import { apenasNumeros, isDataValida  } from "../validators/view-validation.js";

const anoMesInput = document.getElementById('ano-mes-input');
anoMesInput.addEventListener('input', );
anoMesInput.addEventListener('keydown', handleBackspaceHyphen);

const dataInput = document.getElementById('data-input');
dataInput.addEventListener('input', dataMascara);

dataInput.addEventListener('blur', function(event) {
      if (!isDataValida(event.target.value)) {
            // Resetar se o valor não for válido
            event.target.value = '';
      }
});

const valorInput = document.getElementById('input-valor');
valorInput.addEventListener('input', mascaraValorDinheiro);

const elementosApenasNumeros = document.getElementsByClassName('numero-input');

for(const e of elementosApenasNumeros){
      e.addEventListener("keydown", apenasNumeros);
}
