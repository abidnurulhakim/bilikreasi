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
  {{ Form::selectPicker($name, $value, array_merge(['class' => 'selectpicker form-control', 'title' => 'Belum ada kategory yang dipilih'], $attributes)) }}
</div>
