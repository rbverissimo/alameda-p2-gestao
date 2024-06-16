@extends('app.layouts.template-basico')

@section('conteudo')
@component('app.layouts._components.cadastro_imoveis_salas_dados', compact('imovel_cadastrado', 'salas_cadastradas'))
@endcomponent
<div class="row">
    @component('app.layouts._components.form_tipos_contas', compact('chips'))
        
    @endcomponent
</div>
<div class="row">
    <div class="whitespace-end-page"></div>
</div>
@endsection

@section('scripts')
    @include('app.scripts.script-cadastro-compra')
@endsection