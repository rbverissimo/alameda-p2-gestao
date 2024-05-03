<form action="{{(route('cadastrar-imovel'))}}" method="POST">
      @csrf
      <div class="row">
            <div class="col-3">
                  <label for="cep">CEP: </label>
                  <input type="text"
                        name="cep"
                        placeholder="Ex. 12456-90: "
                        value="{{ isset($imovel->cep) ? 
                        old('cep', $imovel->cep) : old('cep')}}">
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
                        placeholder="Ex. Setor Central, Bairro das Nações, etc : "
                        value="{{ isset($imovel->bairro) ? 
                        old('bairro', $imovel->bairro) : old('bairro')}}">
            </div>
      </div>
      <div class="row">
      </div>
      <div class="row center-itens">
            <div class="col-3">
                  <button type="submit" class="button confirmacao-button">Ok</button>
            </div>
      </div>
</form>