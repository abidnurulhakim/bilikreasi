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
  {{ Form::email($name, $value, $attributes) }}
  {{ Form::label($name, $labelName) }}
</div>