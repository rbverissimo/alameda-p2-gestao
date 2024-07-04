import { mascaraCEP, writeMascaraCEP } from "../validators/view-masks.js";
import { apenasNumeros, apenasLetras } from "../validators/view-validation.js";

export function criarComponenteEnderecoSimplificado(enderecoData, headerText){

    const endereco = {
        cep: enderecoData?.cep,
        logradouro: enderecoData?.logradouro,
        numero: enderecoData?.numero,
        bairro: enderecoData?.bairro,
        cidade: enderecoData?.cidade,
        uf: enderecoData?.uf
    }

    const wrapper = document.createElement('div');
    wrapper.classList.add('dashboard');
    wrapper.classList.add('light-dashboard');

    //<div class="row"> cep, logradouro, numero <div>
    const divRow1 = document.createElement('div');
    divRow1.classList.add('row');
    divRow1.appendChild(inputCep(endereco));
    divRow1.appendChild(inputLogradouro(endereco));
    divRow1.appendChild(inputNumero(endereco));

    //<div class="row"> bairro, cidade, uf <div> 
    const divRow2 = document.createElement('div');
    divRow2.classList.add('row');
    divRow2.appendChild(inputBairro(endereco));
    divRow2.appendChild(inputCidade(endereco));
    divRow2.appendChild(inputUf(endereco));




    wrapper.appendChild(divHeader(headerText, 'primary-divisor'));
    wrapper.appendChild(divRow1);
    wrapper.appendChild(divRow2);

    return wrapper;
}

function divHeader(headerText, divisor){
    const divHeader = document.createElement('div');
    divHeader.classList.add('divisor-header');
    divHeader.classList.add(divisor);
    divHeader.innerHTML = headerText;
    return divHeader;
}

function inputCep(endereco){

    //<div class="col-3"></div>
    const divCol = document.createElement('div');
    divCol.classList.add('col-3');

    const input = document.createElement('input');
    input.id = 'input-cep';
    input.name = 'cep';
    input.value = writeMascaraCEP(endereco?.cep) ?? '';
    input.required = true;
    input.maxLength = 9;
    input.addEventListener('keydown', apenasNumeros);
    input.addEventListener('input', mascaraCEP);

    divCol.appendChild(createLabel(input.id, 'CEP: '))
    divCol.appendChild(input);

    return divCol;
}

function inputLogradouro(endereco){
    //<div class="col-4"></div>
    const divCol = document.createElement('div');
    divCol.classList.add('col-4');

    const input = document.createElement('input');
    input.id = 'input-logradouro';
    input.name = 'logradouro';
    input.value = endereco?.logradouro ?? '';
    input.required = true;

    divCol.appendChild(createLabel(input.id, 'Logradouro: '))
    divCol.appendChild(input);

    return divCol;
}

function inputNumero(endereco){
    //<div class="col-3"></div>
    const divCol = document.createElement('div');
    divCol.classList.add('col-3');

    const input = document.createElement('input');
    input.id = 'input-numero-endereco';
    input.name = 'numero-endereco';
    input.value = endereco?.numero ?? '';
    input.required = true;
    input.addEventListener('keydown', apenasNumeros);

    divCol.appendChild(createLabel(input.id, 'Número: '))
    divCol.appendChild(input);

    return divCol;
}

function inputBairro(endereco){
    //<div class="col-4"></div>
    const divCol = document.createElement('div');
    divCol.classList.add('col-4');

    const input = document.createElement('input');
    input.id = 'input-bairro';
    input.name = 'bairro';
    input.value = endereco?.bairro ?? '';
    input.required = true;

    divCol.appendChild(createLabel(input.id, 'Bairro: '))
    divCol.appendChild(input);

    return divCol;

}
function inputCidade(endereco){
    //<div class="col-4"></div>
    const divCol = document.createElement('div');
    divCol.classList.add('col-4');

    const input = document.createElement('input');
    input.id = 'input-cidade';
    input.name = 'cidade';
    input.value = endereco?.cidade ?? '';
    input.required = true;

    divCol.appendChild(createLabel(input.id, 'Cidade: '))
    divCol.appendChild(input);

    return divCol;

}

function inputUf(endereco){
    //<div class="col-2"></div>
    const divCol = document.createElement('div');
    divCol.classList.add('col-2');

    const input = document.createElement('input');
    input.id = 'input-uf';
    input.name = 'uf';
    input.value = endereco?.uf ?? '';
    input.required = true;
    input.maxLength = 2;
    input.style.textTransform = 'uppercase';
    input.addEventListener('keydown', apenasLetras);
    

    divCol.appendChild(createLabel(input.id, 'UF: '))
    divCol.appendChild(input);

    return divCol;

}

function createLabel(forInput, text){
    const label = document.createElement('label');
    label.for = forInput;
    label.innerHTML = text;
    return label; 
}