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
      <input type="radio" name='{{ $name }}' id="{{ $name.'_'.$key }}" class="with-gap" value='{{ $key }}' @if($attributes['checked'] == $key) checked @endif>
      {{ Form::label($name.'_'.$key, $val) }}
    @endforeach    
  @else
    @foreach ($value as $val)
      <input type="radio" name="{{ $name }}" id="{{ $name.'_'.$val }}" class="with-gap" value='{{ $val }}' @if($attributes['checked'] == $val) checked @endif>
      {{ Form::label($name.'_'.$val, $val) }}
    @endforeach
  @endif
@else
  <input type="radio" id="{{ $name }}" class="with-gap" name='{{ $name }}' value='{{ $value }}' @if($attributes['checked'] == $value)) checked @endif>
  {{ Form::label($name, $labelName) }}
@endif
