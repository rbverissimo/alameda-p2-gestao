<div id="table-wrapper">
    <div class="row">
          <div id="inside-div-table" class="col-12">     
                <table id='lista-contas'>
                      <tr>
                            <th>ID</th>
                            <th>Valor</th>
                            <th>Tipo</th>
                            <th>Sala</th>
                            <th>Ações</th>
                      </tr>
                      @foreach ($contas_imovel as $conta)
                          <tr class="table-row">
                            <td><span>{{ $conta->id}}</span></td>
                            <td><span class="span-resultado-calculo-valor">{{ $conta->valor}}</span></td>
                            <td><span>{{ $conta->tipoconta}}</span></td>
                            <td><span>{{ $conta->nomesala}}</span></td>
                            <td>
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
          </div>
    </div>
</div>