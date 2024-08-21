import { writeMascaraValorDinheiro } from "../validators/view-masks.js";
import { apenasLetras } from "../validators/view-validation.js";

class FilterParams {
    constructor(nome, situacao, imovel){
        this.nome = nome;
        this.situacao = situacao;
        this. imovel = imovel; 
    }
    queryParams(){
        const queryParams = new URLSearchParams(
        );

        queryParams.append('nome', this.nome);
        queryParams.append('situacao', this.situacao);
        queryParams.append('imovel', this.imovel);

        return queryParams;
    }
}

const valorAluguelElements = document.getElementsByClassName('valor-aluguel-lista-inquilinos');
const ativosInativosSelect = document.getElementById('ativos-inativos-select');
const searchInquilinoNome = document.getElementById('search-inquilino-nome');

const filtro = new FilterParams('', '', '');

document.addEventListener('DOMContentLoaded', function(){
        Array.from(valorAluguelElements).forEach(e => {
            e.textContent = writeMascaraValorDinheiro(e.textContent);
        });
});

ativosInativosSelect.addEventListener('change', (event) => {
    filtro.situacao = event.target.value;
});

searchInquilinoNome.addEventListener('keydown', apenasLetras);
searchInquilinoNome.addEventListener('change', (event) => {
    filtro.nome = event.target.value;
});