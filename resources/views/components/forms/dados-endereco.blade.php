<div class="dashboard light-dashboard">
    <div class="divisor-header primary-divisor">
        {{ $titulo_header }}
    </div>
    <div class="row">
        <div class="col-3">
            <label for="input-cep">CEP:</label>
            <input type="text" 
            required
            id="input-cep" 
            name="cep"
            value="{{ isset($model->getRelation('endereco')->cep) ? 
                    old('cep', $model->getRelation('endereco')->cep) : old('cep')}}">
        </div>
        <div class="col-5">
            <label for="input-logradouro">Logradouro:</label>
            <input type="text" 
            required
            id="input-logradouro" 
            name="logradouro"
            value="{{ isset($model->getRelation('endereco')->logradouro) ? 
                    old('logradouro', $model->getRelation('endereco')->logradouro) : old('logradouro')}}">
        </div>
        <div class="col-3">
            <label for="input-numero-endereco">Número:</label>
            <input type="text" 
            required
            id="input-numero-endereco" 
            name="numero-endereco"
            value="{{ isset($model->getRelation('endereco')->numero) ? 
                    old('numero-endereco', $model->getRelation('endereco')->numero) : old('numero-endereco')}}">
        </div>
    </div>
    <div class="row">
        <div class="col-4">
            <label for="input-bairro">Bairro:</label>
            <input type="text" 
            required
            id="input-bairro" 
            name="bairro"
            value="{{ isset($model->getRelation('endereco')->bairro) ? 
                    old('bairro', $model->getRelation('endereco')->bairro) : old('bairro')}}">
        </div>
        <div class="col-4">
            <label for="input-bairro">Cidade:</label>
            <input type="text" 
            required
            id="input-cidade" 
            name="cidade"
            value="{{ isset($model->getRelation('endereco')->cidade) ? 
                    old('cidade', $model->getRelation('endereco')->cidade) : old('cidade')}}">
        </div>
        <div class="col-2">
            <label for="input-uf">UF:</label>
            <input type="text" 
            required
            id="input-uf" 
            maxlength="2"
            name="uf"
            value="{{ isset($model->getRelation('endereco')->uf) ? 
                old('uf', $model->getRelation('endereco')->uf) : old('uf')}}">
        </div>
    </div>
</div>