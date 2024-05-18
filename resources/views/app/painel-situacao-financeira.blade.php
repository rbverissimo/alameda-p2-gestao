@extends('app.layouts.template-basico')

@section('conteudo')
    @include('app.layouts._partials.spinner')
    <div class="row center-itens">
        <div class="col-3">
            @include('app.layouts._partials.simple-carousel')
        </div>
    </div>

@endsection


@section('scripts')
    @include('app.scripts.script-carousel')
    @include('app.scripts.script-painel-situacao-financeira')
@endsection