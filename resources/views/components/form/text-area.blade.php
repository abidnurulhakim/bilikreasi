<textarea name="{{ $name }}"
@foreach ($attributes as $key => $val)
  {{ $key }}="{{ $val }}"
@endforeach
>{{ $value }}</textarea>