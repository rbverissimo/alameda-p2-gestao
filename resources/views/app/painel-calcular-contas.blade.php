@extends('app.layouts.template-basico')

@section('conteudo')
@include('app.layouts._partials.simple-modal')
@include('app.layouts._partials.spinner')
<div class="row center-itens">
    <div style="min-width: 200px" class="col-3">
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
                <div class="col-3">
                    <button id="botao-realizar-calculos" class="button confirmacao-button">Realizar cálculos</button>
                </div>
            </div>
        </div>
        <div  class="dashboard light-dashboard">
            <div id="resultado-calculo-container">   
                @php
                    $registros = count($calculos_cards);
                    $numero_rows = intval($registros / 3) + 1;
                    
                @endphp
                @for ($i = 0; $i < $numero_rows; $i++)
                    @for ($j = 0; $j < $registros; $j++)
                        <x-calculco-conta-card tamanhoColuna="4" :resultadoCalculo="$calculos_cards[j]"></x-calculo-conta-card>   
                    @endfor
                @endfor       
            </div>
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
<div class="row">
    <div class="whitespace-end-page"></div>
</div>
@endsection

@section('scripts')
    <script type="module" src="{{ asset('js/views/painel-calcular-contas.js')}}"></script>
    @include('app.scripts.script-carousel')
    @include('app.scripts.script-app-data')
@endsection