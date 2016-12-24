<div class="input-field col s12">
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
  ?>
  {{ Form::label($name, $labelName) }}
  {{ Form::textArea($name, $value, array_merge(['class' => 'form-control', 'rows' => 5], $attributes)) }}
</div>