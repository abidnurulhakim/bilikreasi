<div class="materialize-input">
  <div class="input-field datetime-picker">
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
    {{ Form::text($name, $value, $attributes)) }}
    <span class="input-group-btn">
      <span class="fa fa-calendar"></span>
    </span>
  </div>
</div>