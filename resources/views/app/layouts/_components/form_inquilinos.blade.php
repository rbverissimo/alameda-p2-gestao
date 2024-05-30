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
            <input required type="text" 
                name="telefone-celular" 
                placeholder="Celular com DDD:"
                value="{{ isset($inquilino->telefone_celular) ? 
                    old('telefone-celular', $inquilino->telefone_celular) : old('telefone-celular')}}">   
        </div>
        <div class="col-3">
            <input type="text" 
                name="telefone-fixo" 
                placeholder="Fone fixo com DDD: "
                value="{{ isset($inquilino->telefone_fixo) ?
                    old('telefone-fixo', $inquilino->telefone_fixo) : old('telefone-fixo')}}">
        </div>
        <div class="col-3">
            <input type="text" 
                name="telefone-trabalho" 
                placeholder="Fone trabalho com DDD: "
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
                value="{{ isset($inquilino->fatorDivisor) ? 
                old('fator-divisor', $inquilino->fatorDivisor) : old('fator-divisor') }}">
        </div>
        <div class="col-3">
            <label for="input-valor-aluguel">Valor do Aluguel: </label>
            <input type="text" 
                name="valor-aluguel"
                id="input-valor-aluguel"
                placeholder="R$800,00"
                value="{{ isset($inquilino->valorAluguel) ? 
                old('valor-aluguel', $inquilino->valorAluguel) : old('valor-aluguel')}}">
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
                                    @isset($conta_imovel->imovelcodigo)
                                          @if($conta_imovel->imovelcodigo == $imovel->id)
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
            @isset($salas)
            <div class="col-3">
                <select id="sala-select" name="sala">
                    @foreach ($salas as $sala)
                          <option value="{{$sala->id}}"
                                @isset($conta_imovel->salacodigo)
                                      @if ($conta_imovel->salacodigo == $sala->id)
                                                selected
                                      @endif
                                @endisset
                                >
                                    {{$sala->nomesala}}
                            </option>
                    @endforeach
                </select>
            </div>
            @endisset
        </div>
    </div>
    @component('app.layouts._components.dados_contrato', compact('contrato'))
        
    @endcomponent
    <div class="row center-itens">
        <div class="col-2">
            <button class="button confirmacao-button">OK</button>
        </div>
    </div>
</form>