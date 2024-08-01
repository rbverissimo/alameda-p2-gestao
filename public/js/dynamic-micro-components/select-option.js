export function getSelectOptions(select, label = null, paramValue, url){

    resetStatusSelect(select, label);
    
    if(paramValue === '' || paramValue === '0' || paramValue === null){
        return;
    }

    fetch(`${url}${paramValue}`)
        .then(response => {
            console.log(response);
            if(response.status === 200){
                return response.json();
            } else {
                throw new Error(`Erro ao buscar as informações no servidor ${response.status}`);
            }
        })
        .then(data => {
            if(data['erro']){
                throw new Error(data['erro']['mensagem']);
            }
            createOptions(data, select);

            if(data.length > 0){
                select.style.display = 'block';
        
                if(label !== null){
                    label.style.display = 'block';
                }
            }
        })
        .catch(err => {
            showMensagem(err, 'falha', 5000);
            console.error(err);
        })

}

export function createOptions(data, selectElement){
    for(const object of data){
        const option = document.createElement('option');
        option.value = object.value;
        option.text = object.view;
        selectElement.appendChild(option);
    }
}

export function checarOptionsVisiveis(label, select){
    if(select.childElementCount > 0){
          label.style.display = 'block'
          select.style.display = 'block';
    }
}

export function resetStatusSelect(select, label = null){
    select.innerHTML = '';
    select.style.display = 'none';

    if(label !== null){
        label.style.display = 'none';
    }
}