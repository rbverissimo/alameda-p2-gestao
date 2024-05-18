<script type="module">

    import { toggleOverlay } from "{{ asset('js/comportamento-dinamico.js') }}";
    import { isArrayEmpty } from "{{ asset('js/scripts.js') }}";
    import { isNotNullOrUndefined } from "{{ asset('js/scripts.js') }}";
    import { redirecionarPara } from "{{ asset('js/scripts.js') }}";
    import { mascaraReferenciaSlider } from "{{ asset('js/scripts.js') }}";


    const referenciaCalculo = @json($referencia_calculo);
    const idImovel = @json($idImovel);
    const contas = @json($contas_imovel);

    const wrapperModal = document.getElementById('dashboard-modal-wrapper');
    const overlay = document.getElementsByClassName('overlay')[0];
    const loadingOverlay = document.getElementById('loading-overlay');


    document.querySelector('.prev-carousel').addEventListener('click', () => {
        escolherReferenciaAnterior();
    });

    
    document.addEventListener('DOMContentLoaded', () => {

        try {
            mascaraReferenciaSlider();
            setarSliderReferencia();
    
            // Esse event listener tem de ser setado depois do click no botão para evitar um loop infinito de clicks
            document.querySelector('.next-carousel').addEventListener('click', () => {
                escolherReferenciaPosterior();
            });
                
        } catch (error) {
            showMensagem(error.message, "falha");
        }
    });

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
        let html = '<div class="col-12">';
        data.forEach(function(inquilino) {
            html += `<div class="col-3"><div>Nome: ${inquilino.nome}</div><div>Aluguel: ${inquilino.valorAluguel}</div>`;

            inquilino.contas_inquilino.forEach(e => {
                html += `<div> ${e.descricao}: ${e.valorinquilino}</div>`;
            })
            html += '</div>';
        });
        
        html += '</div>';
        divResultado.innerHTML = html;
    }

    function setarSliderReferencia(){
        document.querySelector('.next-carousel').click();
    }

    function escolherReferenciaAnterior(){
        redirecionarPara("{{ route('executar-calculo-contas', ['id' => $idImovel, 'ref' => $itens_carrossel[0] ] )}}");
    }

    function escolherReferenciaPosterior(){
        redirecionarPara("{{ route('executar-calculo-contas', ['id' => $idImovel, 'ref' => $itens_carrossel[2] ] )}}");
    }

</script>