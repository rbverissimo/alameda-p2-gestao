<form action="{{ isset($inquilino->id) ? route('editar-inquilino', ['id' => $inquilino->id]) : route('cadastrar-inquilino')}}" 
    method="post" enctype="multipart/form-data">
    @csrf
    @if (isset($inquilino->id))
        @method('PUT')
    @endif
    <div class="row">
        <div class="col-5">
            <label id="label-input-inquilino-nome" for="form-inquilino-nome"></label>
            <input required type="text" 
                name="nome" 
                placeholder="Nome completo: " 
                id="form-inquilino-nome"
                minlength="3"
                value="{{ isset($inquilino->nome) ? 
                    old('nome', $inquilino->nome) : old('nome')}}">
            <span id="span-errors-inquilino-nome" class="errors-highlighted">{{ $errors->has('nome') ? $errors->first('nome') : ' '}}</span>        
        </div>
        <div class="col-4">
            <label id="label-input-inquilino-cpf" for="form-inquilino-cpf"></label>
            <input type="text" 
                name="cpf" 
                placeholder="CPF: "
                id="form-inquilino-cpf"
                value="{{ isset($inquilino->cpf) ? old('cpf', $inquilino->cpf) : old('cpf')}}">
            <span id="span-errors-inquilino-cpf" class="errors-highlighted">{{ $errors->has('cpf') ? $errors->first('cpf') : ' '}}</span>
        </div>
        @if (isset($inquilino->id))
            <div class="col-3">
                <div class="basic-card-wrapper">
                    <span>Situação: </span>
                    <span id="span-situacao">{{ $inquilino->situacao }}</span>
                </div>
            </div>
        @endif
    </div>
    <div class="row">
        <div class="col-6">
            <label for="input-profissao">Profissão: </label>
            <input type="text" 
                name="profissao" 
                id="input-profissao"
                minlength="6"
                placeholder="ex: Autônomo, Médico, etc"
                value="{{ isset($inquilino->profissao) ? old('profissao', $inquilino->profissao) : old('profissao')}}">
        </div>
        <div class="col-4">
            <label for="input-fator-divisor">Fator divisor do cálculo: </label>
            <input type="text" 
                name="fator-divisor"
                id="input-fator-divisor"
                placeholder="Fator divisor: "
                maxlength="4"
                value="{{ isset($inquilino->fatorDivisor) ? 
                old('fator-divisor', $inquilino->fatorDivisor) : old('fator-divisor') }}">
                <span class="errors-highlighted">{{ $errors->has('fator-divisor') ? $errors->first('fator-divisor') : ' '}}</span> 
        </div>
    </div>
    <div class="dashboard light-dashboard">
        <div class="divisor-header secondary-divisor">
            Informações do imóvel:
        </div>
        <div class="row">
            @isset($imobiliarias)
                <div class="col-4">
                    <x-forms.select pattern-name="imobiliarias-select" 
                        label-text="Selecione uma imobiliária: " 
                        :collection="$imobiliarias"></x-forms> 
                </div>
            @endisset 
            <div class="col-4">
                <select style="display: none" required id="sala-select" name="sala">
                    @isset($salas)
                        @foreach ($salas as $sala)
                            <option value="{{$sala->id}}"
                                @isset($inquilino->salacodigo)
                                    @if ($inquilino->salacodigo == $sala->id)
                                        selected
                                    @endif
                                @endisset
                                >
                                {{$sala->nomesala}}
                            </option>
                        @endforeach
                    @endisset
                </select>
            </div>
        </div>
    </div>
    @component('app.layouts._components.dados_contrato', compact('contrato'))
        
    @endcomponent
    <div class="row center-itens">
        <div class="col-2">
            <button class="button confirmacao-button">Salvar</button>
        </div>
    </div>
</form>