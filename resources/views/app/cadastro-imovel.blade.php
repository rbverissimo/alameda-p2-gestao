@extends('app.layouts.template-basico')

@section('conteudo')
    @include('app.layouts._partials.topo-imoveis')
    @component('app.layouts._components.form_imovel')
    @endcomponent
    @include('app.layouts._partials.end-page')
@endsection

@section('scripts')
    <script type="module" src="{{ asset('js/views/cadastro-imovel.js') }}"></script> 
@endsection