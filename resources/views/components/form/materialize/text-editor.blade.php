<textarea name="{{ $name }}" text-editor
@foreach ($attributes as $key => $val)
  {{ $key }}="{{ $val }}"
@endforeach
>{{ $value }}</textarea>