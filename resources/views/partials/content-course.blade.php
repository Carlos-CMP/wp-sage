<article @php(post_class('course-entry'))>
  <div class="course-entry__main">
    <h2 class="course-entry__title">
      <a href="{{ get_permalink() }}">{!! $title !!}</a>
    </h2>

    @if ($subjectName || $levelName)
      <p class="course-entry__tags">
        @if ($subjectName)
          <span class="tag tag--subject">{{ $subjectName }}</span>
        @endif

        @if ($levelName)
          <span class="tag tag--level tag--level-{{ $levelSlug }}">{{ $levelName }}</span>
        @endif
      </p>
    @endif

    <div class="course-entry__excerpt">
      @php(the_excerpt())
    </div>
  </div>

  @if ($duracion || $precio !== '')
    <div class="course-entry__facts">
      @if ($duracion)
        <span class="course-entry__fact">
          <span class="course-entry__fact-label">{{ __('Duración', 'novicell-sage-test') }}</span>
          {{ $duracion }}
        </span>
      @endif

      @if ($precio !== '')
        <span class="course-entry__fact">
          <span class="course-entry__fact-label">{{ __('Precio', 'novicell-sage-test') }}</span>
          {{ $precio }}
        </span>
      @endif
    </div>
  @endif
</article>
