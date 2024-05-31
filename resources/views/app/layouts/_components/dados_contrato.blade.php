<div class="dashboard light-dashboard">
    <div class="divisor-header secondary-divisor">
        Informações à cerca do contrato de locação 
    </div>
    <div class="row">
        <div class="col-3">
            <input name="data-assinatura" type="text" placeholder="Data da assinatura do contrato: "
            value="{{ isset($contrato->dataAssinatura) ? 
                  old('data-comprovante', $contrata->dataAssinatura) : 
                        old('data-comprovante') }}">
        </div>
        <div class="col-3">
            <input name="data-expiracao" type="text" placeholder="Data de expiração do contrato: "
            value="{{ isset($contrato->dataAssinatura) ? 
                  old('data-comprovante', $contrata->dataAssinatura) : 
                        old('data-comprovante') }}">
        </div>
        <div class="col-4">
            <x-toggle-switch></x-toggle-switch>
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
            <input type="file" name="contrato">
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