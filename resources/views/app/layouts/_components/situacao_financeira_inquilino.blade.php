<div class="col-12 dashboard-card" id="situacao-financeira-wrapper">
      @isset($situacao_financeira)
            <div>
                  <p> Referência: {{$situacao_financeira->referencia}}</p>
            </div>
            <div>
                  <p>Aluguel: {{ $situacao_financeira->aluguel }}</p>
                  <p>Conta de Luz: {{ $situacao_financeira->luz}} </p>
                  <p>Conta de Água: {{ $situacao_financeira->agua }}</p>
                  <p>Total: {{ $situacao_financeira->total }}
            </div>
            <div>
                  <input type="checkbox" id="quitado" name="checkbox-quitado" disabled>
                  <label for="checkbox-quitado">Referência quitada?</label>
            </div>
            <div>
                  <p>Saldo: <span id="saldo">{{$situacao_financeira->saldo}}</span></p>
            </div>
      @endisset
</div>