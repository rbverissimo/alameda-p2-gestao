<div id="topo-table-state" class="topo-table-wrapper">
      <div class="row" style="width: 100%">
            <div class="col-2">
                  <input  placeholder="ID:  " id="search-keyup-id" onkeydown="apenasNumeros(event)" onkeyup="getSearchById()">
            </div>
            <div class="col-3">
                  <input  placeholder="Data:  " id="search-keyup-data" oninput="dataMascara(event)" onkeydown="apenasNumeros(event)" onkeyup="getSearchByData()">
            </div>
            <div class="col-1" style="text-align: center">
                  <img class="crud-icon" onclick="addTableRow()" src="{{asset('icons/add-icon.svg')}}">
            </div>
            <div class="col-2" style="text-align: center" id="paginator-state">
                  @include('app.layouts._partials.paginator')
            </div>
      </div>
</div>