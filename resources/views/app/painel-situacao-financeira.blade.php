@extends('app.layouts.template-basico')

@section('conteudo')
    @include('app.layouts._partials.spinner')
    <div class="row center-itens">
        <div style="min-width: 200px;" class="col-3">
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
                <span>Total: {{ $situacao_financeira->total_contas_mensais }}</span>
            </div>
        </div>
    </div>
    @if (!$contas_referencia->isEmpty())    
        <div class="dashboard light-dashboard">
            <div class="divisor-header secondary-divisor">
                Contas detalhadas:
            </div>
            <div class="row">
                <div class="col-12">
                    @component('app.layouts._components.lista_contas_inquilino', ['contas' => $contas_referencia])

                    @endcomponent
                </div>
            </div>
        </div>
    @endif
    @if(!$comprovantes->isEmpty())
        <div class="dashboard light-dashboard">
            <div class="divisor-header secondary-divisor">
                Comprovantes de transferência:
            </div>
            @component('app.layouts._components.lista_comprovantes', ['comprovantes' => $comprovantes, 'incluir_topo' => false]) 
        
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
            Saldo do mês: {{ $situacao_financeira->saldo_parcial }}
        </div>
    </div>
    <div class="row">
        <div class="whitespace-end-page"></div>
    </div>
@endsection


@section('scripts')
    <script src="{{ asset('js/views/painel-situacao-financeira.js') }}" type="module"></script>
    @include('app.scripts.script-carousel')
    @include('app.scripts.script-app-data')
@endsection