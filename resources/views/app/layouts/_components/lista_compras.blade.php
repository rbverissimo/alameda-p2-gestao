<table>
    <tr>
          <th>Data</th>
          <th>Fornecedor</th>
          <th>Valor</th>
          <th>Ações</th>
    </tr>
    @foreach ($compras as $compra)
          <tr class="table-row">
                <td>
                <a class="table-link">{{$compra->dataCompra}}</a>
                </td>
                <td>
                <a class="table-link">{{$compra->nome_fornecedor}}</a>
                </td>
                <td>
                <a 
                      class="table-link" >{{'R$'.$compra->valor}}</a>
                </td>
                <td>
                    <img class="crud-icon" 
                        onclick="redirecionarPara('{{route('editar-compra', $compra->id)}}')"    
                        src="{{asset('icons/edit-icon.svg')}}" 
                        alt="editar compra">
                    <img class="crud-icon" 
                    onclick="deletarRegistro('{{route('deletar-compra', $compra->id)}}', '{{ $compra->id}}')"
                    src="{{asset('icons/delete-icon.svg')}}" 
                    alt="delete compra">
                </td>
          </tr>
    @endforeach
</table>