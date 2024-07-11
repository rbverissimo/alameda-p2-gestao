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
                        <button id="consolidar-saldo-button-painel-inquilino" class="button action-button">
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
                        <span class="basic-card-wrapper">Total: {{ $situacao_financeira->total_contas_mensais }}</span>
                  </div>
            </div>
            <div class="divisor-header special-divisor">
                  Saldos
            </div>
            <div class="row">
                  <div class="col-6">
                        <p>Saldo parcial mensal: 
                              <span id="saldo">{{$situacao_financeira->saldo_parcial}}</span>
                        </p>
                  </div>
            </div>
            @if (isset($situacao_financeira->saldo_atual))
                  <div class="row">
                        <div id="saldo-atual-consolidado" class="col-6">
                              <p>Saldo atual consolidado:
                                    <span>{{ $situacao_financeira->saldo_atual }}</span>
                              </p>
                        </div>
                        <div id="saldo-atual-ultima-atualizacao" class="col-6">

                        </div>
                  </div>
            @endif
      @endisset
</div>