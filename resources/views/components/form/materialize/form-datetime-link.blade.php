<?php
  if (!$attributes) {
    $attributes = [];
  } 
  if (!empty($attributes['label-start'])){
    $labelNameStart = ucfirst($attributes['label-start']);
    unset($attributes['label-start']);
  } else {
    $labelNameStart = ucfirst($nameStart);
  }
  if (!empty($attributes['label-finish'])){
    $labelNameFinish = ucfirst($attributes['label-finish']);
    unset($attributes['label-finish']);
  } else {
    $labelNameFinish = ucfirst($nameFinish);
  }
  if (!empty($valueStart)) {
    $valueStart = \Carbon::createFromFormat('Y-m-d H:i:s', $valueStart)->format('d-m-Y H:i');
  }
  if (!empty($valueFinish)) {
    $valueFinish = \Carbon::createFromFormat('Y-m-d H:i:s', $valueFinish)->format('d-m-Y H:i');
  }
?>
<div class="materialize-input">
  <div class="input-field" >
    <i class="fa fa-clock-o prefix"></i>
    {{ Form::text($nameStart, $valueStart, array_merge([ 'id' => $nameStart, 'data-start' => true, 'data-finish-selector' => $nameFinish, 'class' => 'date-time-picker-link'], $attributes)) }}
    {{ Form::label($nameStart, $labelNameStart) }}
  </div>
</div>
<div class="materialize-input">
  <div class="input-field">
    <i class="fa fa-clock-o prefix"></i>
    {{ Form::text($nameFinish, $valueFinish, array_merge([ 'id' => $nameFinish, 'data-finish' => true, 'data-start-selector' => $nameStart ], $attributes)) }}
    {{ Form::label($nameFinish, $labelNameFinish) }}
  </div>
</div>