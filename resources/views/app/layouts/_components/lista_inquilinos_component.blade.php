<div id="conteudo-table-wrapper">
      <table>
            <tr>
                  <th>Nome</th>
                  <th>Valor Aluguel</th>
                  <th>Ações</th>
            </tr>
            @foreach ($inquilinos_ativos as $inquilino)
                  <tr class="table-row">
                        <td>
                        <span class="table-link">{{$inquilino->nome}}</span>
                        </td>
                        <td>
                        <span class="table-link valor-aluguel-lista-inquilinos" >{{$inquilino->valorAluguel}}</span>
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
</div>