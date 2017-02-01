<div class="image-input">
  <div class="user-picture--container">
    <div class="user-picture">
      <img src="{{ $value }}" class="user-picture--src" title="Your avatar">
      {{ Form::file($name, array_merge(['class' => 'user-picture-input--file'], $attributes)) }}
    </div>
    <h6>Pilih Foto</h6>
  </div>
</div>