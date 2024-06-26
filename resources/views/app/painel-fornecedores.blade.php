@extends('app.layouts.template-basico')

@section('conteudo')
      <div class="dashboard light-dashboard">
            <div class="row">
                  <div class="col-2">
                        <button onclick="navigateToLastRoute()" class="button common-button">Voltar</button>
                  </div>
            </div>
      </div>
      @if (isset($fornecedores[0]))
            <div class="row">
                  @component('app.layouts._components.lista_fornecedores',
                  compact('fornecedores'))
                  @endcomponent
            </div>
      @else
            <div class="dashboard light-dashboard">
                  <div class="row">
                        <div class="col-12">
                              <span class="basic-card-wrapper">
                                    Não há qualquer fornecedor cadastrado no sistema. <br>
                                    Os fornecedores são cadastrados apenas no cadastro de compras.
                                    <br>
                                    Quando você for cadastrar uma compra, cadastre um fornecedor para aquela compra 
                                    ou selecione entre os fornecedores já mapeados pelo sistema. 
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