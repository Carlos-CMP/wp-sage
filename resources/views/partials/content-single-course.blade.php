<article @php(post_class('h-entry'))>
  <header class="mb-6">
    <h1 class="p-name m-0 mb-[0.6rem] text-[clamp(1.5rem,4vw,2.25rem)] font-bold leading-[1.2] text-ink">{!! $title !!}</h1>

    @if ($subjectName || $levelName)
      <p class="flex flex-wrap gap-[0.4rem] mb-[0.6rem]">
        @if ($subjectName)
          <span class="inline-flex items-center px-[0.6rem] py-[0.15rem] rounded-full border border-border text-xs font-medium leading-[1.5] text-ink-muted bg-surface">{{ $subjectName }}</span>
        @endif

        @if ($levelName)
          @php($levelColors = match ($levelSlug) {
            'avanzado' => 'bg-accent text-paper',
            'intermedio' => 'bg-accent/10 text-accent',
            default => 'bg-paper text-accent',
          })
          <span class="inline-flex items-center px-[0.6rem] py-[0.15rem] rounded-full border border-accent text-xs font-medium leading-[1.5] {{ $levelColors }}">{{ $levelName }}</span>
        @endif
      </p>
    @endif

    @include('partials.entry-meta')
  </header>

  @if ($duracion || $precio !== '')
    <dl class="flex flex-wrap gap-y-6 gap-x-10 mb-6 py-4 px-5 bg-surface border border-border rounded-xl">
      @if ($duracion)
        <div class="flex flex-col gap-[0.15rem]">
          <dt class="text-[0.7rem] font-semibold uppercase tracking-[0.04em] text-ink-muted">{{ __('Duración', 'novicell-sage-test') }}</dt>
          <dd class="m-0 text-[1.05rem] font-semibold text-ink tabular-nums">{{ $duracion }}</dd>
        </div>
      @endif

      {{-- get_field('precio') ya pasa por el filtro acf/format_value/name=precio (App\Fields\CourseFields::format_precio), --}}
      {{-- así que aquí llega formateado como "50 €" o "0 €", no como número crudo. --}}
      @if ($precio !== '')
        <div class="flex flex-col gap-[0.15rem]">
          <dt class="text-[0.7rem] font-semibold uppercase tracking-[0.04em] text-ink-muted">{{ __('Precio', 'novicell-sage-test') }}</dt>
          <dd class="m-0 text-[1.05rem] font-semibold text-ink tabular-nums">{{ $precio }}</dd>
        </div>
      @endif
    </dl>
  @endif

  <p class="mb-8">
    <a href="#inscripcion" class="inline-flex items-center py-[0.7rem] px-[1.6rem] rounded-lg text-[0.95rem] font-semibold no-underline border border-transparent bg-accent text-paper shadow-[0_1px_2px_rgba(0,0,0,0.06),0_4px_10px_rgba(157,23,77,0.25)] hover:bg-[color-mix(in_srgb,var(--color-accent)_88%,black)] focus-visible:outline focus-visible:outline-2 focus-visible:outline-ink focus-visible:outline-offset-2">
      {{ __('Inscribirme', 'novicell-sage-test') }}
    </a>
  </p>

  <div class="e-content max-w-[70ch] text-[1.05rem] leading-[1.7] text-ink">
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
