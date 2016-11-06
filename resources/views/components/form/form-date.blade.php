<div class="form-group">
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
  {{ Form::text($name, $value, array_merge(['data-date-format' => 'yyyy-mm-dd', 'class' => 'form-control date-picker'], $attributes)) }}
</div>