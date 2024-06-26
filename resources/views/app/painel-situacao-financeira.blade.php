@extends('app.layouts.template-basico')

@section('conteudo')
    @include('app.layouts._partials.spinner')
    <div class="row center-itens">
        <div class="col-3">
            @include('app.layouts._partials.simple-carousel')
        </div>
    </div>
    <div class="dashboard light-dashboard">
        <div class="divisor-header primary-divisor">
            Contas do mês:
        </div>
        <div class="row">
            <div class="col-3">
                <span>Aluguel: {{ $situacao_financeira->aluguel }}</span>
            </div>
            <div class="col-3">
                <span>Luz: {{ $situacao_financeira->luz }}</span>
            </div>
            <div class="col-3">
                <span>Água: {{ $situacao_financeira->agua }}</span>
            </div>
            <div class="col-3">
                <span>Total: {{ $situacao_financeira->total }}</span>
            </div>
        </div>
    </div>
    <div class="row"></div>
    @if(!$comprovantes->isEmpty())
        <div class="dashboard light-dashboard">
            <div class="divisor-header secondary-divisor">
                Comprovantes de transferência:
            </div>
            @component('app.layouts._components.lista_comprovantes', ['comprovantes' => $comprovantes])  
            @endcomponent
        </div>
    @else
        <div class="dashboard light-dashboard">
            <div class="divisor-header secondary-divisor">
                Comprovantes de transferência:
            </div>
            <div class="row">
                <div class="col-12">
                    <span>Não foram encontrados comprovantes de pagamento para esta referência</span>
                </div>
            </div>
        </div>       
    @endif
    <div class="dashboard light-dashboard">
        <div id="painel-financeiro-saldo" class="divisor-header alert-divisor">
            Saldo do mês: {{ $situacao_financeira->saldoReferencia }}
        </div>
    </div>
    <div class="row">
        <div class="whitespace-end-page"></div>
    </div>
@endsection


@section('scripts')
    @include('app.scripts.script-carousel')
    @include('app.scripts.script-painel-situacao-financeira')
@endsection