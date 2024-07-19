<form action="{{ isset($servico->id) ? route('editar-servico', ['id' => $servico->id]) : route('cadastrar-servico')}}" 
    method="POST" 
    enctype="multipart/form-data">
  @csrf
  @if (isset($servico->id))
      @method('PUT')
  @endif
  @component('app.layouts._components.dados_servico_tomado', compact('tipos_servicos', 'imoveis'))
      
  @endcomponent

    <div class="row center-itens">
      <div class="col-4">
            <button class="button confirmacao-button" type="submit">Cadastrar serviço</button>
      </div>
    </div>
</form>