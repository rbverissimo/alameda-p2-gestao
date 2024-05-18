@extends('app.layouts.template-basico')

@section('conteudo')
    @include('app.layouts._partials.spinner')
    <div class="row center-itens">
        <div class="col-3">
            @include('app.layouts._partials.simple-carousel')
        </div>
    </div>
    <div class="dashboard light-dashboard">
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
    @isset($comprovantes)
        <div class="row">
            <div class="col-12">
                <span>Comprovantes: </span>
            </div>
        </div>
        @foreach ($comprovantes as $comprovante)
            <div class="dashboard light-dashboard">
                <div class="row">
                    <div class="col-1">
                        ID: {{$comprovante->id}}
                    </div>
                    <div class="col-2">
                        Data: {{$comprovante->dataComprovante}}
                    </div>
                    <div class="col-2">
                        Valor: {{$comprovante->valor}}
                    </div>
                    <div class="col-7">
                        Descrição: {{$comprovante->descricao}}
                    </div>
                </div>
            </div>
            
        @endforeach
        
    @endisset
@endsection


@section('scripts')
    @include('app.scripts.script-carousel')
    @include('app.scripts.script-painel-situacao-financeira')
@endsection