<article @php(post_class())>
  <header>
    <h2 class="entry-title">
      <a href="{{ get_permalink() }}">
        {!! $title !!}
      </a>
    </h2>

    @include('partials.entry-meta')
  </header>

  @if ($duracion || $precio !== '')
    <p class="course-meta">
      @if ($duracion)
        {{ $duracion }}
      @endif

      @if ($duracion && $precio !== '')
        &middot;
      @endif

      @if ($precio !== '')
        {{ $precio }}
      @endif
    </p>
  @endif

  <div class="entry-summary">
    @php(the_excerpt())
  </div>
</article>
