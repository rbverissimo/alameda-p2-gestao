@extends('app.layouts.template-basico')

@section('conteudo')
@include('app.layouts._partials.simple-modal')
@include('app.layouts._partials.spinner')
<div class="dashboard light-dashboard">
    <div class="row">
        <div onclick="navigateToLastRoute()" class="col-2">
            <button class="button common-button">
                Voltar</button>
        </div>
        <div class="col-4">
            <button onclick="redirecionarPara('{{ route('cadastrar-compra')}}')" class="button action-button" >
                  Cadastrar compra
            </button>
        </div>
        <div class="col-4">
            <button onclick="redirecionarPara('{{ route('listar-fornecedores')}}')" class="button action-button" >
                  Ver fornecedores
            </button>
        </div>
    </div>
</div>
    @if (isset($compras[0]))
        <div class="row">
            <div class="col-12">
                @component('app.layouts._components.lista_compras', compact('compras'))
                    
                @endcomponent
            </div>
        </div>
    @else
        <div class="dashboard light-dashboard">
            <div class="row">
                <div class="col-12">
                        <span class="basic-card-wrapper">
                            Não há nenhuma compra cadastrada no sistema. <br>
                            Cadastre uma compra clicando no botão "Cadastrar nova compra" 
                            no menu logo acima desta mensagem. 
                        </span>
                </div>
            </div>
        </div>
    @endif
<div class="row">
    <div class="whitespace-end-page"></div>
</div>
@endsection

@section('scripts')
@endsection