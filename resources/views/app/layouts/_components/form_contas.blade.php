<form action="{{route('calculo-contas')}}" method="POST">
      @csrf
      <input name="conta-luz-1" type="text" placeholder="Conta Sala 1">
      <input name="data-vencimento-conta-luz-1" type="text" placeholder="Data de Vencimento: ">
      <input name="referenciaConta-conta-luz-1" type="text" placeholder="Referência: ">
      <input name="nr-documento-conta-luz-1" type="text" placeholder="Número do documento: ">
      <br>
      <input name="conta-luz-2" type="text" placeholder="Conta Casa 2">
      <input name="data-vencimento-conta-luz-2" type="text" placeholder="Data de Vencimento: ">
      <input name="referenciaConta-conta-luz-2" type="text" placeholder="Referência: ">
      <input name="nr-documento-conta-luz-2" type="text" placeholder="Número do documento: ">
      <br>
      <input name="conta-luz-3" type="text" placeholder="Conta Casa 3">
      <input name="data-vencimento-conta-luz-3" type="text" placeholder="Data de Vencimento: ">
      <input name="referenciaConta-conta-luz-3" type="text" placeholder="Referência: ">
      <input name="nr-documento-conta-luz-3" type="text" placeholder="Número do documento: ">
      <br>
      <input name="conta-agua" type="text" placeholder="Conta de Água">
      <input name="data-vencimento-conta-agua" type="text" placeholder="Data de Vencimento: ">
      <input name="referenciaConta-conta-agua" type="text" placeholder="Referência: ">
      <input name="nr-documento-conta-agua" type="text" placeholder="Número do documento: ">
      <br>
      <input name="mes-referencia" type="text" placeholder="Mês">
      <br>
      <input name="ano-referencia" type="text" placeholder="Ano">
      <br>
      <button type="submit">OK</button>
</form>