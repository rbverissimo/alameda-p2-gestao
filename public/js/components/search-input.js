import { call } from "../dynamic-micro-components/reactive.js";

export const searchInput = document.getElementById('search');
export const sugestoes = document.getElementById('sugestoes');
export const numeroSugestoesMostradas = 5;


document.addEventListener('click', (event) => {
    if (!event.target.matches('#search') && !event.target.closest('#sugestoes')) {
        sugestoes.innerHTML = '';
    }
});


export function criarAvailableSearchInputEvent(obj, dominio, dispatch = true){
    const event = new CustomEvent('onSearchInputsAvailable', {
          detail: obj
    });
    event.dominio = dominio;
    if(dispatch){
        document.dispatchEvent(event);
    }
    return event;
}


export async function gerarFocusState(URL, dataMap, chave, dominio) {
    if(dataMap.length === 0){
        const data = await call(URL);
        dataMap = criarMapaDeObjetos(chave, data.search);
        criarAvailableSearchInputEvent(dataMap, dominio);
    }
    renderSugestoes(dataMap);
}

export async function gerarKeyUp(param, URL, dataMap, chave, dominio){
    let sugestoesEncontradas = gerarSugestoes(param, dataMap);
    if(!sugestoesEncontradas.length){
        const data = await call(URL, param);
        const newMapping = criarMapaDeObjetos(chave, data.search);
        const mergedMapping = mergirMapas(newMapping, dataMap);
        criarAvailableSearchInputEvent(mergedMapping, dominio);
        sugestoesEncontradas = gerarSugestoes(param, mergedMapping);
    } 
    renderSugestoes(sugestoesEncontradas);
}

/**
 * 
 * Esse cria um 'onSearchInputSelected' e o retorna.
 * Se o terceiro parâmetro vier marcado como false, o evento não será
 * publicado logo após criado. Caso contrário, sempre que o evento é criado
 * ele é também publicado. 
 * 
 * @param {*} obj
 * @param {string} dominio
 * @param {boolean} dispatch 
 * @returns CustomEvent('onSearchInputSelected')
 */
export function criarSelectedSearchInputEvent(obj, dominio, dispatch = true){
    const selectedEvent = new CustomEvent('onSearchInputSelected', {
          detail: obj
    });
    selectedEvent.dominio = dominio;
    
    if(dispatch){
        document.dispatchEvent(selectedEvent);
    }
    
    return selectedEvent;
}

export function criarMapaDeObjetos(keyAttribute, objs){
    return Object.entries(objs.reduce((acc, obj) => {
        acc[obj[keyAttribute]] = obj;
        return acc; 
    }, {})).map(([key, value]) => ({[key]: value}));
}

export function mergirMapas(...maps){
    const merged = [];
    const mapped = new Map();
    maps.forEach(array => {
        array.forEach(keyValue => {
            const obj = keyValue[Object.keys(keyValue)[0]];
            const key = `${obj.id}-${obj.nome}`;
            if(!mapped.has(key)){
                merged.push(keyValue);
                mapped.set(key, true);
            }
        });
    });
    return merged;
}

export function gerarSugestoes(userInput, dataMap){
    const sugestoesFiltradas = [];
    dataMap.forEach(registro => {
        const chave = Object.keys(registro)[0];
        if(chave.toLowerCase().startsWith(userInput.toLowerCase())){
            sugestoesFiltradas.push(registro);
        }
    });
    return sugestoesFiltradas;
}

export function renderSugestoes(sugestoesFiltradas){
    sugestoes.innerHTML = '';
    if(!sugestoesFiltradas.length){
        sugestoes.innerHTML = '<li> Não foi encontrado nenhum item buscado </li> ';
        setCadastrarLi();
        return;
    }

    let contagem = 0;
    sugestoesFiltradas.forEach(sugestao => {
        contagem++;
        if(contagem > numeroSugestoesMostradas){
            return;
        }
        const listItem = document.createElement('li');
        const chave = Object.keys(sugestao)[0];
        listItem.textContent = chave;

        listItem.addEventListener('click', () => {
            searchInput.value = chave;
            const selectedEvent = criarSelectedSearchInputEvent(sugestao[chave], dominio);
            sugestoes.innerHTML = '';
        })

        sugestoes.appendChild(listItem);
    });
    
}

function setCadastrarLi(){
    const cadastrarLi = document.createElement('li');
    cadastrarLi.className = 'cadastrar';
    cadastrarLi.textContent = 'Cadastrar novo item';
    sugestoes.appendChild(cadastrarLi);

    cadastrarLi.addEventListener('click', () => {
        const selectedEvent = criarSelectedSearchInputEvent(undefined, dominio);
        sugestoes.innerHTML = '';
        searchInput.value = 'Cadastrar novo item';
    });
}

