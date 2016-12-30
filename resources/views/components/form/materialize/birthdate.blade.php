<?php 
if (!$attributes) {
  $attributes = [];
}
?>
{{ Form::text($name, $value, array_merge(['data-date-format' => 'yyyy-mm-dd', 'data-end-date' => 'today', 'class' => 'form-control date-picker'], $attributes)) }}