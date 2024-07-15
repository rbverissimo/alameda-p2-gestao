export let selectElement = undefined;

export function getSelectOptions(select, paramValue, url){
    selectElement = select;
    selectElement.innerHTML = '';
    selectElement.style.display = 'none';

    fetch(`${url}${paramValue}`)
        .then(response => {
            if(response.status === 200){
                return response.json();
            } else {
                throw new Error(`Erro ao buscar as informações no servidor ${response.status}`);
            }
        })
        .then(data => {
            createOptions(data);
        })
        .catch(err => {
            showMensagem(err, 'falha', 5000);
            console.error(err);
        })

}

function createOptions(data){
    for(const object of data){
        const option = document.createElement('option');
        option.value = object.value;
        option.text = object.view;

        selectElement.appendChild(option);
    }
    
    if(data.length > 0){
        selectElement.style.display = 'block';
    }
    
}