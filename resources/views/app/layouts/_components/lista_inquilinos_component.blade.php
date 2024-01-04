<table>
      <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Telefone</th>
            <th>Valor do Aluguel</th>
      </tr>
      @foreach ($inquilinos_ativos as $inquilino)
            <tr class="table-row">
                  <td>
                  <a class="table-link" href="{{route('painel-inquilino', $inquilino->id)}}">{{$inquilino->id}}</a>
                  </td>
                  <td>
                  <a class="table-link" href="{{route('painel-inquilino', $inquilino->id)}}">{{$inquilino->nome}}</a>
                  </td>
                  <td>
                  <a class="table-link" href="{{route('painel-inquilino', $inquilino->id)}}">{{$inquilino->telefone_celular}}</a>
                  </td>
                  <td>
                  <a class="table-link" href="{{route('painel-inquilino', $inquilino->id)}}">{{$inquilino->valorAluguel}}</a>
                  </td>
            </tr>
      @endforeach
</table>