<div class="dashboard light-dashboard" id="situacao-financeira-wrapper">
      @isset($situacao_financeira)
            <div class="divisor-header secondary-divisor">
                  Situação financeira do mês com saldo consolidado de meses anteriores: 
            </div>
            <div class="row">
                  <div class="col-5">
                        <span class="basic-card-wrapper">
                              Referência: <span id="span-referencia-situacao-financeira">{{ $situacao_financeira->referencia }}</span> 
                        </span>
                  </div>
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
                        <span class="basic-card-wrapper">Aluguel: <span class="span-valores-contas-aluguel">{{ $situacao_financeira->aluguel }}</span></span>
                  </div>
            </div>

            <div class="divisor-header secondary-divisor">
                  Contas consolidadas do mês: 
            </div>
            @forelse ($situacao_financeira->contas_inquilino as $contas)
                  <div class="row">
                        @foreach ($contas as $key => $value)
                              <div class="col-3">
                                          <span class="basic-card-wrapper">{{ $key }}: <span class="span-valores-contas-aluguel">{{ $value }}</span></span>
                                    </div>
                        @endforeach
                  </div>
            @empty
                  <div class="row">
                        <div class="col-6">
                              <span class="basic-card-wrapper">Ainda não foram calculadas as contas da referência atual para o imóvel desse inquilino</span>
                        </div>
                  </div>
                
            @endforelse
                  
            <div class="row">
                  <div class="col-6">
                        <span class="basic-card-wrapper">Total: <span class="span-valores-contas-aluguel">{{ $situacao_financeira->total_contas_mensais }}</span>
                              <br>
                              <span class="crumble-text">Aluguel + Contas do mês</span>
                        </span>
                        
                  </div>
            </div>
            <div class="divisor-header secondary-divisor">
                  Saldos
            </div>
            <div class="row">
                  <div class="col-6">
                        <p>Saldo parcial mensal: 
                              <span class="span-valores-contas-aluguel" id="saldo">{{$situacao_financeira->saldo_parcial}}</span>
                        </p>
                  </div>
            </div>
            @if (isset($situacao_financeira->saldo_atual))
                  <div class="row">
                        <div id="saldo-atual-consolidado" class="col-5">
                              <p>Saldo atual:
                                    <span class="span-valores-contas-aluguel" id="span-valor-saldo-atual">{{ $situacao_financeira->saldo_atual }}</span><br>
                                    <span class="crumble-text">Já consolidado</span>
                              </p>
                        </div>
                        <div id="saldo-atual-ultima-atualizacao" class="col-7">
                              <p>Data da consolidação: 
                                    <span id="span-data-ultimo-saldo-atual"> {{ $situacao_financeira->data_ultimo_saldo_atual }}</span>
                                    @isset($situacao_financeira->is_saldo_defasado)
                                        @if ($situacao_financeira->is_saldo_defasado)
                                          <br>
                                          <span id="span-saldo-defasado" class="errors-highlighted">Saldo defasado. Consolide o saldo para atualizar. </span> 
                                        @endif
                                    @endisset
                              </p>
                        </div>
                  </div>
            @endif
      @endisset
</div>