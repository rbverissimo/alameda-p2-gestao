<form action="" method="post" enctype="multipart/form-data">
    @csrf
    @component('app.layouts._components.dados_compra', compact('formas_pagamento', 'imoveis'))
        
    @endcomponent
    <div class="row center-itens">
        <div class="col-4">
              <button class="button confirmacao-button" type="submit">Cadastrar compra</button>
        </div>
  </div>
</form>