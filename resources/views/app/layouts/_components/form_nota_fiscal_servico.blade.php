<form action="{{ $nota === null ? route('cadastrar-nota-servico', ['idPrestador' => $idPrestador ]) : 
    route('editar-nota-servico', ['idPrestador' => $idPrestador ])}}" 
    method="POST" enctype="multipart/form-data">
    @csrf
    @if ($nota !== null)
        @method('PUT')
    @endif

    <div class="dashboard light-dashboard">
        <div class="row">
            <div class="col-12">
                @component('app.layouts._components.dados_nota_fiscal_servico', compact('nota', 'tipos_servicos'))
                    
                @endcomponent
            </div>
        </div>
        <div id="selection-container"></div>
        <div class="row center-itens">
            <div class="col-3">
                <button class="button confirmacao-button">@if ($nota === null)
                    Salvar nota
                @else
                    Atualizar nota
                @endif</button>
            </div>
        </div>
    </div>
    <div class="col-12">
        @php
            $collection = isset($servicos_prestados) ? array_map(function($servico){
                return [
                    'identifier' => $servico['codigo'],
                    'secondParam' => $servico['nome']
                ];
            }, $servicos_prestados) : [];
        @endphp
        <x-forms.modal-picker 
            pattern-name="pick-servicos"
            header-text="Serviços prestados: "
            :columns-names="['', 'Código', 'Serviço']"
            :collection="$collection"
        />

    </div>
</form>