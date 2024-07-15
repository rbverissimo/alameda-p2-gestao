<form action="{{ route('editar-conta-inquilino', ['idConta' => $conta->id]) }}" 
    method="POST">
  @csrf
  @method('PUT')
  <div class="dashboard light-dashboard">
    <div class="row">
      <div class="col-12">
        @component('app.layouts._components.dados_conta_inquilino', compact('conta'))    
        @endcomponent
      </div>
    </div>
    <div class="row center-itens">
      <div class="col-4">
          <button class="button confirmacao-button" type="submit">Salvar</button>
      </div>
    </div>
  </div>
  
</form>