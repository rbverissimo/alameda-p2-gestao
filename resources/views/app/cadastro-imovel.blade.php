@extends('app.layouts.template-basico')

@section('conteudo')
    @include('app.layouts._partials.topo-imoveis')
    @component('app.layouts._components.form_imovel')
    @endcomponent
@endsection

@section('scripts')
    @include('app.scripts.script-cadastro-imovel')  
@endsection