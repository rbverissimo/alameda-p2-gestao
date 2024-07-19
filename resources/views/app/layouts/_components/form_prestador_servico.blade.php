<form action="" 
    method="POST">
  @csrf
  @if (isset($prestador->id))
    @method('PUT')
  @endif
  <div class="dashboard light-dashboard">
    <div class="row">
      <div class="col-12">
        @component('app.layouts._components.dados_prestador_servico')    
        @endcomponent
      </div>
    </div>
    <div class="row center-itens">
      <div class="col-4">
          <button class="button confirmacao-button" type="submit">Salvar prestador</button>
      </div>
    </div>
  </div>
  
</form>