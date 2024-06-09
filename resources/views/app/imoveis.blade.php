@extends('app.layouts.template-basico')

@section('conteudo')
      <div class="dashboard light-dashboard">
            <div class="row">
                  <div class="col-2">
                        <button onclick="navigateToLastRoute()" class="button common-button">Voltar</button>
                  </div>
                  <div class="col-3">
                        <button onclick="redirecionarPara('{{ route('cadastrar-imovel')}}')" class="button action-button" >
                              Cadastrar novo imóvel
                        </button>
                  </div>
            </div>
      </div>
      @if (isset($imoveis[0]))
            <div class="row">
                  @component('app.layouts._components.lista_imoveis_component',
                  compact('imoveis'))
                  @endcomponent
            </div>
      @else
            <div class="dashboard light-dashboard">
                  <div class="row">
                        <div class="col-12">
                              <span class="basic-card-wrapper">
                                    Não há qualquer imóvel cadastrado no sistema. <br>
                                    Cadastre um imóvel clicando no botão "Cadastrar novo imóvel" 
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