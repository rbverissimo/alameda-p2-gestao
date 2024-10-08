<form action="{{ isset($conta_imovel->id) ? route('regravar-conta', ['id' => $conta_imovel->id]) : route('calculo-contas')}}" method="POST" enctype="multipart/form-data">
      @csrf
      @if (isset($conta_imovel->id))
            @method('PUT') 
      @endif
      <div class="row">
            @isset($imoveis)
                  <div class="col-4">
                        @php
                            $imovelSelected = null;
                        @endphp
                        <x-forms.select 
                              label-text="Selecione o imóvel:"
                              pattern-name="imovelcodigo"
                              :collection="$imoveis"
                              :selected-value="$imovelSelected"
                        />
                  </div>
            @endisset
            <div class="col-4">
                  <label for="sala-select" style="display: none" id="label-sala-select">Selecione a sala: </label>
                  <select style="display: none" required id="sala-select" name="sala">
                      @isset($salas)
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
                      @endisset
                  </select>
            </div>
            <div class="col-4">
                  <label for="tipos-conta-select" style="display: none" id="label-tipo-conta-select">Indique o tipo: </label>
                  <select style="display: none" required id="tipos-conta-select" name="tipo-conta">
                      @isset($tipos_conta)
                          @foreach ($tipos_conta as $tipo)
                              <option value="{{$tipo->id}}"
                                    @isset($conta_imovel->tipocodigo)
                                          @if ($conta_imovel->tipocodigo == $tipo->id)
                                          selected
                                          @endif
                                    @endisset 
                                  >
                                  {{$tipo->descricao}}
                              </option>
                          @endforeach
                      @endisset
                  </select>
            </div>
      </div>
      <div class="row">
            <div class="col-4">
                  <label for="input-valor" id="label-input-valor">Indique o valor:</label>
                  <input id="input-valor"
                        required
                        name="valor-conta"
                        placeholder="Valor da conta em reais: "
                        value="{{ isset($conta_imovel->valor) ? old('valor-conta', $conta_imovel->valor) : old('valor-conta')}}">
            </div>
            <div class="col-6">
                  <label for="data-input" id="label-data-input">Determine a data de vencimento:</label>
                  <input id="data-input"
                        name="data-vencimento"
                        required
                        placeholder="Data do Vencimento: "
                        value="{{ isset($conta_imovel->dataVencimento) ? 
                              old('data-vencimento', $conta_imovel->dataVencimento) : old('data-vencimento')}}">
                  <span class="errors-highlighted">{{ $errors->has('data-vencimento') ? $errors->first('data-vencimento') : ' '}}</span>             
            </div>
      </div>
      <div class="row">
            <div class="col-6">
                  <label for="input-numero-documento" id="label-numero-input">Nº do documento: </label>
                  <input class="numero-input"
                        id="input-numero-documento" 
                        name="numero-documento"
                        placeholder="Número do documento: "
                        value="{{ isset($conta_imovel->nrDocumento) ?
                              old('numero-documento', $conta_imovel->nrDocumento) : old('numero-documento')}}">
            </div>
            <div class="col-6">
                  <label for="ano-mes-input" id="label-ano-mes-input">Referência da Conta:</label>
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
            <div class="col-4">
                  <label for="input-ano-conta" id="label-input-ano-conta">Ano cobrança: </label>
                  <input class="numero-input"
                        id="input-ano-conta"
                        name="ano"
                        required
                        minlength="2" 
                        maxlength="4" 
                        placeholder="Ano: "
                        value="{{ isset($conta_imovel->ano) ?
                              old('ano', $conta_imovel->ano) : old('ano')}}">
            </div>
            <div class="col-3">
                  <label for="input-mes-conta" id="label-input-mes-conta">Mês cobrança: </label>
                  <input class="numero-input"
                        id="input-mes-conta"
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
                        Enviar conta:
                  </label>
                  <input type="file" name="arquivo-conta">
            </div>
            @isset($conta_imovel->arquivo_conta)
                  <div class="col-6">
                        <label for="baixar-button">Baixar arquivo da conta: </label>
                        <button id="baixar-button" class="button light-button">
                              <a id="link-arquivo-baixar" href="{{route('baixarArquivoContaImovel', ['idArquivo' => $conta_imovel->id]) }}"> {{ $conta_imovel->arquivo_conta }}</a>
                              <img style="margin-left: 1vw" src="{{asset('icons/download-icon.svg')}}" alt="download-icon">
                        </button>
                  </div>
            @endisset
      </div>
      <div class="row center-itens">
            <div class="col-3">
                  <button class="button confirmacao-button" type="submit">Salvar</button>
            </div>
      </div>
</form>