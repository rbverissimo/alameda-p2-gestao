<div id="dynamic-select-{{$patternName}}-{{$verificador}}" class="row outline">
    <div class="col-8">
        <x-forms.select 
            :label-text="$labelSelectText"
            :verificador="$verificador"
            :pattern-name="$patternName"
            :collection="$collection"
            :selected-value="$selectedValue"
        />
    </div>
    <div class="col-3">
        <label for="button-{{$patternName}}-{{$verificador}}">{{$labelButtonText}}</label>
        <button type="button" 
            id="button-{{$patternName}}-{{$verificador}}" 
            class="button deletar-button">{{$deletarButtonText}}
        </button>
    </div>
</div>