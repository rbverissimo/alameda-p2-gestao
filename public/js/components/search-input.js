var dataMap;
const dominio = document.getElementById('dominio').getAttribute('data-dominio');
const searchInput = document.getElementById('search');
const sugestoes = document.getElementById('sugestoes');


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


/**
 * O evento onSearchInputsAvailable recebe os inputs e os guarda no dataMap
 * que será manipulado pelo search-input
 */
document.addEventListener('onSearchInputsAvailable', (event) => {
    const eventDominio = event['dominio'];
    if(eventDominio === dominio){
        dataMap = event['detail']['search'];
    }    
});

searchInput.addEventListener('input', () => {
    const userInput = searchInput.value.trim();
    if(userInput.length){
        const sugestoesFiltradas = gerarSugestoes(userInput);
        renderSugestoes(sugestoesFiltradas);
    } else {
        sugestoes.innerHTML = '';
    }

});

function gerarSugestoes(userInput){
    const sugestoesFiltradas = [];
    for(const key in dataMap){
        if(key.toLowerCase().startsWith(userInput.toLowerCase())){
            sugestoesFiltradas.push({ key, value: dataMap[key] });
        }
    }

    return sugestoesFiltradas;
}

function renderSugestoes(sugestoesFiltradas){
    sugestoes.innerHTML = '';
    if(!sugestoesFiltradas.length){
        sugestoes.innerHTML = '<li> Não foi encontrado nenhum item buscado </li> ';
        setCadastrarLi();
        return;
    }

    sugestoesFiltradas.forEach(sugestao => {
        const listItem = document.createElement('li');
        listItem.textContent = sugestao.key;

        listItem.addEventListener('click', () => {
            searchInput.value = sugestao.key
            const selectedEvent = criarSelectedSearchInputEvent(sugestao, dominio);
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

document.addEventListener('click', (event) => {
    if (!event.target.matches('#search') && !event.target.closest('#sugestoes')) {
        sugestoes.innerHTML = '';
    }
});