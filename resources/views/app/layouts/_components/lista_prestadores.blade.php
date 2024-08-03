<table>
    <tr>
          <th>CNPJ</th>
          <th>Nome</th>
          <th>Ações</th>
    </tr>
    @foreach ($prestadores as $prestador)
          <tr class="table-row">
                <td>
                    <a class="table-link">{{$prestador->cnpj}}</a>
                </td>
                <td>
                    <a class="table-link">{{$prestador->nome}}</a>
                </td>
                <td>
                    <img class="crud-icon" 
                        onclick="redirecionarPara('{{route('editar-prestador', $prestador->id)}}')"    
                        src="{{asset('icons/edit-icon.svg')}}" 
                        alt="edit">
                    <img class="crud-icon" src="{{asset('icons/delete-icon.svg')}}" alt="delete">
                </td>
          </tr>
    @endforeach
</table>