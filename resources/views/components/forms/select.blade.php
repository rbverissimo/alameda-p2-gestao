<label style="display: {{$display}}" for="{{$patternName}}-input" id="label-{{$patternName}}">{{$labelText}}</label>
<select style="display: {{$display}}" name="{{$patternName}}" id="{{$patternName}}-input">
    @foreach ($collection as $c)
        <option value="{{$c['value']}}"
            @isset($selectedValue)
                @if ($selectedValue === $c['value'])
                    selected
                @endif
            @endisset
            >
            {{$c['view']}}
        </option>
    @endforeach
</select>
<span id="span-errors-{{$patternName}}-input" class="errors-highlighted">
    {{ $errors->has($patternName) ? $errors->first($patternName) : ''}}
</span>