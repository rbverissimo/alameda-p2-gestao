<div class="dashboard light-dashboard">
    <div class="divisor-header secondary-divisor">
        Informações básicas do prestador de serviço
    </div>
    <div class="row">
        <div class="col-10">
            <label id="label-prestador-nome-input" for="prestador-nome-input">Nome ou razão social: </label>
            <input required type="text" 
                name="prestador-nome"  
                id="prestador-nome-input"
                required
                minlength="3"
                value="{{ $prestador->getNome() !== null ? 
                    old('prestador-nome', $prestador->getNome()) : old('prestador-nome')}}">
            <span id="span-errors-prestador-nome-input" class="errors-highlighted">
                {{ $errors->has('prestador-nome') ? $errors->first('prestador-nome') : ' '}}
            </span>        
        </div>
    </div>
    <div class="row">
        <div class="col-5">
            <label id="label-cnpj-prestador-input" for="cnpj-prestador-input">CNPJ: </label>
            <input type="text" 
                name="cnpj-prestador" 
                id="cnpj-prestador-input"
                value="{{ $prestador->getCnpj() !== null ? 
                    old('cnpj-prestador', $prestador->getCnpj()) : old('cnpj-prestador')}}">
            <span id="span-errors-cnpj-prestador-input" class="errors-highlighted">
                {{ $errors->has('cnpj-prestador') ? $errors->first('cnpj-prestador') : ' '}}
            </span>
        </div>
        <div class="col-5">
            <label id="label-cpf-prestador-input" for="cpf-prestador-input">CPF: </label>
            <input type="text" 
                name="cpf-prestador" 
                id="cpf-prestador-input"
                value="{{ $prestador->getCpf() !== null ? 
                    old('cpf-prestador', $prestador->getCpf()) : old('cpf-prestador')}}">
            <span id="span-errors-cpf-prestador-input" class="errors-highlighted">
                {{ $errors->has('cpf-prestador') ? $errors->first('cpf-prestador') : ''}}
            </span>
        </div>
    </div>
    <div class="row">
        <div class="col-5">
            <label id="label-telefone-trabalho" for="telefone-trabalho-input">Telefone:</label>
            <input type="text" 
                name="telefone-trabalho" 
                required
                id="telefone-trabalho-input"
                value="{{ $prestador->getTelefone() !== null ? 
                    old('telefone-trabalho', $prestador->getTelefone()) : old('telefone-trabalho')}}">
                <span id="span-errors-telefone-trabalho-input" class="errors-highlighted">
                    {{ $errors->has('telefone-trabalho') ? $errors->first('telefone-trabalho') : ' '}}
                </span>
        </div>
        <div class="col-6">
            <x-forms.select 
                pattern-name="imobiliaria-select" 
                labelText="Selecione a imobiliária" 
                :collection="$imobiliarias">
            </x-forms.select>
        </div>
    </div>
    <div class="dashboard light-dashboard">
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
    
    @if ($prestador->getEndereco() !== null)
        <x-forms.dados-endereco
            :model="$prestador->getEndereco()"
            titulo-header="Dados do endereço do prestador: "
        ></x-forms.dados-endereco>
    @else
        <div id="cadastrar-endereco-wrapper" class="row">
            <div class="col-3">
                <span class="basic-card-wrapper">Cadastrar endereço?</span>
            </div>
            <div class="col-2">
                <x-toggle-switch id="cadastrar-endereco-toggle-checkbox" attName="cadastrar-endereco-toggle"></x-toggle-switch>
            </div>
        </div>
        <div style="display: none" id="endereco-container">  
        </div>
    @endif
</div>