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
    {{ Form::number($name, $value, array_merge(['id' => $name], $attributes)) }}
    {{ Form::label($name, $labelName) }}
  </div>
</div>