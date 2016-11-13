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
  <div class='input-group date-time-picker'>
    <input type='text' name={{ $name }} class="form-control">
    <span class="input-group-addon">
      <span class="fa fa-calendar"></span>
    </span>
  </div>
</div>