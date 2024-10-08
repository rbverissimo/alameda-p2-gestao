<div class="dashboard light-dashboard">
    <div class="divisor-header secondary-divisor">Informações sobre serviços tomados por um imóvel</div>
    <div class="row">
        @isset($imobiliarias)
        <div class="col-4">
            @php
                $selectedImobiliaria = isset($servico) ? $servico->getImobiliaria() : null;
            @endphp
            <x-forms.select 
                label-text="Selecione a imobiliária: "
                pattern-name="imobiliaria-select"
                :collection="$imobiliarias"
                :selected-value="$selectedImobiliaria"
            />
        </div>
        @endisset 
        <div class="col-4">
            @php
                $selectedImovel = isset($servico) ? $servico->getImovel() : null;
                $collectionImovel = isset($servico) ? $servico->getImoveisSelect() : [];
                $displayImovel = isset($selectedImovel) ? 'block' : 'none';
            @endphp
            <x-forms.select 
                :display="$displayImovel"
                label-text="Indique um imóvel: "
                pattern-name="imovel-select"
                :collection="$collectionImovel"
                :selected-value="$selectedImovel"
            />
        </div>
        <div class="col-4">
            @php
                $selectedSala = isset($servico) ? $servico->getSala() : null;
                $collectionSalas = isset($servico) ? $servico->getSalasSelect() : [];
                $displaySala = isset($selectedSala) ? 'block' : 'none';
            @endphp
            <x-forms.select
                :display="$displaySala"
                label-text="Indique a sala: "
                pattern-name="sala-select"
                :collection="$collectionSalas"
                :selected-value="$selectedSala"
            />
        </div>
    </div>
    <div class="row">
        <div class="col-5">
            <label id="label-data-inicio-input" for="data-inicio-input">Data Início:</label>
            <input type="text" 
                id="data-inicio-input" 
                name="data-inicio"
                class="data-input"
                required
                @if (isset($servico))
                    value="{{ $servico->getDataInicio() !== null ? old('data-inicio', $servico->getDataInicio()) : old('data-inicio')}}"
                @endif
                >
            <span id="span-errors-data-inicio-input" class="errors-highlighted">{{ $errors->has('data-inicio') ? $errors->first('data-inicio') : '' }}</span>
        </div>
        <div class="col-5">
            <label id="label-data-fim-input" for="data-fim-input">Data Encerramento:</label>
            <input type="text" 
                id="data-fim-input" 
                name="data-fim"
                class="data-input"
                required
                @if (isset($servico))
                    value="{{$servico->getDataFim() !== null ? old('data-fim', $servico->getDataFim()) : old('data-fim')}}"
                @endif
                >
            <span id="span-errors-data-fim-input" class="errors-highlighted">{{ $errors->has('data-fim') ? $errors->first('data-fim') : '' }}</span>
        </div>
    </div>
    <div class="row">
        <div class="col-4">
            <label for="valor-servico-input" id="label-valor-servico-input">Valor total do serviço:</label>
            <input type="text" 
                id="valor-servico-input" 
                name="valor-servico"
                placeholder="R$0,00"
                @if (isset($servico))    
                    value="{{ $servico->getValor() !== null ? old('valor-servico', $servico->getValor()) : old('valor-servico') }}"
                @endif
                >
                <span id="span-errors-valor-servico-input" class="errors-highlighted">{{ $errors->has('valor-servico') ? $errors->first('valor-servico') : '' }}</span>    
        </div>
        <div class="col-8">
            @php
                $collection = isset($tipos_servicos) ? $tipos_servicos : [];
                $selectedValue = isset($servico) ? $servico->getTipo() : null;
            @endphp
            <x-forms.select
                label-text="Indique o tipo de serviço tomado:"
                pattern-name="tipo-servico"
                :required="true"
                :collection="$collection"
                :selected-value="$selectedValue"
            />
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <label for="descricao-servico-input" id="label-descricao-servico-input">Descrição:</label>
            <textarea name="descricao-servico" 
                id="descricao-servico-input" 
                placeholder="Escreva aqui comentários relevantes sobre o serviço realizado"
                rows="3">@if(isset($servico)){{ $servico->getDescricao() !== null ? 
                old('descricao-servico',$servico->getDescricao())
                : old('descricao-servico')}}@endif</textarea>
        </div>
    </div>
</div>