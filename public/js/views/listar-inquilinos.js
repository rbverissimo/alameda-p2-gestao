import { tableAcoesListaInquilinos, tableRow } from "../dynamic-micro-components/layouts.js";
import { query } from "../dynamic-micro-components/reactive.js";
import { FILTAR_LISTA_INQUILINOS } from "../routes.js";
import { writeMascaraValorDinheiro } from "../validators/view-masks.js";
import { apenasLetras } from "../validators/view-validation.js";

class FilterParams {
    constructor(nome = '', situacao = '', imovel = ''){
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
const searchInquilino = document.getElementsByClassName('search-inquilino');
const searchInquilinoNome = document.getElementById('search-inquilino-nome');
const conteudoTableWrapper = document.getElementById('conteudo-table-wrapper');
const table = conteudoTableWrapper.childNodes[1];

const filtro = new FilterParams();

document.addEventListener('DOMContentLoaded', function(){
        Array.from(valorAluguelElements).forEach(e => {
            e.textContent = writeMascaraValorDinheiro(e.textContent);
        });
});

Array.from(searchInquilino).forEach(e => e.addEventListener('change', async (event) => {
    const value = event.target.value;
    switch(event.target.name){
        case 'nome':
            filtro.nome = value;
            break;
        case 'situacao':
            filtro.situacao = value;
            break;
        case 'imovel-search':
            filtro.imovel = value;
            break;
        default:
            return;
    }

    const data = await query(FILTAR_LISTA_INQUILINOS, filtro.queryParams().toString());
    const tableBody = table.childNodes[1];
   
    Array.from(tableBody.childNodes)
        .filter(node => node !== tableBody.firstChild)
    .forEach(node => { tableBody.removeChild(node)});

    data['inquilinos'].forEach(async (el) => {
        const params = [{ text: el.nome, cssClasses: 'table-link'}, 
            { text: el.valorAluguel, cssClasses: 'table-link,valor-aluguel-lista-inquilinos' }];
        const acoes = tableAcoesListaInquilinos(el.id);
        const tr = tableRow(params, acoes);
        tableBody.appendChild(tr);
    });

}));

searchInquilinoNome.addEventListener('keydown', apenasLetras);
