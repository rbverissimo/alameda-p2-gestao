@extends('app.layouts.template-basico')

@section('conteudo')
<div class="dashboard light-dashboard">
    <div class="row">
        <div onclick="navigateToLastRoute()" class="col-2">
            <button class="button common-button">
                Voltar</button>
        </div>
        <div class="col-5">
            <button onclick="redirecionarPara('{{ route('cadastrar-prestador')}}')" class="button action-button" >
                  Cadastrar novo prestador
            </button>
        </div>
    </div>
</div>
    @if (isset($prestadores[0]))
        <div class="row">
            <div class="col-12">
                @component('app.layouts._components.lista_prestadores', compact('prestadores'))
                    
                @endcomponent
            </div>
        </div>
    @else
        <div class="dashboard light-dashboard">
            <div class="row">
                <div class="col-12">
                        <span class="basic-card-wrapper">
                            Não há nenhum serviço prestador de serviço no sistema. <br>
                            Cadastre um prestador clicando no botão "Cadastrar novo prestador" 
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
    @include('app.scripts.script-mensagem')
@endsection