@extends('app.layouts.template-basico')

@section('conteudo')
    @if ($contas_imovel->isNotEmpty())     
        <div class="row center-itens">
            <div class="col-3">
                @include('app.layouts._partials.simple-carousel')
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                @include('app.layouts._components.lista_executar_calculo_contas')
            </div>
        </div>
        <div class="row">
            NESSA DIV ESTARÁ O BOTÃO QUE DARÁ INÍCIO AO CÁLCULO. ELE ATIVARÁ UM MODAL PARA O USUÁRIO CONFIRMAR O CÁLCULO
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