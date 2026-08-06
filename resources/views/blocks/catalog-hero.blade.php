<section class="pb-10 mb-10 border-b border-border">
  @if ($eyebrow)
    <p class="m-0 mb-3 text-xs font-semibold uppercase tracking-[0.12em] text-accent">
      {{ $eyebrow }}
    </p>
  @endif

  @if ($headline)
    <h1 class="m-0 mb-6 max-w-3xl font-display text-[clamp(2rem,5vw,3.25rem)] font-semibold leading-[1.1] text-ink">
      {{ $headline }}
    </h1>
  @endif

  @if (count($subjects))
    {{--
      Índice real de materias con cursos (no decorativo): cada nombre sale
      directamente de course_subject vía get_terms(), no es copy inventado.
    --}}
    <p class="m-0 text-sm text-ink-muted">
      @foreach ($subjects as $index => $subject)
        <span>{{ $subject->name }}</span>@if (! $loop->last)
          <span class="mx-2 text-border">&mdash;</span>
        @endif
      @endforeach
    </p>
  @endif
</section>
