<div id="table-wrapper">
      @include('app.layouts._partials.topo-table')
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
      <div id="paginator-state">
            @include('app.layouts._partials.paginator')
      </div>
</div>