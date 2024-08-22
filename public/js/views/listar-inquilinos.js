import { query } from "../dynamic-micro-components/reactive.js";
import { FILTAR_LISTA_INQUILINOS } from "../routes.js";
import { writeMascaraValorDinheiro } from "../validators/view-masks.js";
import { apenasLetras } from "../validators/view-validation.js";

class FilterParams {
    constructor(nome = null, situacao = null, imovel = null){
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
const imovelSearchInput = document.getElementById('imovel-search-input');

const filtro = new FilterParams();

document.addEventListener('DOMContentLoaded', function(){
        Array.from(valorAluguelElements).forEach(e => {
            e.textContent = writeMascaraValorDinheiro(e.textContent);
        });
});

ativosInativosSelect.addEventListener('change', (event) => {
    filtro.situacao = event.target.value;
    query(FILTAR_LISTA_INQUILINOS, filtro.queryParams().toString());
});

searchInquilinoNome.addEventListener('keydown', apenasLetras);
searchInquilinoNome.addEventListener('change', (event) => {
    filtro.nome = event.target.value;
});

imovelSearchInput.addEventListener('change', (event) => {
    filtro.imovel = event.target.value;
});