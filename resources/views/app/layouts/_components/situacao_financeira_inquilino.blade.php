<div class="dashboard light-dashboard" id="situacao-financeira-wrapper">
      @isset($situacao_financeira)
            <div class="row">
                  <div class="col-3">
                        <span class="basic-card-wrapper">Referência: </span>
                  </div>
                  <div style="align-self: center" class="col-4">
                        @include('app.layouts._partials.simple-carousel')
                  </div>
            </div>
            <div class="row">
                  <div class="col-3">
                        <span>Aluguel: {{ $situacao_financeira->aluguel }}</span>
                  </div>
                  <div class="col-3">
                        <span>Conta de Luz: {{ $situacao_financeira->luz}} </span>
                  </div>
                  <div class="col-3">
                        <span>Conta de Água: {{ $situacao_financeira->agua }}</span>
                  </div>
                  <div class="col-3">
                        <span>Total: {{ $situacao_financeira->total }}</span>
                  </div>
            </div>
            <div class="row">
                  <div class="col-6">
                        <label for="quitado">Referência quitada?</label>
                        <input type="checkbox" id="quitado" name="checkbox-quitado" disabled>
                  </div>
                  <div class="col-6">
                        <p>Saldo: 
                              <span id="saldo">{{$situacao_financeira->saldo}}</span>
                        </p>
                  </div>
            </div>
      @endisset
</div>