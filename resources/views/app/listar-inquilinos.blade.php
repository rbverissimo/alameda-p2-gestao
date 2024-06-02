@extends('app.layouts.template-basico')

@section('conteudo')
      <div class="dashboard light-dashboard">
            <div class="row">
                  <div class="col-2">
                        <button onclick="navigateToLastRoute()" class="button common-button">Voltar</button>
                    </div>
                    <div class="col-2">
                        <button onclick="redirecionarPara('{{ route('cadastrar-inquilino')}}')" class="button action-button" >
                            Cadastrar
                        </button>
                    </div>
            </div>
      </div>
      @if (isset($inquilinos_ativos[0]))
            <div class="dashboard light-dashboard">
                  <div class="divisor-header secondary-divisor">
                        Inquilinos cadastrados:
                  </div>
                  <div class="row">
                        @include('app.layouts._partials.topo-lista-inquilinos')
                  </div>
                  <div class="row">
                        <div class="col-12">
                              @component('app.layouts._components.lista_inquilinos_component',
                              compact('inquilinos_ativos'))
                              @endcomponent
                        </div>
                  </div>
            </div>
      @else
            <div class="dashboard light-dashboard">
                  <div class="row">
                        <div class="col-12">
                              <span class="basic-card-wrapper">
                                    Não há qualquer inquilino cadastrado no sistema. <br>
                                    Cadastre um inquilino clicando no botão "Cadastrar" no menu logo acima desta mensagem. 
                              </span>
                        </div>
                  </div>
            </div>
          
      @endif
@endsection

@include('app.scripts.script-listar-inquilinos')