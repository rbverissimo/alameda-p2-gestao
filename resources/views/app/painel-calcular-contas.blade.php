@extends('app.layouts.template-basico')

@section('conteudo')
    <div class="row">
        <div class="col-3">
            @include('app.layouts._partials.simple-carousel')
        </div>
    </div>
@endsection

@section('scripts')
    @include('app.scripts.script-painel-calcular-contas')
    @include('app.scripts.script-carousel')
@endsection