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
  <small>*Gunakan <b>tanda koma (,)</b> sebagai pemisah</small>
  <br>
  {{ Form::select($name.'[]', $collection, $value, array_merge(['class' => 'form-control', 'style' => 'width: 100%', 'data-tag' => 'true', 'multiple' => 'true'], $attributes)) }}
</div>