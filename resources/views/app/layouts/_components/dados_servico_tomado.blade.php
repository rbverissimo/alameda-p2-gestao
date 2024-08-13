<div class="dashboard light-dashboard">
    <div class="divisor-header secondary-divisor">Informações sobre serviços tomados por um imóvel</div>
    <div class="row">
        @isset($imobiliarias)
        <div class="col-4">
            <x-forms.select 
                label-text="Selecione a imobiliária: "
                pattern-name="imobiliaria-select"
                :collection="$imobiliarias"
            />
        </div>
        @endisset 
        <div class="col-4">
            <x-forms.select 
                display="none"
                label-text="Indique um imóvel: "
                pattern-name="imovel-select"
                :collection="[]"
            />
        </div>
        <div class="col-4">
            <x-forms.select
                display="none"
                label-text="Indique a sala: "
                pattern-name="sala-select"
                :collection="[]"
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
                value="{{ isset($servico->dataInicio) ? old('data-inicio', $dataInicio) : old('data-inicio')}}">
            <span id="span-errors-data-inicio-input" class="errors-highlighted">{{ $errors->has('data-inicio') ? $errors->first('data-inicio') : '' }}</span>
        </div>
        <div class="col-5">
            <label id="label-data-fim-input" for="data-fim-input">Data Encerramento:</label>
            <input type="text" 
                id="data-fim-input" 
                name="data-fim"
                class="data-input"
                required
                value="{{ isset($servico->dataFim) ? old('data-fim', $dataFim) : old('data-fim')}}">
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
                value="{{ isset($servico->valor) ? old('valor-servico', $servico->valor) : old('valor-servico') }}">
                <span id="span-errors-valor-servico-input" class="errors-highlighted">{{ $errors->has('valor-servico') ? $errors->first('valor-servico') : '' }}</span>    
        </div>
        <div class="col-8">
            <label for="tipo-servico-select" id="label-tipo-servico-select">Indique o tipo de serviço tomado: </label>
            <select name="tipo-servico" 
                required
                id="tipo-servico-select">
                @foreach ($tipos_servicos as $tipo)
                    <option value="{{$tipo->codigo}}"
                        @isset($servico->tipo_servico)
                            @if ($servico->tipo_servico == $tipo->codigo)
                                selected
                            @endif
                        @endisset
                        >
                        {{ $tipo->tipo }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <label for="descricao-servico-input" id="label-descricao-servico-input">Descrição:</label>
            <textarea name="descricao-servico" 
                id="descricao-servico-input" 
                placeholder="Escreva aqui comentários relevantes sobre o serviço realizado"
                rows="3">{{isset($servico->descricao) ? 
            old('descricao-servico',$servico->descricao)
            : old('descricao-servico')}}</textarea>
        </div>
    </div>
</div>