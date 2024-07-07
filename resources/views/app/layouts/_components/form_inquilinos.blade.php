<form action="{{ isset($inquilino->id) ? route('editar-inquilino', ['id' => $inquilino->id]) : route('cadastrar-inquilino')}}" 
    method="post" enctype="multipart/form-data">
    @csrf
    @if (isset($inquilino->id))
        @method('PUT')
    @endif
    <div class="row">
        <div class="col-4">
            <input required type="text" 
                name="nome" 
                placeholder="Nome completo: " 
                value="{{ isset($inquilino->nome) ? 
                    old('nome', $inquilino->nome) : old('nome')}}">
        </div>
        <div class="col-4">
            <input type="text" 
                name="cpf" 
                placeholder="CPF: "
                id="form-inquilino-cpf"
                value="{{ isset($inqulino->cpf) ? old('cpf', $inqulino->cpf) : old('cpf')}}">
        </div>
        @if (isset($inquilino->id))
            <div class="col-4">
                <div class="basic-card-wrapper">
                    <span>Situação: </span>
                    <span id="span-situacao">{{ $inquilino->situacao }}</span>
                </div>
            </div>
        @endif
    </div>
    <div class="row">
        <div class="col-3">
            <label for="form-inquilino-telefone-celular">Telefone celular:</label>
            <input required type="text" 
                name="telefone-celular" 
                placeholder="Celular com DDD:"
                id="form-inquilino-telefone-celular"
                value="{{ isset($inquilino->telefone_celular) ? 
                    old('telefone-celular', $inquilino->telefone_celular) : old('telefone-celular')}}">   
        </div>
        <div class="col-3">
            <label for="form-inquilino-telefone-fixo">Telefone fixo residencial:</label>
            <input type="text" 
                name="telefone-fixo" 
                placeholder="Fone fixo com DDD: "
                id="form-inquilino-telefone-fixo"
                value="{{ isset($inquilino->telefone_fixo) ?
                    old('telefone-fixo', $inquilino->telefone_fixo) : old('telefone-fixo')}}">
        </div>
        <div class="col-3">
            <label for="form-inquilino-telefone-trabalho">Contato de trabalho:</label>
            <input type="text" 
                name="telefone-trabalho" 
                placeholder="Fone trabalho com DDD: "
                id="form-inquilino-telefone-trabalho"
                value="{{ isset($inquilino->telefone_trabalho) ? 
                    old('telefone-trabalho', $inquilino->telefone_trabalho) : old('telefone-trabalho')}}">
        </div>
    </div>
    <div class="row">
        <div class="col-3">
            <label for="input-profissao">Profissão: </label>
            <input type="text" 
                name="profissao" 
                id="input-profissao"
                placeholder="ex: Autônomo, Médico, etc"
                value="{{ isset($inquilino->profissao) ? old('profissao', $inquilino->profissao) : old('profissao')}}">
        </div>
        <div class="col-3">
            <label for="input-fator-divisor">Fator divisor do cálculo: </label>
            <input type="text" 
                name="fator-divisor"
                id="input-fator-divisor"
                placeholder="Fator divisor: "
                maxlength="4"
                value="{{ isset($inquilino->fatorDivisor) ? 
                old('fator-divisor', $inquilino->fatorDivisor) : old('fator-divisor') }}">
        </div>
    </div>
    <div class="dashboard light-dashboard">
        <div class="divisor-header secondary-divisor">
            Informações do imóvel:
        </div>
        <div class="row">
            @isset($imoveis)
            <div class="col-3">
                  <select id="imoveis-conta-select" name="imovelcodigo">
                        @foreach ($imoveis as $imovel)
                              <option value="{{$imovel->id}}"
                                    @isset($inquilino->imovel)
                                          @if($inquilino->imovel == $imovel->id)
                                          selected
                                          @endif
                                    @endisset
                              >
                                    {{$imovel->nomefantasia}}
                              </option>
                        @endforeach
                  </select> 
            </div>
            @endisset 
            <div class="col-3">
                <select style="display: none" id="sala-select" name="sala">
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