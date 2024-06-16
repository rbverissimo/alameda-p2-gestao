<div class="chip-group">
    @foreach ($chips as $chip)
        <label for="{{ $chip['id'] }}">
            <input type="checkbox" id="{{ $chip['id'] }}" name="{{ $name }}" value="{{ $chip['value'] }}">
            <span>{{ $chip['text'] }}</span>
        </label>
    @endforeach
</div>