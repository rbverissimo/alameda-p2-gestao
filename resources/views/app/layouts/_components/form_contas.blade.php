<form action="{{route('calculo-contas')}}" method="POST">
      @csrf
      <input name="conta-luz-1" type="text" placeholder="Conta Sala 1">
      <br>
      <input name="conta-luz-2" type="text" placeholder="Conta Casa 2">
      <br>
      <input name="conta-luz-3" type="text" placeholder="Conta Casa 3">
      <br>
      <input name="conta-agua" type="text" placeholder="Conta de Água">
      <br>
      <input name="mes-referencia" type="text" placeholder="Mês">
      <br>
      <input name="ano-referencia" type="text" placeholder="Ano">
      <br>
      <button type="submit">OK</button>
</form>