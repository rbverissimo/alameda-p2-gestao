@extends('app.layouts.template-basico')

@section('conteudo')
<div class="dashboard light-dashboard">
    <div class="row">
        <div onclick="navigateToLastRoute()" class="col-2">
            <button class="button common-button">
                Voltar</button>
        </div>
        <div class="col-3">
            <button onclick="redirecionarPara('{{ route('cadastrar-servico')}}')" class="button action-button" >
                  Cadastrar serviço tomado
            </button>
        </div>
        <div class="col-4">
            <button onclick="redirecionarPara('{{ route('buscar-prestadores')}}')" class="button action-button" >
                  Ver prestadores de serviço
            </button>
        </div>
    </div>
</div>
    @if (isset($servicos[0]))
        <div class="row">
            <div class="col-12">
                @component('app.layouts._components.lista_servicos', compact('servicos'))
                    
                @endcomponent
            </div>
        </div>
    @else
        <div class="dashboard light-dashboard">
            <div class="row">
                <div class="col-12">
                        <span class="basic-card-wrapper">
                            Não há nenhum serviço cadastrado no sistema. <br>
                            Cadastre um serviço clicando no botão "Cadastrar serviço tomado" 
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