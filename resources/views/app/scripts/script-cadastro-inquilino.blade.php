<script type="module">

    import { handleBackspaceHyphen } from "{{ asset('js/scripts.js') }}";
    import { telefoneCelularMascara } from "{{ asset('js/scripts.js') }}";
    import { apenasNumeros } from "{{ asset('js/scripts.js') }}";
    import { cpfMascara } from "{{ asset('js/scripts.js') }}";

    const inputTelefoneCelular = document.getElementById('form-inquilino-telefone-celular');
    const inputCpf = document.getElementById('form-inquilino-cpf');
    
    inputTelefoneCelular.addEventListener('input', telefoneCelularMascara);
    inputTelefoneCelular.addEventListener('keydown', handleBackspaceHyphen);
    inputTelefoneCelular.addEventListener('keydown', apenasNumeros);

    inputCpf.addEventListener('input', cpfMascara);
    inputCpf.addEventListener('keydown', handleBackspaceHyphen);
    inputCpf.addEventListener('keydown', apenasNumeros);

</script>