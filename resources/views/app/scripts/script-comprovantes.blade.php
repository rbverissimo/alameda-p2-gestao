@section('scripts')
<script type="module">

    import { showMensagem } from "{{ asset('js/scripts.js')}}";
    import { anoMesMascara } from "{{ asset('js/scripts.js')}}";
    import { handleBackspaceHyphen } from "{{ asset('js/scripts.js')}}";
    import { isDataValida } from "{{ asset('js/scripts.js')}}";
    import { dataMascara } from "{{ asset('js/scripts.js')}}";
    import { mascaraCurrencyBr } from "{{ asset('js/scripts.js')}}";
    import { navigateToLastRoute } from "{{ asset('js/scripts.js') }}";

    const mensagem = @json($mensagem);
    if(mensagem === 'sucesso') showMensagem("Registro salvo com sucesso", "sucesso");

    const voltarDiv = document.getElementById('voltar-wrapper');
    voltarDiv.addEventListener('click', navigateToLastRoute);

    const anoMesInput = document.getElementById('ano-mes-input');
    anoMesInput.addEventListener('input', anoMesMascara);
    anoMesInput.addEventListener('keydown', handleBackspaceHyphen);

    const dataInput = document.getElementById('data-input');
    dataInput.addEventListener('input', dataMascara);
    dataInput.addEventListener('keydown', handleBackspaceHyphen);

    dataInput.addEventListener('blur', function(event) {
        if (!isDataValida(event.target.value)) {
            // Reset the value if it is not a valid date
            event.target.value = '';
        }
    });

    const valorInput = document.getElementById('input-valor-comprovante');
    valorInput.addEventListener('input', mascaraCurrencyBr);
</script>
@endsection