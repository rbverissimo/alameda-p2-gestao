<div class="dashboard light-dashboard">
    <div class="divisor-header secondary-divisor">
        Dados do fornecedor
    </div>
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