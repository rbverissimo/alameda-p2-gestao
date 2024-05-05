export function toggleOverlay(loadingOverlay){
    if(loadingOverlay.style.display === 'block'){
        loadingOverlay.style.display = 'none';
    } else {
        loadingOverlay.style.display = 'block';
    }
}

export function buscarMensagemSessionData(chave, valor) {
    let sessionData = null; 
    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    var requestBody = {
        chave: valor
    };

    fetch("{{ route('buscar-session-data') }}", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify(requestBody)
    })
    .then(response => {
        if(!response.ok){
            throw new Error('Não foi encontrada uma resposta válida como retorno. ');
        }
        return response.json();
    }).then(
        data => {
            sessionData = data.valor; 
        }
    ).catch(error => {
        console.error('Não foi possível buscar a Session Data no servidor');
    })
}

