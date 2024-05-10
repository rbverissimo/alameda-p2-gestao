<table>
      <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Valor Aluguel</th>
            <th>Ações</th>
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
                  <a 
                        class="table-link valor-aluguel-lista-inquilinos" 
                        href="{{route('painel-inquilino', $inquilino->id)}}">{{'R$'.$inquilino->valorAluguel}}</a>
                  </td>
                  <td>
                        <img class="crud-icon" onclick="redirecionarPara('{{route('painel-inquilino', $inquilino->id)}}')"
                              src="{{asset('icons/info-icon.svg')}}" alt="info">
                        <img class="crud-icon" src="{{asset('icons/edit-icon.svg')}}" alt="edit" srcset="">
                  </td>
            </tr>
      @endforeach
</table>