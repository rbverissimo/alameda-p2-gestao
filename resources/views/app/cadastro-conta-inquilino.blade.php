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
    @component('app.layouts._components.form_conta_inquilino', compact('conta'))
    @endcomponent
    <div class="row">
        <div class="whitespace-end-page"></div>
    </div>
@endsection

@section('scripts')
    <script type="module" src="{{ asset('js/views/cadastro-conta-inquilino.js')}}"></script>
@endsection