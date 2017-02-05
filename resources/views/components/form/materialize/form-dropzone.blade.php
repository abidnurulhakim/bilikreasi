<?php
  if (!$attributes) {
    $attributes = [];
  } 
  if (!empty($attributes['label'])){
    $labelName = ucfirst($attributes['label']);
    unset($attributes['label']);
  } else {
    $labelName = ucfirst($name);
  }
  $attributes['data-url'] = $url;
?>
<div class="form-group">
  {{ Form::label($name, $labelName) }}
  <div data-toggle="dropzone-input" data-param-name="{{ $name }}" action="{{ $url }}" class="dropzone idea-media--input"
  @foreach ($attributes as $key => $val)
    {{ $key }}="{{ $val }}"
  @endforeach
  >
  </div>
</div>
