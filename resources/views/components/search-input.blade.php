<label for="search">{{ $labelText }}</label>
<input type="text" id="search" placeholder=" {{ $placeholder }} ">
<ul id="sugestoes"></ul>
<data id="dominio{{ isset($dIdentificador) ? '-'.$dIdentificador : '' }}" style="display:none" data-dominio="{{$dominio}}"></data>