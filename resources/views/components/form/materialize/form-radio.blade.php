<?php
  if (!$attributes) {
    $attributes = [];
  }
  if (empty($attributes['checked'])) {
    $attributes['checked'] = [];
  }
  if (!empty($attributes['label'])){
    $labelName = ucfirst($attributes['label']);
    unset($attributes['label']);
  } else {
    $labelName = ucfirst($name);
  }
  
?>
<div class="materialize-input">
  @if(is_array($value))
    @if(array_keys($value) !== range(0, count($value) - 1))
      @foreach ($value as $key => $val)
        <input type="radio" class="with-gap" name="{{ $name }}[]" id="{{ $name.'_'.$key }}" value="{{ $key }}" @if(in_array($key, $attributes['checked'])) checked @endif>
        <label for="{{ $name.'_'.$key }}">{{ $val }}</label>
      @endforeach    
    @else
      @foreach ($value as $val)
        <input type="radio" class="with-gap" name="{{ $name }}[]" id="{{ $name.'_'.$val }}" value="{{ $val }}" @if(in_array($val, $attributes['checked'])) checked @endif>
        <label for="{{ $name.'_'.$val }}">{{ $val }}</label>
      @endforeach
    @endif
  @else
    <input type="radio" class="with-gap" name="{{ $name }}" id="{{ $name }}" value="{{ $value }}" @if($attributes['checked']) checked @endif>
    <label for="{{ $name }}">{{ $labelName }}</label>
  @endif
</div>
