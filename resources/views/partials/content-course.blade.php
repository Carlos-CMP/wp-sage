<article @php(post_class('flex flex-col sm:flex-row flex-wrap gap-6 justify-between py-7 border-b border-border'))>
  <div class="flex-1 basis-[28rem] min-w-0">
    <h2 class="m-0 mb-2 text-xl font-semibold leading-[1.3]">
      <a href="{{ get_permalink() }}" class="text-ink no-underline hover:underline focus-visible:underline [text-underline-offset:0.15em] focus-visible:outline focus-visible:outline-2 focus-visible:outline-accent focus-visible:outline-offset-[3px] focus-visible:rounded-[2px]">{!! $title !!}</a>
    </h2>

    @if ($subjectName || $levelName)
      <p class="flex flex-wrap gap-[0.4rem] mb-[0.6rem]">
        @if ($subjectName)
          <span class="inline-flex items-center px-[0.6rem] py-[0.15rem] rounded-full border border-border text-xs font-medium leading-[1.5] text-ink-muted bg-surface">{{ $subjectName }}</span>
        @endif

        @if ($levelName)
          {{--
            La intensidad del acento (contorno/relleno claro/relleno sólido)
            depende del nivel. Se calcula como una única cadena de clases,
            no combinando utilidades de color que se pisarían entre sí
            (Tailwind no garantiza qué utilidad "gana" si dos clases de
            color en conflicto conviven en el mismo elemento).
          --}}
          @php($levelColors = match ($levelSlug) {
            'avanzado' => 'bg-accent text-paper',
            'intermedio' => 'bg-accent/10 text-accent',
            default => 'bg-paper text-accent',
          })
          <span class="inline-flex items-center px-[0.6rem] py-[0.15rem] rounded-full border border-accent text-xs font-medium leading-[1.5] {{ $levelColors }}">{{ $levelName }}</span>
        @endif
      </p>
    @endif

    <div class="text-ink-muted text-[0.95rem] leading-[1.6] [&>p]:m-0">
      @php(the_excerpt())
    </div>
  </div>

  @if ($duracion || $precio !== '')
    <div class="flex flex-row sm:flex-col gap-6 sm:gap-2 flex-none text-left sm:text-right">
      @if ($duracion)
        <span class="block text-[0.95rem] text-ink tabular-nums">
          <span class="block text-[0.7rem] font-semibold uppercase tracking-[0.04em] text-ink-muted">{{ __('Duración', 'novicell-sage-test') }}</span>
          {{ $duracion }}
        </span>
      @endif

      @if ($precio !== '')
        <span class="block text-[0.95rem] text-ink tabular-nums">
          <span class="block text-[0.7rem] font-semibold uppercase tracking-[0.04em] text-ink-muted">{{ __('Precio', 'novicell-sage-test') }}</span>
          {{ $precio }}
        </span>
      @endif
    </div>
  @endif
</article>
