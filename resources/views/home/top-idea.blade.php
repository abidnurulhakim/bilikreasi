<section id="popular-idea" class="popular-idea">
  @forelse($populars as $popular)
    <div id="popular_idea_{{ $popular->id }}" class="pushpin-block">
      <div class="pushpin" data-target="popular_idea_{{ $popular->id }}">
        <div class="pushpin-title">{{ $popular->title }}</div>
      </div>
      <div class="pushpin-content">
        @foreach ($popular->ideas->chunk(3) as $chunk)
        <div class="row idea-list">
          @foreach($chunk as $idea)
            <div class="col-xs-10 col-md-4">
              @include('idea.card', $idea)
            </div>
          @endforeach
          @for ($i = 0; $i < (3 - sizeof($chunk)); $i++)
            <div class="col-xs-12 col-md-4 hidden-sm-down">
            </div>
          @endfor
        </div>
        @endforeach
      </div>
    </div>
  @empty
  <div id="popular_idea_1" class="pushpin-block">
    <div class="pushpin" data-target="popular_idea_1">
    <h4 class="btn primary btn-block btn-flat">Ide Terbaru</h4>
    </div>
    <div class="pushpin-content">
      @foreach(App\Models\Idea::order('created_at', 'desc')->take(6)->get()->chunk(3) as $ideas)
      <div class="row idea-list">
        @foreach($ideas as $idea)
          <div class="col-xs-12 col-md-4">
            @include('idea.card', $idea)
          </div>
        @endforeach
      </div>
      @endforeach
    </div>
  </div>
  @endforelse
</section>