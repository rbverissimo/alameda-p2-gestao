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
    @if (isset($contas_imovel[0]))    
        <div class="dashboard light-dashboard">
            <div class="divisor-header primary-divisor">
                Conta do imóvel à qual este débito do inquilino está associado:
            </div>
            <div class="row">
                <div class="col-12">
                    @component('app.layouts._components.lista_contas_imovel', compact('contas_imovel'))
                        
                    @endcomponent
                </div>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="whitespace-end-page"></div>
    </div>
@endsection

@section('scripts')
    <script type="module" src="{{ asset('js/views/cadastro-conta-inquilino.js')}}"></script>
    @include('app.scripts.script-mensagem')
@endsection