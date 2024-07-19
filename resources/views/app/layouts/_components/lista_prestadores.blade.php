<table>
    <tr>
          <th>CNPJ</th>
          <th>Nome</th>
          <th>Tipo</th>
          <th>Ações</th>
    </tr>
    @foreach ($prestadores as $prestador)
          <tr class="table-row">
                <td>
                    <a class="table-link">{{$prestador->getRelation('pessoa')->cnpj}}</a>
                </td>
                <td>
                    <a class="table-link">{{$servico->getRelation('pessoa')->nome}}</a>
                </td>
                <td>
                    <a class="table-link">{{$servico->getRelation('tipo_prestador')->tipo}}</a>
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