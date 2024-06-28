<form action="{{ isset($comprovante->id) ? route('comprovante-editar', ['id' => $comprovante->id]) : route('comprovantes-transferencia') }}"
       method="POST" enctype="multipart/form-data">
      @csrf
      @if (isset($comprovante->id))
            @method('PUT')
      @endif

      @isset($comprovante->id)
      <input name="id-comprovante" placeholder="ID" value="{{$comprovante->id}}" type="hidden">
      @endisset
      <div class="row">
            @isset($inquilinos)
                  <div class="col-12">
                        <label for="select-inquilino">Escolha um inquilino da lista: </label>
                        <select id="select-inquilino" name="inquilino">                 
                                    @foreach ($inquilinos as $inquilino)
                                          <option value="{{$inquilino->id}}">
                                                {{$inquilino->nome}}</option>
                                    @endforeach               
                        </select>
                  </div>
            @endisset     
      </div>
      <div class="row" >
            @isset($tipos_comprovantes)
                  <div class="col-6">
                        <select name="tipo-comprovante">
                              @foreach ($tipos_comprovantes as $tipo)    
                              <option value="{{$tipo->codigosistema}}"
            
                              @isset($comprovante->tipocomprovante)
                                    @if($comprovante->tipocomprovante == $tipo->codigosistema) selected @endif
                              @endisset
            
                              >{{$tipo->tipo}}</option>
                              @endforeach
                        </select>
                  </div>
            @endisset
            <div class="col-6">
                  <input name="valor-comprovante" id="input-valor-comprovante" type="text" placeholder="Valor do comprovante: "
                  value="{{ isset($comprovante->valor) ?
                  old('valor-comprovante', $comprovante->valor) : old('valor-comprovante') }}">
            </div>

      </div>
      <div class="row">
            <div class="col-12">
                  <textarea name="descricao" rows="3" cols="12" placeholder="Observações sobre o comprovante: " >
                        {{ isset($comprovante->descricao) ? 
                        old('descricao', $comprovante->descricao) : old('descricao') }}
                  </textarea>
            </div>
      </div>

      <div class="row">
            <div class="col-6">
            <input name="data-comprovante" id="data-input" type="text" placeholder="Data formato AAAA-mm-dd: "
            value="{{ isset($comprovante->dataComprovante) ? 
                  old('data-comprovante', $comprovante->dataComprovante) : 
                        old('data-comprovante') }}">
            </div>
            <div class="col-6">
            <input name="referencia" id="ano-mes-input" type="text" placeholder="Ano/mês da referência: "
                  value="{{ isset($comprovante->referencia) ?
                  old('referencia', $comprovante->referencia) : old('referencia') }}">
            </div>
      </div>
      <div class="row">
            <div class="col-6">
                  <label for="arquivo-comprovante"> 
                        Envie o comprovante:
                  </label>
                  <input type="file" name="arquivo-comprovante">
            </div>
            @isset($comprovante->arquivo_comprovante)
                  <div class="col-6">
                        <button class="button light-button">
                              <a id="link-arquivo-baixar" href="{{route('baixarArquivoContaImovel', ['idArquivo' => $comprovante->id]) }}">BAIXAR {{ $comprovante->arquivo_comprovante }}</a>
                              <img style="margin-left: 1vw" src="{{asset('icons/download-icon.svg')}}" alt="download-icon">
                        </button>
                  </div>
            @endisset
      
      </div>
      <div class="row center-itens">
            <div class="col-4">
                  <button class="button confirmacao-button" type="submit">OK</button>
            </div>
      </div>
</form>