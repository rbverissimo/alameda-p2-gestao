<div class="dashboard light-dashboard">
    <div class="divisor-header secondary-divisor">
        Informações à cerca do contrato de locação 
    </div>
    <div class="row">
        <div class="col-3">
            <label id="label-input-data-assinatura" for="contrato-input-data-assinatura">Data de assinatura: </label>
            <input name="data-assinatura" 
            id="contrato-input-data-assinatura"
            type="text" 
            required
            placeholder="Data da assinatura do contrato: "
            value="{{ isset($contrato->dataAssinatura) ? 
                  old('data-assinatura', $contrato->dataAssinatura) : 
                        old('data-assinatura') }}">
            <span id="span-errors-data-assinatura" class="errors-highlighted">{{ $errors->has('data-assinatura') ? $errors->first('data-assinatura') : ' '}}</span>             
        </div>
        <div class="col-3">
            <label id="label-input-data-expiracao" for="contrato-input-data-expiracao">Data de expiração: </label>
            <input name="data-expiracao" 
            id="contrato-input-data-expiracao"
            type="text" placeholder="Data de expiração do contrato: "
            value="{{ isset($contrato->dataExpiracao) ? 
                  old('data-expiracao', $contrato->dataExpiracao) : 
                        old('data-expiracao') }}">
            <span id="span-errors-data-expiracao" class="errors-highlighted">{{ $errors->has('data-expiracao') ? $errors->first('data-expiracao') : ' '}}</span>                         
        </div>
        <div class="col-4">
            <span class="basic-card-wrapper">Renovação automática de contrato?</span>
        </div>
        <div class="col-1">
            @if (isset($contrato))
                <x-toggle-switch 
                id="renovacao-automatica-input-switch"
                attName="renovacao-automatica" 
                :checked="$contrato->renovacaoAutomatica === 'S'" />
            @else
                <x-toggle-switch id="renovacao-automatica-input-switch" attName="renovacao-automatica"/>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-3">
            <label id="label-input-valor-aluguel" for="input-valor-aluguel">Valor do Aluguel: </label>
            <input type="text" 
                name="valor-aluguel"
                id="input-valor-aluguel"
                required
                placeholder="R$800,00"
                value="{{ isset($contrato->valorAluguel) ? 
                old('valor-aluguel', $contrato->valorAluguel) : old('valor-aluguel')}}">
                <span id="span-errors-valor-aluguel" class="errors-highlighted">{{ $errors->has('valor-aluguel') ? $errors->first('valor-aluguel') : ' '}}</span>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <label for="arquivo-contrato"> 
                  Envie o comprovante:
            </label>
            <input type="file" id="arquivo-contrato" name="contrato">
            <span class="errors-highlighted">{{ $errors->has('arquivo-contrato') ? $errors->first('arquivo-contrato') : ' '}}</span>
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