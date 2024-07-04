<div class="dashboard light-dashboard">
    <div class="divisor-header secondary-divisor">
        Dados do fornecedor
    </div>
    <div class="row">
        <div class="col-4">
            <label for="input-nome-fornecedor">Nome do fornecedor:</label>
            <input type="text" 
            required
            id="input-nome-fornecedor" 
            name="nome-fornecedor"
            value="{{ isset($fornecedor->nome_fornecedor) ? 
                    old('nome-fornecedor', $fornecedor->nome_fornecedor) : old('nome-fornecedor')}}">
        </div>
        <div class="col-4">
            <label for="input-cnpj-fornecedor">CNPJ:</label>
            <input type="text" 
            id="input-cnpj-fornecedor" 
            name="cnpj-fornecedor" required
            value="{{ isset($fornecedor->cnpj) ? 
                    old('cnpj-fornecedor', $fornecedor->cnpj) : old('cnpj-fornecedor')}}">
        </div>
        <div class="col-4">
            <label for="input-telefone-fornecedor">Telefone:</label>
            <input type="text" 
            required
            id="input-telefone-fornecedor" 
            name="telefone-fornecedor"
            value="{{ isset($fornecedor->telefone) ? 
                    old('telefone-fornecedor', $fornecedor->telefone) : old('telefone-fornecedor')}}">
        </div>
    </div>
</div>
<div class="dashboard light-dashboard">
    <div class="divisor-header primary-divisor">
        Dados do endereço do fornecedor
    </div>
    <div class="row">
        <div class="col-3">
            <label for="input-cep">CEP:</label>
            <input type="text" 
            required
            id="input-cep" 
            name="cep"
            value="{{ isset($fornecedor->getRelation('endereco')->cep) ? 
                    old('cep', $fornecedor->getRelation('endereco')->cep) : old('cep')}}">
        </div>
        <div class="col-5">
            <label for="input-logradouro">Logradouro:</label>
            <input type="text" 
            required
            id="input-logradouro" 
            name="logradouro"
            value="{{ isset($fornecedor->getRelation('endereco')->logradouro) ? 
                    old('logradouro', $fornecedor->getRelation('endereco')->logradouro) : old('logradouro')}}">
        </div>
        <div class="col-3">
            <label for="input-numero-endereco">Número:</label>
            <input type="text" 
            required
            id="input-numero-endereco" 
            name="numero-endereco"
            value="{{ isset($fornecedor->getRelation('endereco')->numero) ? 
                    old('numero-endereco', $fornecedor->getRelation('endereco')->numero) : old('numero-endereco')}}">
        </div>
    </div>
    <div class="row">
        <div class="col-4">
            <label for="input-bairro">Bairro:</label>
            <input type="text" 
            required
            id="input-bairro" 
            name="bairro"
            value="{{ isset($fornecedor->getRelation('endereco')->bairro) ? 
                    old('bairro', $fornecedor->getRelation('endereco')->bairro) : old('bairro')}}">
        </div>
        <div class="col-4">
            <label for="input-bairro">Cidade:</label>
            <input type="text" 
            required
            id="input-cidade" 
            name="cidade"
            value="{{ isset($fornecedor->getRelation('endereco')->cidade) ? 
                    old('cidade', $fornecedor->getRelation('endereco')->cidade) : old('cidade')}}">
        </div>
        <div class="col-2">
            <label for="input-uf">UF:</label>
            <input type="text" 
            required
            id="input-uf" 
            maxlength="2"
            name="uf"
            value="{{ isset($fornecedor->getRelation('endereco')->uf) ? 
                old('uf', $fornecedor->getRelation('endereco')->uf) : old('uf')}}">
        </div>
    </div>
</div>