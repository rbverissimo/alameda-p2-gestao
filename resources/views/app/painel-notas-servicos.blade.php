@extends('app.layouts.template-basico')

@section('conteudo')
<div class="dashboard light-dashboard">
    <div class="row">
        <div onclick="navigateToLastRoute()" class="col-2">
            <button class="button common-button">
                Voltar</button>
        </div>
        <div class="col-5">
            <button onclick="redirecionarPara('{{ route('cadastrar-nota-servico')}}')" class="button action-button" >
                  Cadastrar nova nota fiscal
            </button>
        </div>
    </div>
</div>
    @if (isset($notas_servicos[0]))
        <div class="row">
            <div class="col-12">
                @component('app.layouts._components.lista_notas_servicos', compact('notas_servicos'))
                    
                @endcomponent
            </div>
        </div>
    @else
        <div class="dashboard light-dashboard">
            <div class="row">
                <div class="col-12">
                        <span class="basic-card-wrapper">
                            Não há nenhuma nota fiscal de serviço cadastrada para o prestador {{ $nomePrestador }}. <br>
                            Cadastre uma nota clicando no botão "Cadastrar nova nota" 
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