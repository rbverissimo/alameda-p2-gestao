<div class="dashboard light-dashboard">
    <div class="divisor-header secondary-divisor">
        {{ $headerText }}
    </div>
    <div class="row">
        <div class="col-4">
            <button id="adicionar-button-{{$patternName}}" class="button special-action-button">{{ $buttonText }}</button>
        </div>
    </div>
    <div id="dynamic-wrapper-{{$patternName}}" mode="{{$mode}}" columns-division="{{implode(',', $columns_division)}}">
        @isset($collection)
            @foreach ($collection as $multiSelectVO)
                @php
                    $random = mt_rand(1, 99999);
                    $verificador_aleatorio = '-'.$random;
                @endphp
                <div class="row">
                    @if ($mode === 'INPUT-SELECT' || $mode === 'INPUT')
                        <div class="col-{{$columns_division[0]}}">
                            <x-forms.input
                                :pattern-name="$patternName"
                                :attr-name="$inputAttrName.$verificador_aleatorio"
                                :label-text="$inputLabelText"
                                :data-input="$multiSelectVO->dataInput"
                            >
                            </x-forms.input>
                        </div>
                    @endif
                    @if ($mode === 'INPUT-SELECT' || $mode === 'SELECTION')    
                        <div class="col-{{$columns_division[1]}}">
                            <x-forms.select
                                :collection="$multiSelectVO->select['options']" 
                                :label-text="$labelText"
                                :pattern-name="$patternName"
                                :verificador="$verificador_aleatorio"
                                :selected-value="$multiSelectVO->select['selectedValue']"></x-forms.select>
                        </div>
                    @endif
                    <div class="col-{{$columns_division[2]}}">
                        <button id="deletar-button{{$verificador}}" class="button deletar-button">{{$deletarText}}</button>
                    </div>
                </div>
            @endforeach
        @endisset
    </div>
</div>