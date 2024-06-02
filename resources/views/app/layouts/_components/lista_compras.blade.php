<table>
    <tr>
          <th>ID</th>
          <th>Data</th>
          <th>Valor</th>
          <th>Ações</th>
    </tr>
    @foreach ($compras as $compra)
          <tr class="table-row">
                <td>
                <a class="table-link" href="{{route('painel-inquilino', $inquilino->id)}}">{{$compra->id}}</a>
                </td>
                <td>
                <a class="table-link" href="{{route('painel-inquilino', $inquilino->id)}}">{{$compra->dataCompra}}</a>
                </td>
                <td>
                <a 
                      class="table-link" >{{'R$'.$compra->valor}}</a>
                </td>
                <td>
                    <img class="crud-icon" src="{{asset('icons/edit-icon.svg')}}" alt="edit">
                    <img class="crud-icon" src="{{asset('icons/delete-icon.svg')}}" alt="delete">
                </td>
          </tr>
    @endforeach
</table>