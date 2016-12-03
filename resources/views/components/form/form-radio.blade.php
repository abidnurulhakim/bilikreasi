<div class="form-group">
  <?php
    if (!$attributes) {
      $attributes = [];
    }
    if (empty($attributes['checked'])) {
      $attributes['checked'] = '';
    }
    if (!empty($attributes['label'])){
      $labelName = ucfirst($attributes['label']);
      unset($attributes['label']);
    } else {
      $labelName = ucfirst($name);
    }
    
  ?>
  {{ Form::label($name, $labelName) }}
  <div class="radio">
    @if(is_array($value))
      @if(array_keys($value) !== range(0, count($value) - 1))
        @foreach ($value as $key => $val)
          <label>
            <input type="radio" name='{{ $name }}' value='{{ $key }}' @if($attributes['checked'] == $key) checked @endif> {{ $val }}
          </label>
        @endforeach    
      @else
        @foreach ($value as $val)
          <label>
            <input type="radio" name='{{ $name }}' value='{{ $val }}'  @if($attributes['checked'] == $val) checked @endif> {{ $val }}
          </label>
        @endforeach
      @endif
    @else
      <label>
        <input type="radio" name='{{ $name }}' value='{{ $value }}'  @if($attributes['checked'] == $value) checked @endif> {{ $value }}
      </label>
    @endif
  </div>
</div>
