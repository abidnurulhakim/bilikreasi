<div class="form-group">
  <?php
    $collection = "";
    if (!$attributes) {
      $attributes = [];
    } 
    if (!empty($attributes['label'])){
      $labelName = ucfirst($attributes['label']);
      unset($attributes['label']);
    } else {
      $labelName = ucfirst($name);
    }
    if (!is_null($attributes['collection'])) {
      $collection .= '["';
      $collection .= join('","', $attributes['collection']);
      $collection .= '"]';
      unset($attributes['collection']);
    }
  ?>
  {{ Form::label($name, $labelName) }}
  <small>*Gunakan <b>tanda koma (,)</b> sebagai pemisah</small>
  <br>
  {{ Form::text($name, $value, array_merge(['class' => 'form-control', 'data-role' => 'tagsinput', 'data-value-typeahead' => $collection], $attributes)) }}
</div>