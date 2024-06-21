<script type="module">

    import { handleBackspaceHyphen } from "{{ asset('js/scripts.js') }}";
    import { telefoneCelularMascara } from "{{ asset('js/scripts.js') }}";
    import { telefoneFixoMascara } from "{{ asset('js/scripts.js') }}";
    import { apenasNumeros } from "{{ asset('js/scripts.js') }}";
    import { cpfMascara } from "{{ asset('js/scripts.js') }}";
    import { mascaraValoresEmReal } from "{{ asset('js/scripts.js') }}";
    import { mascaraFatorDivisor } from "{{ asset('js/scripts.js') }}";

    const inputTelefoneCelular = document.getElementById('form-inquilino-telefone-celular');
    const inputTelefoneTrabalho = document.getElementById('form-inquilino-telefone-trabalho');
    const inputTelefoneFixo = document.getElementById('form-inquilino-telefone-fixo');
    const inputCpf = document.getElementById('form-inquilino-cpf');
    const inputFatorDivisor = document.getElementById('input-fator-divisor');

    
    inputTelefoneCelular.addEventListener('input', telefoneCelularMascara);
    inputTelefoneCelular.addEventListener('keydown', handleBackspaceHyphen);
    inputTelefoneCelular.addEventListener('keydown', apenasNumeros);

    inputTelefoneFixo.addEventListener('input', telefoneFixoMascara);
    inputTelefoneFixo.addEventListener('keydown', apenasNumeros);
    inputTelefoneFixo.addEventListener('keydown', handleBackspaceHyphen);
    
    inputTelefoneTrabalho.addEventListener('input', telefoneFixoMascara);
    inputTelefoneTrabalho.addEventListener('keydown', apenasNumeros);
    inputTelefoneTrabalho.addEventListener('keydown', handleBackspaceHyphen);


    inputCpf.addEventListener('input', cpfMascara);
    inputCpf.addEventListener('keydown', handleBackspaceHyphen);
    inputCpf.addEventListener('keydown', apenasNumeros);

    inputFatorDivisor.addEventListener('keydown', apenasNumeros);
    inputFatorDivisor.addEventListener('input', mascaraFatorDivisor);

</script>