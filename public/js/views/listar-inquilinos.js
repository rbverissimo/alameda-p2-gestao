import { tableAcoesListaInquilinos, tableRow } from "../dynamic-micro-components/layouts.js";
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

const conteudoTableWrapper = document.getElementById('conteudo-table-wrapper');

const filtro = new FilterParams();

document.addEventListener('DOMContentLoaded', function(){
        Array.from(valorAluguelElements).forEach(e => {
            e.textContent = writeMascaraValorDinheiro(e.textContent);
        });
});

ativosInativosSelect.addEventListener('change', async (event) => {
    filtro.situacao = event.target.value;
    const data = await query(FILTAR_LISTA_INQUILINOS, filtro.queryParams().toString());

    data['inquilinos'].forEach((el) => {
        const params = [{ text: el.nome, cssClasses: 'table-link'}, 
            { text: el.valorAluguel, cssClasses: 'table-link,valor-aluguel-lista-inquilinos' }];
        const acoes = tableAcoesListaInquilinos(el.id);
        const tr = tableRow(params, acoes);
        conteudoTableWrapper.appendChild(tr);
    });

});

searchInquilinoNome.addEventListener('keydown', apenasLetras);
searchInquilinoNome.addEventListener('change', async (event) => {
    filtro.nome = event.target.value;
    const data = await query(FILTAR_LISTA_INQUILINOS, filtro.queryParams().toString());
    dataMap = [];


});

imovelSearchInput.addEventListener('change', (event) => {
    filtro.imovel = event.target.value;
    query(FILTAR_LISTA_INQUILINOS, filtro.queryParams().toString());
});