@section('scripts')

<script type="module">

    const idInquilino = @json($inquilino->id);

    const wrapperModal = document.getElementById('dashboard-modal-wrapper');
    const overlay = document.getElementsByClassName('overlay')[0];
    const inativarInquilinoBotao = document.getElementById('botao-inativar-inquilino-painel');
    const spanSituacao = document.getElementById('span-situacao');

    document.addEventListener('DOMContentLoaded', function(){
        buscarMensagemSessionData();
    });

    document.getElementById('botao-confirmar-modal').addEventListener('click', function(){
        const request = new XMLHttpRequest();
        request.open("GET", "/inquilino/toggle-inquilino/"+ idInquilino, true);
        request.send();
        request.responseType = "json";
        request.onload = () => {
            if(request.readyState == 4 && request.status == 200){
                const data = request.response;
                toggleModal();
                showMensagem("Situação alterada para: " + converterSituacao(data['inquilino']['situacao']), "sucesso");

                setTimeout(function() {
                    location.reload();
                }, 1600);

            } else {
                console.log(`Erro: ${request.status}`);
                toggleModal();
                showMensagem("Não foi possível modificar a situação do inquilino " + @json($inquilino->nome), "falha");
            }
        }

    }); 

    document.getElementById('botao-cancelar-modal').addEventListener('click', function(){
        wrapperModal.style.display = 'none';   
        overlay.style.display = 'none';    
    });

    inativarInquilinoBotao.addEventListener('click', function(){
        overlay.style.display = 'block';
        wrapperModal.style.display = 'block';
    });

    document.addEventListener('DOMContentLoaded', function(){
        decodificarSituacaoInquilino();
    });

    function decodificarSituacaoInquilino(){
        if(spanSituacao.textContent === 'A'){
            spanSituacao.textContent = 'Ativo';
        } else if(spanSituacao.textContent === 'I'){
            spanSituacao.textContent = 'Inativo';
        } else {
            spanSituacao.textContent = 'Não identificada';
        }
    }

    function toggleModal(){
        overlay.style.display = overlay.style.display === 'none' ? 'block' : 'none';
        wrapperModal.style.display = wrapperModal.style.display === 'none' ? 'block' : 'none';
    }

    function converterSituacao(situacao){
        return situacao === 'A' ? 'Ativo' : 'Inativo';
    }

    function buscarMensagemSessionData() {
        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        var requestBody = {
            chaveDataSession: 'mensagem'
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
                throw new Error('Não foi possível buscar o session data. ');
            }
            return response.json();
        }).then(
            data => {
                console.log(data);
                var mensagem = data.mensagem;
                if(mensagem != undefined && mensagem != ''){
                    showMensagem(mensagem, "neutra");
                }
            }
        )
    }

</script>
    
@endsection