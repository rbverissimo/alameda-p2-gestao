<script type="module">

    import { colocaMascaraReferencia } from "{{ asset('js/scripts.js') }}";
    import { mascaraReferenciaSlider } from "{{ asset('js/scripts.js') }}";
    import { removerCaracteres } from "{{ asset('js/scripts.js') }}";
    import { redirecionarPara } from "{{ asset('js/scripts.js') }}";

    document.addEventListener('DOMContentLoaded', () => {
        try {
            mascaraReferenciaSlider();
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



</script>