<div id="table-wrapper">
      <div class="row">
            <div class="col-10">
                  @include('app.layouts._partials.topo-table')
            </div>
            <div class="col-2" id="paginator-state">
                  @include('app.layouts._partials.paginator')
            </div>
      </div>
      <div class="row">
            <div class="col-12 scrollable-table">     
                  <table id='lista-comprovantes'>
                        <tr>
                              <th>ID</th>
                              <th>Valor</th>
                              <th>Data</th>
                              <th>Referência</th>
                              <th>Tipo</th>
                              <th></th>
                              <th></th>
                        </tr>
                  </table>
            </div>
      </div>
</div>