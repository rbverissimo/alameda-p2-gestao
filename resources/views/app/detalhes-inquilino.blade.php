@extends('app.layouts.template-basico')

@section('conteudo')
    @include('app.layouts._partials.simple-modal')
    <div class="dashboard light-dashboard">
        <div class="row">
            <div onclick="navigateToLastRoute()" class="col-2">
                <button class="button common-button">
                    Voltar</button>
            </div>
            @if ($inquilino->situacao == 'A')
                <div class="col-4">
                    <button id="botao-inativar-inquilino-painel" class="button action-button">Inativar inquilino</button>
                </div>
            @else 
                <div class="col-4">
                    <button id="botao-inativar-inquilino-painel" class="button action-button">Ativar inquilino</button>
                </div>
            @endif
            <div class="col-3">
                <button id="acessar-contratos-button" class="button action-button">Contratos</button>
            </div>
        </div>
    </div>
    <div class="row">
        @component('app.layouts._components.form_inquilinos', compact('contrato', 'inquilino', 'imobiliarias', 'imoveis', 'salas'))
            
        @endcomponent
    </div>
    <div class="row">
        <div class="whitespace-end-page"></div>
  </div>
@endsection

@section('scripts')
    <script type="module" src="{{ asset('js/views/cadastro-inquilino.js')}}"></script>
    <script type="module" src="{{ asset('js/views/detalhe-inquilino.js')}}"></script>
    <script type="module" src="{{ asset('js/views/dados-contrato.js')}}"></script>
    @include('app.scripts.script-app-data')
    @include('app.scripts.script-mensagem')
@endsection
