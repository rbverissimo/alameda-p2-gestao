<form action="{{ route('cadastrar-tipos-contas', ['idImovel' => $idImovel]) }}" method="POST">
    @csrf
    <div class="row">
        <div class="col-12">
            <x-chip-group :chips="$chips"></x-chip-group>
        </div>
    </div>
    <div class="row center-itens">
        <div class="col-3">
              <button type="submit" class="button confirmacao-button">Salvar</button>
        </div>
    </div>
</form>