<textarea name="{{ $name }}" summernote
@foreach ($attributes as $key => $val)
  {{ $key }}="{{ $val }}"
@endforeach
>{{ $value }}</textarea>