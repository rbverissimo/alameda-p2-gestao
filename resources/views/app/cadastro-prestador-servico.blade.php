@extends('app.layouts.template-basico')

@section('conteudo')
<div class="dashboard light-dashboard">
    <div class="row">
        <div onclick="navigateToLastRoute()" class="col-2">
            <button class="button common-button">
                Voltar</button>
        </div>
        @if ($prestador !== null)
            <div class="col-4">
                    <button class="button action-button">
                        Cadastrar nota</button>
            </div>
        @endif
    </div>
</div>
<div class="row">
    @component('app.layouts._components.form_prestador_servico', compact('prestador', 'imobiliarias'))
        
    @endcomponent()
</div>
<div class="row">
    <div class="whitespace-end-page"></div>
</div>
@endsection

@section('scripts')
    <script type="module" src="{{asset('js/views/dados-prestador-servico.js')}}"></script>
    @include('app.scripts.script-mensagem')
    @include('app.scripts.script-app-data')
@endsection