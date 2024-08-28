<table>
    <tr>
          <th>Nome</th>
          <th>Valor</th>
          <th>Ações</th>
    </tr>
    @foreach ($servicos as $servico)
          <tr class="table-row">
                <td>
                    <span>{{$servico->getNome()}}</span>
                </td>
                <td>
                    <span class="lista-servicos-valor">{{$servico->getValor()}}</span>
                </td>
                <td>
                    <img class="crud-icon" 
                        onclick="redirecionarPara('{{route('editar-servico', $servico->getId())}}')"    
                        src="{{asset('icons/edit-icon.svg')}}" 
                        alt="edit">
                    @csrf
                    <img class="crud-icon del-servico-icon" data-registro="{{$servico->getId()}}" src="{{asset('icons/delete-icon.svg')}}" alt="delete">
                </td>
          </tr>
    @endforeach
</table>