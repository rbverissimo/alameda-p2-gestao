@extends('app.layouts.template-basico')

@section('conteudo')
<div class="dashboard light-dashboard">
    <div class="row">
        <div onclick="navigateToLastRoute()" class="col-2">
            <button class="button common-button">
                Voltar</button>
        </div>
        <div class="col-3">
            <button onclick="redirecionarPara('{{ route('cadastrar-compra')}}')" class="button action-button" >
                  Cadastrar nova compra
            </button>
      </div>
    </div>
</div>
    @if (isset($compras[0]))
        
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