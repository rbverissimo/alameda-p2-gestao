<div class="dashboard light-dashboard">
    <div class="divisor-header primary-divisor">
        {{ $tituloHeader }}
    </div>
    <div class="row">
        <div class="col-3">
            <label for="input-cep">CEP:</label>
            <input type="text" 
            required
            id="input-cep" 
            name="cep"
            value="{{ $model->getCep() !== null ? 
                    old('cep', $model->getCep()) : old('cep')}}">
        </div>
        <div class="col-6">
            <label for="input-logradouro">Logradouro:</label>
            <input type="text" 
            required
            id="input-logradouro" 
            name="logradouro"
            value="{{ $model->getLogradouro() !== null ? 
                    old('logradouro', $model->getLogradouro()) : old('logradouro')}}">
        </div>
        <div class="col-3">
            <label for="input-numero-endereco">Número:</label>
            <input type="text" 
            required
            id="input-numero-endereco" 
            name="numero-endereco"
            value="{{ $model->getNumero() !== null ? 
                    old('numero-endereco', $model->getNumero()) : old('numero-endereco')}}">
        </div>
    </div>
    <div class="row">
        <div class="col-5">
            <label for="input-bairro">Bairro:</label>
            <input type="text" 
            required
            id="input-bairro" 
            name="bairro"
            value="{{ $model->getBairro() !== null ? 
                    old('bairro', $model->getBairro()) : old('bairro')}}">
        </div>
        <div class="col-5">
            <label for="input-bairro">Cidade:</label>
            <input type="text" 
            required
            id="input-cidade" 
            name="cidade"
            value="{{ $model->getCidade() !== null ? 
                    old('cidade', $model->getCidade()) : old('cidade')}}">
        </div>
        <div class="col-2">
            <label for="input-uf">UF:</label>
            <input type="text" 
            required
            id="input-uf" 
            maxlength="2"
            name="uf"
            value="{{ $model->getUf() !== null ? 
                old('uf', $model->getUf()) : old('uf')}}">
        </div>
    </div>
</div>