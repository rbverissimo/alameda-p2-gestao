<form action="" method="GET">
    @csrf
    @component('app.layouts._components.dados_fornecedor', compact('fornecedor'))
        
    @endcomponent

    <div class="row center-itens">
        <div class="col-4">
              <button class="button confirmacao-button" type="submit">Salvar</button>
        </div>
    </div>

</form>