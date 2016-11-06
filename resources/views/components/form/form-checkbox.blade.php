<div class="form-group">
  <?php
    if (!$attributes) {
      $attributes = [];
    }
    if (empty($attributes['checked'])) {
      $attributes['checked'] = [];
    }
    if (!empty($attributes['label'])){
      $labelName = ucfirst($attributes['label']);
      unset($attributes['label']);
    } else {
      $labelName = ucfirst($name);
    }
    
  ?>
  {{ Form::label($name, $labelName) }}
  <div class="checkbox">
    @if(is_array($value))
      @if(array_keys($value) !== range(0, count($value) - 1))
        @foreach ($value as $key => $val)
          <label>
            <input type="checkbox" name='{{ $name }}[]' value='{{ $key }}' @if(in_array($key, $attributes['checked'])) checked @endif> {{ $val }}
          </label>
        @endforeach    
      @else
        @foreach ($value as $val)
          <label>
            <input type="checkbox" name='{{ $name }}[]' value='{{ $val }}' @if(in_array($key, $attributes['checked'])) checked @endif> {{ $val }}
          </label>
        @endforeach
      @endif
    @else
      <label>
        <input type="checkbox" name='{{ $name }}' value='{{ $value }}' @if(in_array($key, $attributes['checked'])) checked @endif> {{ $value }}
      </label>
    @endif
</div>
