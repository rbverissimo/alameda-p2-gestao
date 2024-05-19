<div id="table-wrapper">
      <div class="row">
            @include('app.layouts._partials.topo-table')
      </div>
      <div class="row">
            <div class="col-12">     
                  <table id='lista-comprovantes'>
                        <tr>
                              <th>ID</th>
                              <th>Valor</th>
                              <th>Data</th>
                              <th>Referência</th>
                              <th>Ações</th>
                        </tr>
                  @isset($comprovantes)
                        @foreach ($comprovantes as $comprovante)
                              <tr class="table-row">
                              <td><a class="table-link">{{ $comprovante->id}}</a></td>
                              <td><a class="table-link">{{ $comprovante->valor}}</a></td>
                              <td><a class="table-link">{{ $comprovante->dataComprovante}}</a></td>
                              <td><a class="table-link">{{ $comprovante->referencia}}</a></td>
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
                    @endisset      
                  </table>
            </div>
      </div>
</div>