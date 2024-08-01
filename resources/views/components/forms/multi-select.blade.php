<div class="dashboard light-dashboard">
    <div class="divisor-header secondary-divisor">
        {{ $headerText }}
    </div>
    <div class="row">
        <div class="col-4">
            <button id="adicionar-tipo-button" class="button special-action-button">{{ $buttonText }}</button>
        </div>
    </div>
    <div id="dynamic-wrapper-{{$patternName}}">
        @isset($collection)
            @foreach ($collection as $c)
                @php
                    $random = mt_rand(1, 99999);
                    $verificador_aleatorio = '-'.$random;
                @endphp
                <div class="row">
                    <div class="col-8">
                        <x-forms.select
                            :collection="$c->options" 
                            :label-text="$labelText"
                            :pattern-name="$patternName"
                            :verificador="$verificador_aleatorio"
                            :selected-value="$c->selectedValue"></x-forms.select>
                    </div>
                    <div class="col-4">
                        <button id="deletar-button{{$verificador}}" class="button deletar-button">{{$deletarText}}</button>
                    </div>
                </div>
            @endforeach
        @endisset
    </div>
</div>