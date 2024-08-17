<div id="modal-{{$patternName}}">
    <div class="overlay"></div>
    <div class="dashboard-modal light-dashboard wide-form-modal">
        <header>
            <div class="flex-container">
                <div>
                    <h4>{{ $headerText }}</h4>
                </div>
                <div>
                    <button id="fechar-modal-{{$patternName}}" class="button cancelar-button">Fechar</button>
                </div>
            </div>
        </header>
        <div class="row">
            <div class="col-12">     
                <table id="modal-table-{{$patternName}}">
                    @php
                        $firstColumnHeader = $columnsNames[0];
                        $secondColumnHeader = $columnsNames[1];
                        $thirdColumnHeader = $columnsNames[2];
                    @endphp
                    <tr>
                        <th>{{$firstColumnHeader}}</th>
                        <th>{{$secondColumnHeader}}</th>
                        <th>{{$thirdColumnHeader}}</th>
                    </tr>
                @isset($collection)
                      @foreach ($collection as $c)

                            <tr class="table-row">
                            <td> 
                                <label for="check-{{$patternName}}-{{$c['identifier']}}">
                                    <input type="checkbox" name="check-{{$patternName}}-{{$c['identifier']}}">
                                </label>
                            </td>
                            <td><span>{{ $c['identifier'] }}</span></td>
                            <td><span>{{ $c['secondParam'] }}</span></td>
                            </tr>
                      @endforeach
                  @endisset      
                </table>
          </div>
        </div>
    </div>
</div>