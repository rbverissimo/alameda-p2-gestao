<script type="module">

    import { redirecionarPara } from "{{ asset('js/scripts.js') }}";

    const calcularContasBotao = document.getElementById('calcular-contas-botao-painel-imovel');

    calcularContasBotao.addEventListener('click', function(){
        redirecionarPara("{{ route('executar-calculo-contas', ['id' => $id]) }}");
    });

</script> 
