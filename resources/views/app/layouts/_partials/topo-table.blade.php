<div class="topo-table-wrapper">
      <img style="margin-left: 20px;" src="{{asset('icons/search-icon.svg')}}">
      <input  placeholder="ID:  " class="input-small input-topo-table" id="search-keyup-id" onkeydown="apenasNumeros(event)" onkeyup="getSearchById()">
      <input  placeholder="Data:  " class="input-small input-topo-table" id="search-keyup-data" oninput="dataMascara(event)" onkeydown="apenasNumeros(event)" onkeyup="getSearchByData()">
      <img style="margin-left: 25px;" class="crud-icon" onclick="addTableRow()" src="{{asset('icons/add-icon.svg')}}">
</div>