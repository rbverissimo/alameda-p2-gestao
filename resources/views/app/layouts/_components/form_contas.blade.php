<form action="{{route('calculo-contas')}}" method="POST">
      @csrf

      <div class="row">
            <div class="col-6">
                  <select>
                        <option>Luz - Sala 1</option>
                        <option>Luz - Casa 2</option>
                        <option>Luz - Casa 3</option>
                        <option>Água</option>
                  </select>
            </div>
            <div class="col-6">
                  <input placeholder="Valor da Conta em reais">
            </div>
      </div>
      <div class="row">
            <div class="col-6">
                  <input placeholder="Data do Vencimento: ">
            </div>
            <div class="col-6">
                  <input placeholder="Referência: ">
            </div>
      </div>
      <div class="row">
            <div class="col-6">
                  <input placeholder="Número do documento: ">
            </div>
            <div class="col-4">
                  <input placeholder="Ano: ">
            </div>
            <div class="col-2">
                  <input placeholder="Mês: ">
            </div>
      </div>
      <div class="row center-itens">
            <div class="col-3">
                  <button class="button confirmacao-button" type="submit">OK</button>
            </div>
      </div>
</form>