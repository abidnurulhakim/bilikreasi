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
@if(is_array($value))
  @if(array_keys($value) !== range(0, count($value) - 1))
    @foreach ($value as $key => $val)
      <input type="checkbox" name='{{ $name }}[]' id="{{ $name.'_'.$key }}" class="filled-in" value='{{ $key }}' @if(in_array($key, $attributes['checked'])) checked @endif>
      {{ Form::label($name.'_'.$key, $val) }}
    @endforeach    
  @else
    @foreach ($value as $val)
      <input type="checkbox" name='{{ $name }}[]' id="{{ $name.'_'.$val }}" class="filled-in" value='{{ $val }}' @if(in_array($key, $attributes['checked'])) checked @endif>
      {{ Form::label($name.'_'.$val, $val) }}
    @endforeach
  @endif
@else
  <input type="checkbox" id="{{ $name }}" class="filled-in" name='{{ $name }}' value='{{ $value }}' @if(in_array($value, $attributes['checked'])) checked @endif>
  {{ Form::label($name, $labelName) }}
@endif
