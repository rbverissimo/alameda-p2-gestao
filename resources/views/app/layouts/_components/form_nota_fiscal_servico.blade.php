<form action="{{ $nota === null ? route('cadastrar-nota-servico', ['idPrestador' => $idPrestador ]) : 
    route('editar-nota-servico', ['idPrestador' => $idPrestador ])}}" 
    method="POST" enctype="multipart/form-data">
    @isset($nota)
        @method('PUT')
    @endisset

    <div class="row">
        <div class="col-12">
            @component('app.layouts._components.dados_nota_fiscal_servico', compact('nota'))
                
            @endcomponent
        </div>
    </div>

    <div class="dashboard light-dashboard">
        <div class="row center-itens">
            <div class="col-2">
                <button class="button confirmacao-button">Salvar nota</button>
            </div>
        </div>
    </div>
</form>