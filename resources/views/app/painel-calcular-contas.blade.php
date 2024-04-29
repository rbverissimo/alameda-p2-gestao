@extends('app.layouts.template-basico')

@section('conteudo')
    <div class="row">
        @include('app.layouts._partials.simple-modal')
    </div>
    <div class="row center-itens">
        <div class="col-3">
            @include('app.layouts._partials.simple-carousel')
        </div>
    </div>
    @if ($contas_imovel->isNotEmpty())     
        <div class="row">
            <div class="col-12">
                @include('app.layouts._components.lista_executar_calculo_contas')
            </div>
        </div>
        <div class="dashboard light-dashboard">
            <div class="row">
                <div class="col-2">
                    <button class="button confirmacao-button">Realizar cálculos</button>
                </div>
            </div>
        </div>
        <div class="row">
            NESSA DIV ESTARÁ O OUTPUT DO CÁLCULO COM UM BOTÃO PARA O USUÁRIO FECHAR A REFERÊNCIA
        </div>
    @else
        <div class="dashboard light-dashboard">
            <div class="row">
                <div class="col-12">
                    <span>Não foram encontrados registros de contas para o período de referência selecionado</span>
                </div>
            </div>
        </div>
    @endif
@endsection

@section('scripts')
    @include('app.scripts.script-painel-calcular-contas')
    @include('app.scripts.script-carousel')
@endsection