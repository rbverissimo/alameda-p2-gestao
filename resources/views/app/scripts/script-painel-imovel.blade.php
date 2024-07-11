<script type="module">

    const calcularContasBotao = document.getElementById('calcular-contas-botao-painel-imovel');

    calcularContasBotao.addEventListener('click', function(){
        redirecionarPara("{{ route('executar-calculo-contas', ['id' => $id]) }}");
    });

</script> 
