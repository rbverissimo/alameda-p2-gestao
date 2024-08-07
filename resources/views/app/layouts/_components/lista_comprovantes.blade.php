<div id="table-wrapper">
      <div class="row">
            @includeWhen( $incluir_topo, 'app.layouts._partials.topo-table')
      </div>
      <div class="row">
            <div class="col-12">     
                  <table id='lista-comprovantes'>
                        <tr>
                              <th>ID</th>
                              <th>Valor</th>
                              <th>Data</th>
                              <th>Ações</th>
                        </tr>
                  @isset($comprovantes)
                        @foreach ($comprovantes as $comprovante)
                              <tr class="table-row">
                              <td><span>{{ $comprovante->id}}</span></td>
                              <td><span class="span-valor-tabela">{{ $comprovante->valor}}</span></td>
                              <td><span class="span-data-tabela">{{ $comprovante->dataComprovante}}</span></td>
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