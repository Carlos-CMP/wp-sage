<article @php(post_class('course-detail h-entry'))>
  <header class="course-detail__header">
    <h1 class="course-detail__title p-name">{!! $title !!}</h1>

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

    @include('partials.entry-meta')
  </header>

  @if ($duracion || $precio !== '')
    <dl class="course-detail__facts">
      @if ($duracion)
        <div>
          <dt>{{ __('Duración', 'novicell-sage-test') }}</dt>
          <dd>{{ $duracion }}</dd>
        </div>
      @endif

      {{-- get_field('precio') ya pasa por el filtro acf/format_value/name=precio (App\Fields\CourseFields::format_precio), --}}
      {{-- así que aquí llega formateado como "50 €" o "0 €", no como número crudo. --}}
      @if ($precio !== '')
        <div>
          <dt>{{ __('Precio', 'novicell-sage-test') }}</dt>
          <dd>{{ $precio }}</dd>
        </div>
      @endif
    </dl>
  @endif

  <p class="course-detail__cta">
    <a href="#inscripcion" class="button button--primary">
      {{ __('Inscribirme', 'novicell-sage-test') }}
    </a>
  </p>

  <div class="course-detail__content e-content">
    @php(the_content())
  </div>

  @if ($pagination())
    <footer>
      <nav class="page-nav" aria-label="Page">
        {!! $pagination !!}
      </nav>
    </footer>
  @endif

  @php(comments_template())
</article>
