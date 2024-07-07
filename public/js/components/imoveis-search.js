export let salasSelect = undefined;

export function getSalasSelectedImovel(select, value){
    salasSelect = select;
    const imovelSelecionado = value;
    const url = '/salas/listar-salas/' + imovelSelecionado;
    salasSelect.innerHTML = '';
    salasSelect.style.display = 'none';

    fetch(url)
        .then(response => {
            if(response.status === 200){
                return response.json();
            } else {
                throw new Error(`Erro ao buscar as informações no servidor ${response.status}`);
            }
        })
        .then(data => {
            createSalasOptions(data);
        })
        .catch(err => {
            showMensagem(err, 'falha', 5000);
            console.error(err);
        })

}

function createSalasOptions(data){
    for(const object of data){
        const option = document.createElement('option');
        option.value = object.id;
        option.text = object.nomesala;

        salasSelect.appendChild(option);
    }
    
    if(data.length > 0){
        salasSelect.style.display = 'block';
    }
    
}