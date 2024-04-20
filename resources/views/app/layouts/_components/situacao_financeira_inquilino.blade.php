<div class="col-12 dashboard-card" id="situacao-financeira-wrapper">
      @isset($situacao_financeira)
            <div class="row">
                  <div class="col-12">
                        <span> Referência: {{$situacao_financeira->referencia}}</span>
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
                        <label for="checkbox-quitado">Referência quitada?</label>
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