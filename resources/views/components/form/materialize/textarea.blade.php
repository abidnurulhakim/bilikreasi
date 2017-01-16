<textarea class="materialize-textarea" name="{{ $name }}" id="{{ $name }}"
@foreach ($attributes as $key => $val)
  {{ $key }}="{{ $val }}"
@endforeach
>{{ $value }}</textarea>