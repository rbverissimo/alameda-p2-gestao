<script type="module">
    import { handleBackspaceHyphen } from "{{ asset('js/scripts.js') }}";
    import { dataMascara } from "{{ asset('js/scripts.js') }}";
    import { isDataValida } from "{{ asset('js/scripts.js') }}";
    import { apenasNumeros } from "{{ asset('js/scripts.js') }}";
    import { mascaraValoresEmReal } from "{{ asset('js/scripts.js') }}";

    const inputValorAluguel = document.getElementById('input-valor-aluguel');
    const inputDataAssinatura = document.getElementById('contrato-input-data-assinatura');
    const inputDataExpiracao = document.getElementById('contrato-input-data-expiracao');

    inputValorAluguel.addEventListener('input', mascaraValoresEmReal);
    inputValorAluguel.addEventListener('keydown', apenasNumeros);
    inputValorAluguel.addEventListener('blur', mascaraValoresEmReal);

    inputDataAssinatura.addEventListener('input', dataMascara);
    inputDataAssinatura.addEventListener('blur', isDataValida);
    inputDataAssinatura.addEventListener('keydown', apenasNumeros);
    inputDataAssinatura.addEventListener('keydown', handleBackspaceHyphen);
    
    inputDataExpiracao.addEventListener('input', dataMascara);
    inputDataExpiracao.addEventListener('blur', isDataValida);
    inputDataExpiracao.addEventListener('keydown', apenasNumeros);
    inputDataExpiracao.addEventListener('keydown', handleBackspaceHyphen);

</script>