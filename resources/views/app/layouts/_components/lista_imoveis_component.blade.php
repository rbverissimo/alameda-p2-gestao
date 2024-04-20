
      <table>
            <tr>
                  <th>ID</th>
                  <th>Nome</th>
                  <th>Endereço</th>
                  <th>Qtde. Inquilinos</th>
                  <th>Ações</th>
            </tr>
            @foreach ($imoveis as $i)
                  <tr class="table-row">
                        <td>
                        <a class="table-link">{{$i->id}}</a>
                        </td>
                        <td>
                        <a class="table-link">{{$i->nomefantasia}}</a>
                        </td>
                        <td>
                        <a class="table-link">{{$i->endereço}}</a>
                        </td>
                        <td>
                        <a class="table-link">{{$i->qtdeInquilinos}}</a>
                        </td>
                        <td>
                        </td>
                  </tr>
            @endforeach
      </table>