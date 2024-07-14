<form action="{{ route('editar-conta-inquilino', ['idConta' => $conta->id]) }}" 
    method="POST">
  @csrf
  @method('PUT')
  @component('app.layouts._components.dados_conta_inquilino', compact('conta'))
      
  @endcomponent
  
  <div class="row center-itens">
    <div class="col-4">
        <button class="button confirmacao-button" type="submit">Cadastrar compra</button>
    </div>
  </div>
</form>