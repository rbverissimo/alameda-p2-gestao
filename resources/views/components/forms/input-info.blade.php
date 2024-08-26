<div id="ii-container-{{$patternName}}-{{$verificador}}">
    <div class="row">
        <div class="col-6">
            <x-forms.input 
            pattern-name="{{$patternName}}"
            data-input="{{$dataInput}}"
            attr-name="{{$attrName}}"
            readonly="{{$readonlyInput}}"
            />
        </div>
        <div class="col-3">
            <button type="button" id="info-input-button-{{$patternName}}-{{$verificador}}" 
            class="button info-button i-info-i">{{$infoButtonText}}</button>
        </div>
        <div class="col-3">
            <button type="button" id="deletar-input-button-{{$patternName}}-{{$verificador}}" 
            class="button deletar-button d-info-i">{{$deletarButtonText}}</button>
        </div>
    </div>
</div>