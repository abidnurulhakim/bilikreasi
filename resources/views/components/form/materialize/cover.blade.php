<div class="image-input">
  <div class="idea-cover--container">
    <div class="idea-cover">
      <img src="{{ $value }}" class="idea-cover--src" title="Your Idea Cover">
      {{ Form::file($name, array_merge(['class' => 'idea-cover-input--file'], $attributes)) }}
    </div>
    <h6>Pilih Cover</h6>
  </div>
</div>