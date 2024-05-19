<script type="module">

    import { colocaMascaraReferencia } from "{{ asset('js/scripts.js') }}";
    import { mascaraReferenciaSlider } from "{{ asset('js/scripts.js') }}";
    import { removerCaracteres } from "{{ asset('js/scripts.js') }}";
    import { redirecionarPara } from "{{ asset('js/scripts.js') }}";


    const listaComprovantes = document.getElementById('lista-comprovantes');
    const saldoDiv = document.getElementById('painel-financeiro-saldo');
    const saldoReferencia = +@json($situacao_financeira->saldoReferencia);

    document.addEventListener('DOMContentLoaded', () => {
        try {
            mascaraReferenciaSlider();
            showListaComprovantes();
            mudarCorSaldo();
        } catch (error) {
            showMensagem(error.message, "falha");
        }

    });


    document.querySelector('.prev-carousel').addEventListener('click', () => {
         redirecionarPara("{{ route('mostrar-situacao-financeira', ['id' => $inquilino->id, 'ref' => $referencia_situacao_financeira-1])}}");
    });

    document.querySelector('.next-carousel').addEventListener('click', () => {
         redirecionarPara("{{ route('mostrar-situacao-financeira', ['id' => $inquilino->id, 'ref' => $referencia_situacao_financeira+1])}}");
    });

    function showListaComprovantes(){
        if(listaComprovantes != null){
            listaComprovantes.style.display = 'block';
        }
    }

    function mudarCorSaldo(){
        if(saldoReferencia >= 0){
            saldoDiv.style.backgroundColor = '#0C72C0';
        }
    }



</script>