<table>
    <tr>
          <th>CNPJ</th>
          <th>Fornecedor</th>
          <th>Ações</th>
    </tr>
    @foreach ($fornecedores as $fornecedor)
          <tr class="table-row">
                <td>
                    <a class="table-link">{{$fornecedor->cnpj}}</a>
                </td>
                <td>
                    <a class="table-link">{{$fornecedor->nome_fornecedor}}</a>
                </td>
                <td>
                    <img onclick="redirecionarPara('{{route('editar-fornecedor', $fornecedor->id)}}')"  
                         class="crud-icon"  src="{{asset('icons/edit-icon.svg')}}" alt="edit">
                    <img class="crud-icon" src="{{asset('icons/delete-icon.svg')}}" alt="delete">
                </td>
          </tr>
    @endforeach
</table>