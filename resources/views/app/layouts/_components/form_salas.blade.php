<form action="{{ route('cadastrar-sala')}}" method="post">
    @csrf
    @component('app.layouts._components.dados_salas')
        
    @endcomponent
    <div class="row center-itens">
        <div class="col-3">
              <button type="submit" class="button confirmacao-button">Salvar</button>
        </div>
    </div>
</form>