<form action="{{ route('cadastrar-sala', ['idImovel' => $imovel->id]) }}" method="POST">
    @csrf
    @component('app.layouts._components.dados_salas', compact('imovel'))
        
    @endcomponent
    <div class="row center-itens">
        <div class="col-3">
              <button type="submit" class="button confirmacao-button">Salvar</button>
        </div>
    </div>
</form>