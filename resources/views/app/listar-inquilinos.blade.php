@extends('app.layouts.template-basico')

@section('conteudo')
      <div class="dashboard light-dashboard">
            <div class="row">
                  <div class="col-2">
                        <button onclick="navigateToLastRoute()" class="button common-button">Voltar</button>
                    </div>
                    <div class="col-4">
                        <button onclick="redirecionarPara('{{ route('cadastrar-inquilino')}}')" class="button action-button" >
                            Cadastrar inquilino
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
                        @component('app.layouts._partials.topo-lista-inquilinos', 'imoveis')
                        @endcomponent
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
      <div class="row">
            <div class="whitespace-end-page"></div>
      </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/views/listar-inquilinos.js')}}" type="module"></script>
@endsection