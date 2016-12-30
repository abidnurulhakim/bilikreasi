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
  @if (empty($attributes['multiple']))
  {{ Form::file($name, array_merge(['class' => 'form-control'], $attributes)) }}
  @else
  {{ Form::file($name.'[]', array_merge(['class' => 'form-control', 'multiple' => 'true'], $attributes)) }}
  @endif
</div>