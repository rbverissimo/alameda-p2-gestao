
      <table>
            <tr>
                  <th>ID</th>
                  <th>Nome</th>
                  <th>Endereço</th>
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
                              <a class="table-link">{{ $i->logradouro . ' ' . $i->bairro . ' ' . $i->numero . ' ' . $i->cep . ' ' . $i->cidade }}</a>
                        </td>
                        <td>
                              <div class="col-3">
                                    <img onclick="redirecionarPara('{{route('imoveis-detalhar', $i->id)}}')" class="crud-icon" src="{{asset("icons/info-icon.svg")}}" alt="INFO">
                              </div>
                              <div class="col-3">
                                    <img class="crud-icon" src="{{asset("icons/edit-icon.svg")}}" alt="EDITAR">
                              </div>
                              <div class="col-3">
                                    <img class="crud-icon" src="{{asset("icons/delete-icon.svg")}}" alt="EXCLUIR">
                              </div>
                        </td>
                  </tr>
            @endforeach
      </table>