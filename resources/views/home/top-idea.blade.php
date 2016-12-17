
<section id="popular-idea" class="popular-idea">
  @forelse($populars as $popular)
    <div id="popular_idea_{{ $popular->id }}" class="pushpin-block">
      <div class="pushpin" data-target="popular_idea_{{ $popular->id }}">
        <h4 class="btn primary btn-block btn-flat">{{ $popular->title }}</h4>
      </div>
      <div class="pushpin-content">
        @foreach ($popular->ideas->chunk(3) as $chunk)
        <div class="row idea-list">
          @foreach($ideas as $idea)
            <div class="col s12 m4">
              @php
                $idea = $popularIdea->idea
              @endphp
              @include('idea.card', $idea)
            </div>
          @endforeach
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
      @foreach(App\Models\Idea::take(6)->get()->chunk(3) as $ideas)
      <div class="row idea-list">
        @foreach($ideas as $idea)
          <div class="col s12 m4">
            @include('idea.card', $idea)
          </div>
        @endforeach
      </div>
      @endforeach
    </div>
  </div>
  <div id="popular_idea_2" class="pushpin-block">
    <div class="pushpin" data-target="popular_idea_2">
    <h4 class="btn primary btn-block btn-flat">Ide Keren</h4>
    </div>
    <div class="pushpin-content">
      @foreach(App\Models\Idea::take(6)->offset(6)->get()->chunk(3) as $ideas)
      <div class="row idea-list">
        @foreach($ideas as $idea)
          <div class="col s12 m4">
            @include('idea.card', $idea)
          </div>
        @endforeach
      </div>
      @endforeach
    </div>
  </div>
  @endforelse
</section>
