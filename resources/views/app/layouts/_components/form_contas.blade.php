<form action="{{ isset($conta_imovel->id) ? route('regravar-conta', ['id' => $conta_imovel->id]) : route('calculo-contas')}}" method="POST" enctype="multipart/form-data">
      @csrf
      @if (isset($conta_imovel->id))
            @method('PUT') 
      @endif
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
            <div class="col-3">
                  
                  @isset($tipos_contas)
                        <select id="tipo-conta-select" name="tipo_conta">
                              @foreach ($tipos_contas as $conta)
                                                <option value="{{$conta->id}}"
                                                      @isset($conta_imovel->tipocodigo)
                                                            @if ($conta_imovel->tipocodigo == $conta->id)
                                                            selected
                                                            @endif
                                                      @endisset
                                                >
                                                      {{$conta->descricao}}</option>
                              @endforeach   
                        </select>
                  @endisset
            </div>
            <div class="col-3">
                  @isset($tipos_salas)
                        <select id="sala-select" style="display: none" name="sala">
                              @foreach ($tipos_salas as $sala)
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
                  @endisset
            </div>
            <div class="col-3">
                  <input id="input-valor"
                        required
                        name="valor-conta"
                        placeholder="Valor da conta em reais: "
                        value="{{ isset($conta_imovel->valor) ? old('valor-conta', $conta_imovel->valor) : old('valor-conta')}}">
            </div>
      </div>
      <div class="row">
            <div class="col-6">
                  <input id="data-input"
                        name="data-vencimento"
                        required
                        placeholder="Data do Vencimento: "
                        value="{{ isset($conta_imovel->dataVencimento) ? 
                              old('data-vencimento', $conta_imovel->dataVencimento) : old('data-vencimento')}}">
            </div>
            <div class="col-6">
                  <input id="ano-mes-input"
                        name="referencia"
                        required
                        minlength="7"
                        placeholder="Referência: "
                        value="{{ isset($conta_imovel->referenciaConta) ?
                        old('referencia', $conta_imovel->referenciaConta) : old('referencia')}}">
            </div>
      </div>
      <div class="row">
            <div class="col-6">
                  <input class="numero-input" 
                        name="numero-documento"
                        placeholder="Número do documento: "
                        value="{{ isset($conta_imovel->nrDocumento) ?
                              old('numero-documento', $conta_imovel->nrDocumento) : old('numero-documento')}}">
            </div>
            <div class="col-4">
                  <input class="numero-input"
                        name="ano"
                        required
                        minlength="2" 
                        maxlength="4" 
                        placeholder="Ano: "
                        value="{{ isset($conta_imovel->ano) ?
                              old('ano', $conta_imovel->ano) : old('ano')}}">
            </div>
            <div class="col-2">
                  <input class="numero-input"
                        name="mes"
                        required
                        minlength="1"
                        maxlength="2"
                        placeholder="Mês: "
                        value="{{ isset($conta_imovel->mes) ?
                              old('mes', $conta_imovel->mes) : old('mes')}}">
            </div>
      </div>
      <div class="row">
            <div class="col-6">
                  <label for="arquivo-conta"> 
                        Envie a conta:
                  </label>
                  <input type="file" name="arquivo-conta">
            </div>
            @isset($conta_imovel->arquivo_conta)
                  <div class="col-6">
                        <button class="button light-button">
                              <a id="link-arquivo-baixar" href="{{route('baixarArquivoContaImovel', ['idArquivo' => $conta_imovel->id]) }}">BAIXAR {{ $conta_imovel->arquivo_conta }}</a>
                              <img style="margin-left: 1vw" src="{{asset('icons/download-icon.svg')}}" alt="download-icon">
                        </button>
                  </div>
            @endisset
      </div>
      <div class="row center-itens">
            <div class="col-3">
                  <button class="button confirmacao-button" type="submit">OK</button>
            </div>
      </div>
</form>