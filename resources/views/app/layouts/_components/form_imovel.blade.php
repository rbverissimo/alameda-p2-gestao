<form action="{{(route('cadastrar-imovel'))}}" method="POST">
      @csrf
      <div class="row">
            <div class="col-3">
                  <label for="cep">CEP: </label>
                  <input type="text"
                        name="cep"
                        placeholder="Ex. 12456-90: "
                        id="form-cadastro-imovel-cep-imovel"
                        value="{{ isset($imovel->cep) ? 
                        old('cep', $imovel->cep) : old('cep')}}">
                  <span class="errors-highlighted">{{ $errors->has('cep') ? $errors->first('cep') : ' '}}</span>
            </div>
            <div class="col-5">
                  <label for="logradouro">Logradouro: </label>
                  <input type="text"
                        name="logradouro"
                        placeholder="Ex. Rua, Avenida, Alameda: "
                        value="{{ isset($imovel->logradouro) ? 
                        old('logradouro', $imovel->logradouro) : old('logradouro')}}">
            </div>
            <div class="col-4">
                  <label for="bairro">Bairro: </label>
                  <input type="text"
                        name="bairro"
                        placeholder="Ex. Setor Central, Bairro Novo: "
                        value="{{ isset($imovel->bairro) ? 
                        old('bairro', $imovel->bairro) : old('bairro')}}">
            </div>
      </div>
      <div class="row">
            <div class="col-2">
                  <label>Número: </label>
                  <input name="numero"
                        placeholder="Ex. 786, 1030: "
                        id="form-cadastro-imovel-numero-imovel"
                        value="{{ isset($imovel->numero) ?
                        old('numero', $imovel->numero) : old('numero') }}">
            </div>
            <div class="col-2">
                  <label>Quadra: </label>
                  <input name="quadra"
                        placeholder="Ex. 40, 2, 3: "
                        id="form-cadastro-imovel-quadra-imovel"
                        value="{{ isset($imovel->quadra) ?
                        old('quadra', $imovel->quadra) : old('quadra') }}">
            </div>
            <div class="col-2">
                  <label>Lote: </label>
                  <input name="lote"
                        placeholder="Ex. 2, 3, 10: "
                        id="form-cadastro-imovel-lote-imovel"
                        value="{{ isset($imovel->lote) ?
                        old('lote', $imovel->lote) : old('lote') }}">
            </div>
            <div class="col-6">
                  <label>Complemento: </label>
                  <input name="complemento"
                        placeholder="Ex. Edifício Santana, Loteamento das Flores, etc: "
                        value="{{ isset($imovel->complemento) ?
                        old('complemento', $imovel->complemento) : old('complemento') }}">
            </div>
      </div>
      <div class="row">
            <div class="col-6">
                  <label>Nome identificador do imóvel: </label>
                  <input name="nomefantasia"
                        placeholder="Ex. Vila do Chaves: "
                        value="{{ isset($imovel->nomefantasia) ?
                        old('nomefantasia', $imovel->nomefantasia) : old('nomefantasia') }}">
            </div>
      </div>
      <div class="row center-itens">
            <div class="col-3">
                  <button type="submit" class="button confirmacao-button">Ok</button>
            </div>
      </div>
</form>