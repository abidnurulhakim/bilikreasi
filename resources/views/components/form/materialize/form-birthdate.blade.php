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
    <i class="fa fa-calendar prefix"></i>
    {{ Form::text($name, $value, array_merge(['data-date-format' => 'yyyy-mm-dd', 'data-end-date' => 'today', 'class' => 'form-control date-picker'], $attributes)) }}
    {!! Form::label($name, $labelName) !!}
  </div>
</div>