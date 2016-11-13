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
  ?>
<div class="form-group">
  {{ Form::label($nameStart, $labelNameStart) }}
  <div class='input-group date-time-picker-link' id="{{ $nameStart }}" data-start="true" data-finish-selector="{{ $nameFinish }}">
    <input type='text' name={{ $nameStart }} value="
    @if(!empty($valueStart))
      {{ \Carbon::createFromFormat('Y-m-d H:i:s', $valueStart)->format('m/d/Y g:i A') }}
    @endif
    " class="form-control">
    <span class="input-group-addon">
      <span class="fa fa-calendar"></span>
    </span>
  </div>
</div>
<div class="form-group">
  {{ Form::label($nameFinish, $labelNameFinish) }}
  <div class='input-group' id="{{ $nameFinish }}" data-finish="true" data-start-selector="{{ $nameStart }}">
    <input type='text' name={{ $nameFinish }} value="
    @if(!empty($valueFinish))
      {{ \Carbon::createFromFormat('Y-m-d H:i:s', $valueFinish)->format('m/d/Y g:i A') }}
    @endif
    " class="form-control">
    <span class="input-group-addon">
      <span class="fa fa-calendar"></span>
    </span>
  </div>
</div>