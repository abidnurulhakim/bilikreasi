<?php 
if (!$attributes) {
  $attributes = [];
}
?>
<div class='input-group datetime-picker'>
  {{ Form::text($name, $value, array_merger(['class' => 'form-control'], $attributes)) }}
  <input type='text' class="form-control" />
  <span class="input-group-addon">
    <span class="fa fa-calendar"></span>
  </span>
</div>