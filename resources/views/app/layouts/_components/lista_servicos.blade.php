<table>
    <tr>
          <th>Nome</th>
          <th>Valor</th>
          <th>Ações</th>
    </tr>
    @foreach ($servicos as $servico)
          <tr class="table-row">
                <td>
                    <a class="table-link">{{$servico->getNome()}}</a>
                </td>
                <td>
                    <a class="table-link">{{$servico->getValor()}}</a>
                </td>
                <td>
                    <img class="crud-icon" 
                        onclick="redirecionarPara('{{route('editar-servico', $servico->getId())}}')"    
                        src="{{asset('icons/edit-icon.svg')}}" 
                        alt="edit">
                    <img class="crud-icon" src="{{asset('icons/delete-icon.svg')}}" alt="delete">
                </td>
          </tr>
    @endforeach
</table>