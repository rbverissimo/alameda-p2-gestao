<div class="dashboard light-dashboard">
    <div class="divisor-header secondary-divisor">
        Informações à cerca do contrato de locação 
    </div>
    <div class="row">
        <div class="col-3">
            <label for="contrato-input-data-assinatura">Data de assinatura: </label>
            <input name="data-assinatura" 
            id="contrato-input-data-assinatura"
            type="text" 
            placeholder="Data da assinatura do contrato: "
            value="{{ isset($contrato->dataAssinatura) ? 
                  old('data-assinatura', $contrato->dataAssinatura) : 
                        old('data-assinatura') }}">
        </div>
        <div class="col-3">
            <label for="contrato-input-data-expiracao">Data de expiração: </label>
            <input name="data-expiracao" 
            id="contrato-input-data-expiracao"
            type="text" placeholder="Data de expiração do contrato: "
            value="{{ isset($contrato->dataExpiracao) ? 
                  old('data-expiracao', $contrato->dataExpiracao) : 
                        old('data-expiracao') }}">
        </div>
        <div class="col-4">
            <span class="basic-card-wrapper">Renovação automática de contrato?</span>
        </div>
        <div class="col-1">
            <x-toggle-switch attName="renovacao-automatica"></x-toggle-switch>
        </div>
    </div>
    <div class="row">
        <div class="col-3">
            <label for="input-valor-aluguel">Valor do Aluguel: </label>
            <input type="text" 
                name="valor-aluguel"
                id="input-valor-aluguel"
                placeholder="R$800,00"
                value="{{ isset($contrato->valorAluguel) ? 
                old('valor-aluguel', $contrato->valorAluguel) : old('valor-aluguel')}}">
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <label for="arquivo-contrato"> 
                  Envie o comprovante:
            </label>
            <input type="file" id="arquivo-contrato" name="contrato">
      </div>
    </div>
    <div class="row">
        @isset($contrato->contrato)
            <div class="col-12">
                  <button class="button light-button">
                        <a id="link-arquivo-baixar">BAIXAR {{ $contrato->contrato }}</a>
                        <img style="margin-left: 1vw" src="{{asset('icons/download-icon.svg')}}" alt="download-icon">
                  </button>
            </div>
      @endisset       
    </div>
</div>