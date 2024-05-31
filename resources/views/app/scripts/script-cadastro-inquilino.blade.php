<script type="module">

    import { handleBackspaceHyphen } from "{{ asset('js/scripts.js') }}";
    import { telefoneCelularMascara } from "{{ asset('js/scripts.js') }}";
    import { apenasNumeros } from "{{ asset('js/scripts.js') }}";
    import { cpfMascara } from "{{ asset('js/scripts.js') }}";
    import { mascaraValoresEmReal } from "{{ asset('js/scripts.js') }}";

    const inputTelefoneCelular = document.getElementById('form-inquilino-telefone-celular');
    const inputCpf = document.getElementById('form-inquilino-cpf');
    const inputValorAluguel = document.getElementById('input-valor-aluguel');
    
    inputTelefoneCelular.addEventListener('input', telefoneCelularMascara);
    inputTelefoneCelular.addEventListener('keydown', handleBackspaceHyphen);
    inputTelefoneCelular.addEventListener('keydown', apenasNumeros);

    inputCpf.addEventListener('input', cpfMascara);
    inputCpf.addEventListener('keydown', handleBackspaceHyphen);
    inputCpf.addEventListener('keydown', apenasNumeros);

    inputValorAluguel.addEventListener('input', mascaraValoresEmReal);

</script>