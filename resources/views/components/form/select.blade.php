<select 
@foreach ($attributes as $key => $val)
  {{ $key }}="{{ $val }}"
@endforeach
data-live-search="true" name="{{ $name }}">
  @if (array_keys($value) !== range(0, count($value) - 1))
    @foreach ($value as $key => $val)
      <option data-tokens="{{ preg_replace('/\W/i', ' ', strtolower($val)) }}" value="{{ $key }}" 
        @if(!empty($attributes['selected']) && $attributes['selected'] == $key)
          selected
        @endif
        >{{ $val }}</option>
    @endforeach
  @else
    @foreach ($value as $val)
      <option data-tokens="{{ preg_replace('/\W/i', ' ', strtolower($val)) }}" value="{{ $val }}"
      @if(!empty($attributes['selected']) && $attributes['selected'] == $val)
        selected
      @endif
        >{{ $val }}</option>
    @endforeach
  @endif
</select>