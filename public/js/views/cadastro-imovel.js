import { mascaraCEP, mascaraCnpj } from "../validators/view-masks.js";
import { apenasNumeros } from "../validators/view-validation.js";


const cnpjImovel = document.getElementById('form-cnpj-imovel');
const inputNumeroImovel = document.getElementById('form-cadastro-imovel-numero-imovel');
const inputQuadraImovel = document.getElementById('form-cadastro-imovel-quadra-imovel')
const inputLoteImovel = document.getElementById('form-cadastro-imovel-lote-imovel');
const inputCepImovel = document.getElementById('form-cadastro-imovel-cep-imovel');

cnpjImovel.addEventListener('input', mascaraCnpj);
inputNumeroImovel.addEventListener('keydown', apenasNumeros);
inputQuadraImovel.addEventListener('keydown', apenasNumeros);
inputLoteImovel.addEventListener('keydown', apenasNumeros);
inputCepImovel.addEventListener('input', mascaraCEP);
