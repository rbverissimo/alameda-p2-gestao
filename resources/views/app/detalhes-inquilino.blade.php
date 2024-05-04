@extends('app.layouts.template-basico')

@section('conteudo')
    @include('app.layouts._partials.simple-modal')
    <div class="dashboard light-dashboard">
        <div class="row">
            @if ($inquilino->situacao == 'A')
                <div class="col-2">
                    <button id="botao-inativar-inquilino-painel" class="button common-button">Inativar inqulino</button>
                </div>
            @else 
                <div class="col-2">
                    <button id="botao-inativar-inquilino-painel" class="button common-button">Ativar inqulino</button>
                </div>
            @endif
        </div>
    </div>
    <div class="row">
        @include('app.layouts._components.form_inquilinos')
    </div>
@endsection

@include('app.scripts.script-detalhe-inquilino')
