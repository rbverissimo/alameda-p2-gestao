<div class="dashboard light-dashboard" id="situacao-financeira-wrapper">
      @isset($situacao_financeira)
            <div class="divisor-header secondary-divisor">
                  Situação financeira do mês com saldo consolidado de meses anteriores: 
            </div>
            <div class="row">
                  <div class="col-3">
                        <span class="basic-card-wrapper">
                              Referência: {{ $situacao_financeira->referencia }}
                        </span>
                  </div>
                  <div class="col-2"></div>
                  <div class="col-3">
                        <button class="button action-button">
                              Consolidar saldo
                        </button>
                  </div>
                  <div class="col-4">
                        <button onclick="redirecionarPara('{{ route('mostrar-situacao-financeira', ['id' => $inquilino->id]) }}')" 
                              class="button action-button">Mostrar referências anteriores
                        </button>
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