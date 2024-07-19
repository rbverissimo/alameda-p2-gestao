<div class="dashboard light-dashboard">
    <div class="divisor-header secondary-divisor">Informações sobre serviços tomados por um imóvel</div>
    <div class="row">
        <div class="col-5">
            <label for="data-inicio-input">Data Início:</label>
            <input type="text" 
                id="data-inicio-input" 
                name="data-inicio"
                required
                value="{{ isset($servico->dataInicio) ? old('data-inicio', $dataInicio) : old('data-inicio')}}">
            <span class="errors-highlighted">{{ $errors->has('data-inicio') ? $errors->first('data-inicio') : '' }}</span>
        </div>
        <div class="col-5">
            <label for="data-fim-input">Data Encerramento:</label>
            <input type="text" 
                id="data-fim-input" 
                name="data-fim"
                required
                value="{{ isset($servico->dataFim) ? old('data-fim', $dataFim) : old('data-fim')}}">
            <span class="errors-highlighted">{{ $errors->has('data-fim') ? $errors->first('data-fim') : '' }}</span>
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
                <span class="errors-highlighted">{{ $errors->has('valor-servico') ? $errors->first('valor-servico') : '' }}</span>    
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