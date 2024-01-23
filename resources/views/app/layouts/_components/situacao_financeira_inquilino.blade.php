<div id="situacao-financeira-wrapper">
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
                  <input type="checkbox" name="quitado" checked="{{$situacao_financeira->quitado}}" disabled>
                  <label for="quitado">Referência quitada?</label>
            </div>
            <div>
                  <p>Saldo: {{$situacao_financeira->saldo}}</p>
            </div>
      @endisset
</div>