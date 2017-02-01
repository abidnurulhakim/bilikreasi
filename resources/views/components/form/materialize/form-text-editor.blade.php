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
    <div class="row col-xs">
      {{ $labelName }}
    </div>
    {{ Form::materializeTextEditor($name, $value, array_merge(['rows' => 5], $attributes)) }}
  </div>
</div>