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
  {{ Form::text($name, $value, array_merge(['type' => 'search'], $attributes)) }}
  {{ Form::label($name, $labelName) }}
</div>