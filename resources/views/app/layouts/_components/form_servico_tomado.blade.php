<form action="{{ isset($servico->id) ? route('editar-servico', ['id' => $servico->id]) : route('cadastrar-servico')}}" 
    method="POST" 
    enctype="multipart/form-data">
  @csrf
  @if (isset($servico->id))
      @method('PUT')
  @endif
  @component('app.layouts._components.dados_servico_tomado', compact('tipos_servicos', 'imoveis'))
      
  @endcomponent
    <div class="dashboard light-dashboard">
      <div class="divisor-header secondary-divisor">
        Informações dos prestadores de serviço
      </div>
      <div class="row">
        <div class="col-12">
          <x-search-input
            labelText="Digite o nome ou CNPJ do prestador para buscar"
            placeholder="Ex: Imobi Gestão Predial ou 12.345.678/000-00 "
            dominio="prestadores_servicos"
          >
          </x-search-input>
        </div>
      </div>
    </div>
    <div id="prestador-container">
      
    </div>

    <div class="row center-itens">
      <div class="col-4">
            <button class="button confirmacao-button" type="submit">Cadastrar serviço</button>
      </div>
    </div>
</form>