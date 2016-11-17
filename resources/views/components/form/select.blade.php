<select 
@foreach ($attributes as $key => $val)
  @if($key != 'selected')
    {{ $key }}="{{ $val }}"
  @endif
@endforeach
data-live-search="true" name="{{ $name }}">
  @if(array_keys($value) !== range(0, count($value) - 1))
    @foreach ($value as $key => $val)
      <option data-tokens="{{ preg_replace('/\W/i', ' ', strtolower($val)) }}" value="{{ $key }}"
        @if(!empty($attributes['selected']) && !is_array($attributes['selected']) && $attributes['selected'] == $key)
          selected
        @elseif(!empty($attributes['selected']) && is_array($attributes['selected']) && in_array($key, $attributes['selected']))
          selected
        @endif
        >{{ $val }}</option>
    @endforeach
  @else
    @foreach ($value as $val)
      <option data-tokens="{{ preg_replace('/\W/i', ' ', strtolower($val)) }}" value="{{ $val }}"
      @if(!empty($attributes['selected']) && !is_array($attributes['selected']) && $attributes['selected'] == $val)
        selected
      @elseif (!empty($attributes['selected']) && is_array($attributes['selected']) && in_array($val, $attributes['selected']))
        selected
      @endif
        >{{ $val }}</option>
    @endforeach
  @endif
</select>