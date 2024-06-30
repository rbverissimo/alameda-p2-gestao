<form action="{{ isset($compra->id) ? route('editar-compra', ['idCompra' => $compra->id]) : route('cadastrar-compra')}}" 
      method="POST" 
      enctype="multipart/form-data">
    @csrf
    @if (isset($compra->id))
        @method('PUT')
    @endif
    @component('app.layouts._components.dados_compra', compact('formas_pagamento', 'imoveis', 'compra'))
        
    @endcomponent

    @if (!isset($compra->id))    
      <div id="render-space" class="dashboard light-dashboard">
            <div class="divisor-header secondary-divisor">
            Informações sobre o fornecedor
            </div>
            <div class="row">
            <div class="col-6">
                  <x-search-input 
                        labelText="Digite o CNPJ para buscar: "
                        placeholder="12.345.678/0001-00" 
                        dominio="fornecedores">
                  </x-search-input>
            </div>
            </div>
            {{-- <div class="" id="dynamic-wrap"></div> --}}
            </div>
    @else
      <div class="dashboard light-dashboard">
            <div class="divisor-header secondary-divisor">
                  Fornecedor desta compra
            </div>
            <div class="row">
                  @if(isset($compra->fornecedor) && isset($fornecedores[0]))
                        <div class="col-6">
                              <label for="fornecedore-edit-select">Escolha um fornecedor: </label>
                              <select id="fornecedores-edit-select" name="fornecedor-select">
                                    @foreach ($fornecedores as $fornecedor)
                                          <option value="{{$fornecedor->id}}"
                                                @if($compra->fornecedor === $fornecedor->id)
                                                selected
                                                @endif
                                          >
                                                {{$fornecedor->nome_fornecedor}}
                                          </option>
                                    @endforeach
                              </select>
                        </div>
                  @endif
            </div>
      </div>
    @endif


    <div class="row center-itens">
        <div class="col-4">
              <button class="button confirmacao-button" type="submit">Cadastrar compra</button>
        </div>
      </div>
</form>