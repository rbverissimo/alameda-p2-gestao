
var dataMap;
const dominio = document.getElementById('dominio').innerHTML;


document.addEventListener('onSearchInputsAvailable', (event) => {
    const eventDominio = event['dominio'];
    if(eventDominio === dominio){
        dataMap = event['detail']['search'];
    }
    
});

const searchInput = document.getElementById('search');
const sugestoes = document.getElementById('sugestoes');

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
        sugestoes.appendChild(listItem);
    });
    


}

function setCadastrarLi(){
    const cadastrarLi = document.createElement('li');
    cadastrarLi.className = 'cadastrar';
    cadastrarLi.textContent = 'Cadastrar novo item';
    sugestoes.appendChild(cadastrarLi);
}

searchInput.addEventListener('input', () => {
    const userInput = searchInput.value.trim();
    if(userInput.length){
        const sugestoesFiltradas = gerarSugestoes(userInput);
        renderSugestoes(sugestoesFiltradas);
    } else {
        sugestoes.innerHTML = '';
    }

})