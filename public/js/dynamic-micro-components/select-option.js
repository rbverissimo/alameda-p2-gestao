export function getSelectOptions(select, label = null, paramValue, url){

    const selectElement = select;
    selectElement.innerHTML = '';
    selectElement.style.display = 'none';

    if(label !== null){
        label.style.display = 'none';
    }

    if(paramValue === '' || paramValue === '0' || paramValue === null){
        return;
    }

    fetch(`${url}${paramValue}`)
        .then(response => {
            if(response.status === 200){
                return response.json();
            } else {
                throw new Error(`Erro ao buscar as informações no servidor ${response.status}`);
            }
        })
        .then(data => {
            createOptions(data, selectElement, label);
        })
        .catch(err => {
            showMensagem(err, 'falha', 5000);
            console.error(err);
        })

}

function createOptions(data, selectElement, label){
    for(const object of data){
        const option = document.createElement('option');
        option.value = object.value;
        option.text = object.view;

        selectElement.appendChild(option);
    }
    
    if(data.length > 0){
        selectElement.style.display = 'block';

        if(label !== null){
            label.style.display = 'block';
        }
    }
    
}

export function checarOptionsVisiveis(label, select){
    if(select.hasChildNodes){
          label.style.display = 'block'
          select.style.display = 'block';
    }
}