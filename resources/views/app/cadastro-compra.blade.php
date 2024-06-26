@extends('app.layouts.template-basico')

@section('conteudo')
<div class="dashboard light-dashboard">
    <div class="row">
        <div onclick="navigateToLastRoute()" class="col-2">
            <button class="button common-button">
                Voltar</button>
        </div>
    </div>
</div>
<div class="row">
    @component('app.layouts._components.form_compra')
        
    @endcomponent()
</div>
<div class="row">
    <div class="whitespace-end-page"></div>
</div>
@endsection

@section('scripts')
    <script src="{{ asset('js/components/search-input.js')}}" type="module"></script>
    <script src="{{asset('js/views/cadastro-compras.js')}}" type="module"></script>
@endsection