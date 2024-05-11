<div class="dashboard light-dashboard" id="situacao-financeira-wrapper">
      @isset($situacao_financeira)
            <div class="row">
                  <div class="col-3">
                        <span class="basic-card-wrapper">
                              Referência: {{ $situacao_financeira->referencia }}
                        </span>
                  </div>
                  <div class="col-5"></div>
                  <div class="col-4">
                        <button class="button action-button">Mostrar referências anteriores</button>
                  </div>
            </div>
            <div class="row">
                  <div class="col-3">
                        <span class="basic-card-wrapper">Aluguel: {{ $situacao_financeira->aluguel }}</span>
                  </div>
                  <div class="col-3">
                        <span class="basic-card-wrapper">Conta de Luz: {{ $situacao_financeira->luz}} </span>
                  </div>
                  <div class="col-3">
                        <span class="basic-card-wrapper">Conta de Água: {{ $situacao_financeira->agua }}</span>
                  </div>
                  <div class="col-3">
                        <span class="basic-card-wrapper">Total: {{ $situacao_financeira->total }}</span>
                  </div>
            </div>
            <div class="row">
                  <div class="col-6">
                        <p>Saldo: 
                              <span id="saldo">{{$situacao_financeira->saldo}}</span>
                        </p>
                  </div>
            </div>
      @endisset
</div>