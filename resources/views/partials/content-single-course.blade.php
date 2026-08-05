<article @php(post_class('h-entry'))>
  <header>
    <h1 class="p-name">
      {!! $title !!}
    </h1>

    @include('partials.entry-meta')
  </header>

  @if ($duracion || $precio !== '')
    <ul class="course-meta">
      @if ($duracion)
        <li>Duración: {{ $duracion }}</li>
      @endif

      {{-- get_field('precio') ya pasa por el filtro acf/format_value/name=precio (App\Fields\CourseFields::format_precio), --}}
      {{-- así que aquí llega formateado como "50 €" o "0 €", no como número crudo. --}}
      @if ($precio !== '')
        <li>Precio: {{ $precio }}</li>
      @endif
    </ul>
  @endif

  <div class="e-content">
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
