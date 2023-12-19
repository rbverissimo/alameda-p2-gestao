<form action="{{route('comprovantes-transferencia')}}" method="POST">
      @csrf
      <input name="valor-comprovante" type="text" placeholder="Valor do comprovante: ">
      <br>
      <input name="referencia" type="text" placeholder="ano e mês da referência: ">
      <br>
      <select name="tipo-comprovante">
            <option value="1000">Pagamento TOTAL de contas da referência</option>
            <option value="1001">Pagamento PARCIAL de contas da referência</option>
            <option value="1002">Pagamento APENAS de aluguel da Referência</option>
            <option value="1003">Pagamento APENAS de contas de água e luz da referência</option>
      </select>
      <br>
      <textarea name="descricao" rows="3" cols="12" placeholder="Observações sobre o comprovante: ">
      </textarea>
      <br>
      <button type="submit">OK</button>
</form>