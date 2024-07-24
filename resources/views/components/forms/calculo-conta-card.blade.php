<div class="col-{{$tamanhoColuna}}">
    <div>Nome: {{ $resultadoCalculo->nome }}</div>
    <div>Aluguel: <span class="span-resultado-calculo-valor">{{$resultadoCalculo->valorAluguel}}</span></div>
    @foreach ($contas as $conta)
        <div>{{$conta->descricao}}: <span class="span-resultado-calculo-valor">{{$conta->valor}}</span></div>
    @endforeach
    <div>Total: <span class="span-resultado-calculo-valor">{{$resultadoCalculo->total}}</span></div>
</div>