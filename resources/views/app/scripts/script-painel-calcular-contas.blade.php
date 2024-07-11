<script type="module">

    import { toggleOverlay } from "{{ asset('js/partials/spinner.js') }}";
    import { isArrayEmpty } from "{{ asset('js/scripts.js') }}";
    import { isNotNullOrUndefined } from "{{ asset('js/scripts.js') }}";
    import { redirecionarPara } from "{{ asset('js/scripts.js') }}";
    import { mascaraReferenciaSlider } from "{{ asset('js/scripts.js') }}";
    import { showMensagem } from "{{ asset('js/scripts.js') }}";
    import { loadSimpleModal, toggleModal } from "{{ asset('js/partials/simple-modal.js')}}";


    const dominio = 'painel-calcular-contas';
    let referenciaCalculo = 0;
    let idImovel = 0;
    let contas = [];


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

        document.addEventListener('appData', (data) => {
            if(data['dominio'] === dominio){
                referenciaCalculo = data.detail['referencia_calculo'];
                idImovel = data.detail['idImovel'];
                contas = data.detail['contas_imovel'];
            }
        });
    });

    if(!isArrayEmpty(contas)){
        document.getElementById('botao-realizar-calculos').addEventListener('click', () => {
            loadSimpleModal(
                `Deseja realizar cálculos das contas do imóvel ${idImovel} para a referência ${referenciaCalculo}?`, 
                'Sim', 'Cancelar', confirmarCalcularContasHandler);
        });
    }

    function confirmarCalcularContasHandler(){

            fetch("{{ route('realizar-calculo', ['id' => $idImovel, 'ref' => $referencia_calculo])}}")
                .then(response => {
                    toggleOverlay(); 
                    if(!response.ok){
                        throw new Error('Não foi possível se conectar com o servidor. ');
                    }
                    return response.json();
                })
                .then(data => {
                    toggleOverlay();
                    console.log(data);
                    renderizarResultado(data['inquilinos']);
                    showMensagem(data['mensagem']['mensagem'], data['mensagem']['status']);
                })
                .catch(error => {
                    toggleOverlay();
                    console.error('Não foi possível concluir a operação', error);
                }).then(complete => {
                    toggleModal();
                });
    
    }

    function renderizarResultado(data){
        if(data !== undefined){
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