<div>
      <img src="{{asset('icons/search-icon.svg')}}">
      <div>
            <input  placeholder="ID: " class="input-small" id="search-keyup-id" onkeyup="getSearchById()">
      </div>
      <img class="crud-icon" onclick="addTableRow()" src="{{asset('icons/add-icon.svg')}}">
</div>