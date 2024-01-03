<table>
      <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Telefone</th>
            <th>Valor do Aluguel</th>
      </tr>
      @foreach ($inquilinos_ativos as $inquilino)
            <tr class="table-row">
                  <td><a href="{{route('painel-inquilino', $inquilino->id)}}">{{$inquilino->id}}</a></td>
                  <td>{{$inquilino->nome}}</td>
                  <td>{{$inquilino->telefone_celular}}</td>
                  <td>{{$inquilino->valorAluguel}}</td>
            </tr>
      @endforeach
</table>