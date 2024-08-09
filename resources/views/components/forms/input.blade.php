<label id="label-input-{{$patternName}}" for="form-{{$patternName}}">{{$labelText}}</label>
    <input required type="text" 
            name="{{$attrName}}" 
            placeholder="{{$placeholder}}" 
            id="form-{{$patternName}}"
            value="{{ isset($dataInput) ? 
                old($attrName, $dataInput) : old($attrName) }} ">
<span id="span-errors-{{$patternName}}" class="errors-highlighted">{{ $errors->has($attrName) ? $errors->first($attrName) : ' '}}</span> 