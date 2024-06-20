<script type="module">

    import { handleBackspaceHyphen } from "{{ asset('js/scripts.js') }}";
    import { apenasNumeros } from "{{ asset('js/scripts.js') }}";
    import { cepMascara } from "{{ asset('js/scripts.js') }}";

    const inputNumeroImovel = document.getElementById('form-cadastro-imovel-numero-imovel');
    const inputQuadraImovel = document.getElementById('form-cadastro-imovel-quadra-imovel')
    const inputLoteImovel = document.getElementById('form-cadastro-imovel-lote-imovel');
    const inputCepImovel = document.getElementById('form-cadastro-imovel-cep-imovel');

    inputNumeroImovel.addEventListener('keydown', apenasNumeros);
    inputNumeroImovel.addEventListener('keydown', handleBackspaceHyphen);

    inputQuadraImovel.addEventListener('keydown', apenasNumeros);
    inputQuadraImovel.addEventListener('keydown', handleBackspaceHyphen);

    inputLoteImovel.addEventListener('keydown', apenasNumeros);
    inputLoteImovel.addEventListener('keydown', handleBackspaceHyphen);

    inputCepImovel.addEventListener('keydown', apenasNumeros);
    inputCepImovel.addEventListener('keydown', handleBackspaceHyphen);
    inputCepImovel.addEventListener('input', cepMascara);
    
</script>