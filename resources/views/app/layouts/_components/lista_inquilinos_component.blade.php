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
                              src="{{asset('icons/info-icon.svg')}}" alt="mais informações">
                        <img class="crud-icon" 
                              onclick="redirecionarPara('{{route('detalhar-inquilino', $inquilino->id)}}')" 
                              src="{{asset('icons/edit-icon.svg')}}" 
                              alt="detalhar inquinlino" 
                        >
                  </td>
            </tr>
      @endforeach
</table>