import { divCol, divisorTypes, divRow, gerarInputLabelSpanErrors, headerDivisor, lightDashboard } from "./layouts.js";

export function gerarFormularioPrestador(){
    const dashboard = lightDashboard();
    const header = headerDivisor(divisorTypes['PRIMARY'], 'Informações básicas do prestador de serviço');

    const divRow1 = divRow();
    const divCol8 = gerarInputLabelSpanErrors(divCol(8), 'prestador-nome','Nome ou razão social:', true);
    const nomeInput = divCol8.getElementById('nome-prestador-input');

    const divCol4 = gerarInputLabelSpanErrors(divCol(4), 'cnpj-prestador', 'CNPJ: ');
    const cnpjInput = divCol4.getElementById('cnpj-prestador-input');

    divRow1.appendChild(divCol8);
    divRow1.appendChild(divCol4);

}

export function nomeInputEventListeners(){

}