<div id="situacao-financeira-wrapper">
      @isset($situacao_financeira)
            <div>
                  <p>{{$situacao_financeira->referencia}}</p>
            </div>
            <div>
                  <p>Aluguel: {{ $situacao_financeira->aluguel }}</p>
                  <p>Conta de Luz: {{ $situacao_financeira->luz}} </p>
                  <p>Conta de Água: {{ $situacao_financeira->agua }}</p>
                  <p>Total: {{ $situacao_financeira->total }}
            </div>
            <div>
                  <input type="checkbox" name="quitado" value="" disabled>
                  <label for="quitado">Referência quitada?</label>
            </div>
      @endisset
</div>