<div class="dashboard light-dashboard">
    <div class="divisor-header secondary-divisor">
        Informações básicas do prestador de serviço
    </div>
    <div class="row">
        <div class="col-8">
            <label id="label-prestador-nome-input" for="prestador-nome-input">Nome ou razão social</label>
            <input required type="text" 
                name="prestador-nome"  
                id="prestador-nome-input"
                required
                minlength="3"
                value="{{ isset($prestador->nome) ? 
                    old('prestador-nome', $prestador->nome) : old('prestador-nome')}}">
            <span id="span-errors-prestador-nome-input" class="errors-highlighted">
                {{ $errors->has('prestador-nome') ? $errors->first('prestador-nome') : ' '}}
            </span>        
        </div>
        <div class="col-4">
            <label id="label-cnpj-prestador-input" for="cnpj-prestador-input">CNPJ: </label>
            <input type="text" 
                name="cnpj-prestador" 
                id="cnpj-prestador-input"
                value="{{ isset($prestador->cnpj) ? 
                    old('cnpj-prestador', $prestador->cnpj) : old('cnpj-prestador')}}">
            <span id="span-errors-cnpj-prestador-input" class="errors-highlighted">
                {{ $errors->has('cnpj-prestador') ? $errors->first('cnpj-prestador') : ' '}}
            </span>
        </div>
    </div>
    <div class="row">
        <div class="col-4">
            <label id="label-telefone-trabalho" for="telefone-trabalho-input">Telefone:</label>
            <input type="text" 
                name="telefone-trabalho" 
                required
                id="telefone-trabalho-input"
                value="{{ isset($prestador->telefone_trabalho) ? 
                    old('telefone-trabalho', $prestador->telefone_trabalho) : old('telefone-trabalho')}}">
                <span id="span-errors-telefone-trabalho-input" class="errors-highlighted">
                    {{ $errors->has('telefone-trabalho') ? $errors->first('telefone-trabalho') : ' '}}
                </span>
        </div>
    </div>
    <div class="dashboard ligh-dashboard">
        <div class="divisor-header secondary-divisor">
            Tipos de serviços prestados pelo prestador
        </div>
        <div class="row">
            <div class="col-4">
                <button id="adicionar-tipo-button" class="button special-action-button">Adicionar tipo</button>
            </div>
        </div>
        <div id="tipo-wrapper">

        </div>
    </div>
    <div class="row">
        <div class="col-4">
            <button id="cadastrar-endereco-button" class="button action-button">Cadastrar endereço?</button>
        </div>
    </div>
    <div style="display: none" id="endereco-container">  
    </div>
</div>