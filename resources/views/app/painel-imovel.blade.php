@extends('app.layouts.template-basico')

@section('conteudo')

<div class="row">
    <div class="dashboard-card">
        <div class="col-3">
            <button id="acessar-relatorio-mensal-button-painel-imovel" class="button special-action-button">Relatório Mensal</button>
        </div>
        <div class="col-3">
            <button id="calcular-contas-botao-painel-imovel" class="button common-button">Calcular contas</button>
        </div>
    </div>
</div>
<div class="row">
    @include('app.layouts._components.lista_contas')
</div>
<div class="row">
    <div class="whitespace-end-page"></div>
</div>
@endsection

@section('scripts')
    @include('app.scripts.script-lista-contas')
    @include('app.scripts.script-painel-imovel')
@endsection
