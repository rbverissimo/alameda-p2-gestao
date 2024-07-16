import { getSelectOptions } from "../dynamic-micro-components/select-option.js";
import { LISTAR_SALAS, LISTAR_TIPOS_CONTAS_IMOVEL } from "../routes.js";
import { anoMesMascara, dataMascara, mascaraValorDinheiro  } from "../validators/view-masks.js";
import { apenasNumeros, isDataValida  } from "../validators/view-validation.js";

const anoMesInput = document.getElementById('ano-mes-input');
const dataInput = document.getElementById('data-input');
const valorInput = document.getElementById('input-valor');
const elementosApenasNumeros = document.getElementsByClassName('numero-input');

const imoveisSelect = document.getElementById('imoveis-conta-select');
const salasSelect = document.getElementById('sala-select');
const tiposContaSelect = document.getElementById('tipos-conta-select');

const labelSalaSelect = document.getElementById('label-sala-select');
const labelTipoContaSelect = document.getElementById('label-tipo-conta-select');


anoMesInput.addEventListener('input', anoMesMascara);
dataInput.addEventListener('input', dataMascara);
dataInput.addEventListener('blur', function(event) {
      if (!isDataValida(event.target.value)) {
            event.target.value = '';
      }
});

valorInput.addEventListener('input', mascaraValorDinheiro);

for(const e of elementosApenasNumeros){
      e.addEventListener("keydown", apenasNumeros);
}

imoveisSelect.addEventListener('change', (option) => {
      console.log('change');
      getSelectOptions(salasSelect, option.target.value, LISTAR_SALAS);
      getSelectOptions(tiposContaSelect, option.target.value, LISTAR_TIPOS_CONTAS_IMOVEL);

      labelSalaSelect.style.display = 'block';
      labelTipoContaSelect.style.display = 'block';
});
