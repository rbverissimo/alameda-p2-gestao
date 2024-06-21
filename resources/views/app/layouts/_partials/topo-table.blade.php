
      <div id="topo-table-state" class="topo-table-wrapper" style="display: none">
            <div class="col-2">
                  <input  placeholder="ID:  " id="search-keyup-id" onkeydown="apenasNumeros(event)" onkeyup="getSearchById()">
            </div>
            <div class="col-3">
                  <input  placeholder="Data:  " id="search-keyup-data" oninput="dataMascara(event)" onkeydown="apenasNumeros(event)" onkeyup="getSearchByData()">
            </div>
            <img class="crud-icon" onclick="addTableRow()" src="{{asset('icons/add-icon.svg')}}">
            <div class="col-4"></div>
            <div class="col-2" id="paginator-state">
                  @include('app.layouts._partials.paginator')
            </div>
      </div>