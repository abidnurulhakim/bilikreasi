<div class="materialize-input">
  <div class="input-field">
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
    {{ Form::materializeTextarea($name, $value, array_merge(['rows' => 5], $attributes)) }}
    {{ Form::label($name, $labelName) }}
  </div>
</div>