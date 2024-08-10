<div class="col-6">
    <label for="{{$attrName}}"> 
          {{$labelText}}
    </label>
    <input type="file" name="{{$attrName}}">
</div>
@isset($file)
    <div class="col-6">
          <button class="button light-button">
                <a id="link-arquivo-baixar" href="{{$downloadRoute}}">BAIXAR {{ $file }}</a>
                <img style="margin-left: 1vw" src="{{asset('icons/download-icon.svg')}}" alt="download-icon">
          </button>
    </div>
@endisset