<form action="{{(route('cadastrar-imovel'))}}" method="POST">
      @csrf
      <div class="dashboard light-dashboard">
            <div class="divisor-header secondary-divisor">Identificação do Imóvel</div>
            <div class="row">
                  <div class="col-6">
                        <label>Nome identificador do imóvel: </label>
                        <input name="nomefantasia"
                              required
                              placeholder="Ex. Casa 10 do Centro, Edifício Sta. Cecília, etc: "
                              value="{{ isset($imovel->nomefantasia) ?
                              old('nomefantasia', $imovel->nomefantasia) : old('nomefantasia') }}">
                        <span class="errors-highlighted">{{ $errors->has('numero') ? $errors->first('numero') : ' '}}</span>      
                  </div>
                  <div class="col-6">
                        @php
                            $cnpj = isset($imovel) ? $imovel->cnpj : null;
                        @endphp
                        <x-forms.input 
                              label-text="Digite o CNPJ: "
                              pattern-name="cnpj-imovel"
                              attr-name="cnpj-imovel"
                              :required="false"
                              :data-input="$cnpj"
                        />
                  </div>
            </div>
            <div class="divisor-header secondary-divisor">
                  Dados do Imóvel
            </div>
            <div class="row">
                  <div class="col-4">
                        <label for="cidade">Cidade: </label>
                        <input type="text" 
                              name="cidade"
                              required
                              placeholder="Goiânia, São Paulo etc:"
                              id="form-cadastro-imovel-cidade-imovel"
                              value="{{ isset($imovel->cidade) ? 
                              old('cidade', $imovel->cidade) : old('cidade')}}">
                        <span class="errors-highlighted">{{ $errors->has('cidade') ? $errors->first('cidade') : ' '}}</span>                             
                  </div>
                  <div class="col-2">
                        <label for="uf">UF: </label>
                        <input type="text" 
                              name="uf"
                              maxlength="2"
                              required
                              placeholder="GO:"
                              id="form-cadastro-imovel-uf-imovel"
                              value="{{ isset($imovel->uf) ? 
                              old('uf', $imovel->uf) : old('uf')}}">
                        <span class="errors-highlighted">{{ $errors->has('uf') ? $errors->first('uf') : ' '}}</span>                             
                  </div>
                  <div class="col-3">
                        <label for="cep">CEP: </label>
                        <input type="text"
                              name="cep"
                              required
                              placeholder="Ex. 12456-90: "
                              id="form-cadastro-imovel-cep-imovel"
                              value="{{ isset($imovel->cep) ? 
                              old('cep', $imovel->cep) : old('cep')}}">
                        <span class="errors-highlighted">{{ $errors->has('cep') ? $errors->first('cep') : ' '}}</span>
                  </div>
            </div>
            <div class="row">     
                  <div class="col-6">
                        <label for="logradouro">Logradouro: </label>
                        <input type="text"
                              name="logradouro"
                              required
                              placeholder="Ex. Rua, Avenida, Alameda: "
                              value="{{ isset($imovel->logradouro) ? 
                              old('logradouro', $imovel->logradouro) : old('logradouro')}}">
                        <span class="errors-highlighted">{{ $errors->has('logradouro') ? $errors->first('logradouro') : ' '}}</span>      
                  </div>
                  <div class="col-4">
                        <label for="bairro">Bairro: </label>
                        <input type="text"
                              name="bairro"
                              required
                              placeholder="Ex. Setor Central, Bairro Novo: "
                              value="{{ isset($imovel->bairro) ? 
                              old('bairro', $imovel->bairro) : old('bairro')}}">
                         <span class="errors-highlighted">{{ $errors->has('bairro') ? $errors->first('bairro') : ' '}}</span>            
                  </div>
            </div>
            <div class="row">
                  <div class="col-3">
                        <label for="form-cadastro-imovel-numero-imovel">Número: </label>
                        <input name="numero"
                              required
                              placeholder="Ex. 786, 1030: "
                              id="form-cadastro-imovel-numero-imovel"
                              value="{{ isset($imovel->numero) ?
                              old('numero', $imovel->numero) : old('numero') }}">
                        <span class="errors-highlighted">{{ $errors->has('numero') ? $errors->first('numero') : ' '}}</span>       
                  </div>
                  <div class="col-2">
                        <label for="form-cadastro-imovel-quadra-imovel">Quadra: </label>
                        <input name="quadra"
                              placeholder="Ex. 40, 2, 3: "
                              id="form-cadastro-imovel-quadra-imovel"
                              value="{{ isset($imovel->quadra) ?
                              old('quadra', $imovel->quadra) : old('quadra') }}">
                  </div>
                  <div class="col-2">
                        <label for="form-cadastro-imovel-lote-imovel">Lote: </label>
                        <input name="lote"
                              placeholder="Ex. 2, 3, 10: "
                              id="form-cadastro-imovel-lote-imovel"
                              value="{{ isset($imovel->lote) ?
                              old('lote', $imovel->lote) : old('lote') }}">
                  </div>
            </div>
            <div class="row">
                  <div class="col-8">
                        <label>Complemento: </label>
                        <input name="complemento"
                              placeholder="Ex. Edifício Santana, Loteamento das Flores, etc: "
                              value="{{ isset($imovel->complemento) ?
                              old('complemento', $imovel->complemento) : old('complemento') }}">
                  </div>
            </div>
      </div>
      <div class="row center-itens">
            <div class="col-3">
                  <button type="submit" class="button confirmacao-button">Salvar</button>
            </div>
      </div>
</form>