
import {  getInputAutoComplete } from "{{ asset('js/initial-data.js')}}";

//const dataMap = @json($input_autocomplete);
const dataMap = getInputAutoComplete;
console.log(getInputAutoComplete);

const searchInput = document.getElementById('search');
const sugestoes = document.getElementById('sugestoes');

function gerarSugestoes(userInput){
    const sugestoesFiltradas = [];
    for(const key in dataMap){
        if(key.toLowerCase().startsWith(userInput.toLowerCase())){
            sugestoes.push({ key, value: dataMap[key] });
        }
    }

    return sugestoesFiltradas;
}

function renderSugestoes(sugestoesFiltradas){
    sugestoes.innerHTML = '';
    if(!sugestoesFiltradas.length){
        sugestoes.innerHTML = '<li> Não foi encontrado nenhum item buscado </li> ';
        return;
    }

    sugestoesFiltradas.forEach(sugestao => {
        const listItem = document.createElement('li');
        listItem.textContent = sugestao.key;
    });
    


}

searchInput.addEventListener('input', () => {
    const userInput = searchInput.value.trim();
    const sugestoesFiltradas = gerarSugestoes(userInput);
    renderSugestoes(sugestoesFiltradas);

})