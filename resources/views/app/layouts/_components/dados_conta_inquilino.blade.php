<div class="dashboard light-dashboard">
    <div class="divisor-header secondary-divisor">Informações do débito:</div>
    <div class="row">
        <div class="col-4">
            <label for="input-valor-inquilino">Valor do débito:</label>
            <input type="text" 
                id="input-valor-inquilino" 
                name="valor-inquilino"
                value="{{isset($conta->valorinquilino) ? old('valor-inquilino', $conta->valorinquilino) : old('valor-inquilino')}}">
                <span class="erros-highlighted" id="span-errors-valor-inquilino">
                    {{ $errors->has('valor-inquilino') ? $errors->first('valor-inquilino') : '' }}
                </span>
        </div>
        <div class="col-3">
            <span>Débito quitado?</span>
        </div>
        <div class="col-1">
            <x-toggle-switch attName="quitada" :checked="$conta->quitada === 'S'" />
        </div>
    </div>
    <div class="row">
        <div class="col-4">
            <label for="input-data-vencimento">Data Vencimento:</label>
            <input type="text" 
                id="input-data-vencimento" 
                name="data-vencimento"
                required
                readonly
                value="{{ isset($conta->dataVencimento) ? 
                        old('data-vencimento', $conta->dataVencimento) : old('data-vencimento') }}">
        </div>
        <div class="col-4">
            <label for="input-data-pagamento">Data Pagamento:</label>
            <input type="text" 
                id="input-data-pagamento" 
                name="data-pagamento"
                value="{{ isset($conta->dataPagamento) ? 
                        old('data-pagamento', $conta->dataPagamento) : old('data-pagamento') }}">
            <span class="errors-highlighted" id="span-errors-data-pagamento">
                {{ $errors->has('data-pagamento') ? $errors->first('data-pagamento') : '' }}
            </span>
        </div>
    </div>
</div>