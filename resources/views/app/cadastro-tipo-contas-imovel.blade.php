@extends('app.layouts.template-basico')

@section('conteudo')
@component('app.layouts._components.cadastro_imoveis_salas_dados', compact('imovel_cadastrado', 'salas_cadastradas'))
@endcomponent
<div class="row">
    <div class="col-12">
        <span>
            Selecione os tipos de contas que esse imóvel poderá registrar para um inquilino clicando nos cards abaixo:
        </span>
    </div>
</div>
<div class="row">
    <div class="dashboard light-dashboard">
        @component('app.layouts._components.form_tipos_contas', compact('chips', 'idImovel'))
        @endcomponent
    </div>
</div>
<div class="row">
    <div class="whitespace-end-page"></div>
</div>
@endsection

@section('scripts')
    @include('app.scripts.script-mensagem')
    <script src="{{ asset('js/components/cadastro-tipo-contas-imovel.js')}}" type="module"></script> 
    <script src="{{ asset('js/partials/chip-group.js')}}" type="module"></script> 
@endsection