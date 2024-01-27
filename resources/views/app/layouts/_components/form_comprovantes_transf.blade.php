<form action="{{route('comprovantes-transferencia')}}" method="POST">
      @csrf
      @isset($comprovante->id)
      <input name="id-comprovante" type="text" placeholder="ID" value="{{$comprovante->id}}" disabled>
      @endisset
      <input name="valor-comprovante" type="text" placeholder="Valor do comprovante: "
      value="{{ isset($comprovante->valor) ?
            old('valor-comprovante', $comprovante->valor) : old('valor-comprovante') }}">
      <br>
      @isset($tipos_comprovantes)
            <select name="tipo-comprovante">
                  @foreach ($tipos_comprovantes as $tipo)    
                  <option value="{{$tipo->codigosistema}}">{{$tipo->tipo}}</option>
                  @endforeach
            </select>
      @endisset
      <br>
      <textarea name="descricao" rows="3" cols="12" placeholder="Observações sobre o comprovante: " value="{{ isset($comprovante->descricao) ? 
            old('descricao', $comprovante->descricao) : old('descricao') }}">
      </textarea>

      @isset($inquilinos)
            <select name="inquilino">                 
                        @foreach ($inquilinos as $inquilino)
                              <option value="{{$inquilino->id}}">
                                    {{$inquilino->nome}}</option>
                        @endforeach               
            </select>
      @endisset

      <br>
      <input name="data-comprovante" type="text" placeholder="Data formato AAAA-mm-dd: "
      value="{{ isset($comprovante->dataComprovante) ? 
            old('data-comprovante', $comprovante->dataComprovante) : 
                  old('data-comprovante') }}">
      <br>
      <input name="referencia" type="text" placeholder="Ano/mês da referência: "
      value="{{ isset($comprovante->referencia) ?
            old('referencia', $comprovante->referencia) : old('referencia') }}">
      <button type="submit">OK</button>
</form>