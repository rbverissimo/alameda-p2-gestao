<script type="module">

    import { toggleOverlay } from "{{ asset('js/comportamento-dinamico.js') }}";
    import { isArrayEmpty } from "{{ asset('js/scripts.js') }}";
    import { isNotNullOrUndefined } from "{{ asset('js/scripts.js') }}";

    const referenciaCalculo = @json($referencia_calculo);
    const idImovel = @json($idImovel);
    const contas = @json($contas_imovel);

    const wrapperModal = document.getElementById('dashboard-modal-wrapper');
    const overlay = document.getElementsByClassName('overlay')[0];
    const loadingOverlay = document.getElementById('loading-overlay');

    if(!isArrayEmpty(contas)){
        document.getElementById('botao-realizar-calculos').addEventListener('click', function(){
            toggleModal();
        });
    
    
        document.getElementById('botao-cancelar-modal').addEventListener('click', function(){
            toggleModal();  
        });
    
    
        document.getElementById('botao-confirmar-modal').addEventListener('click', () => {
            fetch("{{ route('realizar-calculo', ['id' => $idImovel, 'ref' => $referencia_calculo])}}")
                .then(response => {
                    toggleOverlay(loadingOverlay); 
                    if(!response.ok){
                        throw new Error('Não foi possível se conectar com o servidor. ');
                    }
                    return response.json();
                })
                .then(data => {
                    toggleOverlay(loadingOverlay);
                    console.log(data);
                    renderizarResultado(data['inquilinos']);
                })
                .catch(error => {
                    toggleOverlay(loadingOverlay);
                    console.error('Não foi possível concluir a operação', error);
                }).then(complete => {
                    toggleModal();
                });
    
        });
    }


    function toggleModal(){
        overlay.style.display = overlay.style.display === 'none' ? 'block' : 'none';
        wrapperModal.style.display = wrapperModal.style.display === 'none' ? 'block' : 'none';
    }

    function renderizarResultado(data){
        const divResultado = document.getElementById('resultado-calculo');
        let html = '<div class="col-12 end-table-scroll">';
        data.forEach(function(inquilino) {
            html += `<div>Nome: ${inquilino.nome}, Valor do Aluguel: ${inquilino.valorAluguel}</div>`;

            inquilino.contas_inquilino.forEach(e => {
                html += `<div> Conta:  ${e.descricao} - Valor: ${e.valorinquilino}</div>`;
            })
        });
        
        html += '</div>';
        divResultado.innerHTML = html;
    }

</script>