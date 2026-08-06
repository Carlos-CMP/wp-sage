<article @php(post_class('flex h-full flex-col gap-4 rounded-xl border border-border bg-paper p-6 transition-shadow hover:shadow-md'))>
  <div>
    <h2 class="m-0 mb-2 text-xl font-semibold leading-[1.3]">
      <a href="{{ get_permalink() }}" class="text-ink no-underline hover:underline focus-visible:underline [text-underline-offset:0.15em] focus-visible:outline focus-visible:outline-2 focus-visible:outline-accent focus-visible:outline-offset-[3px] focus-visible:rounded-[2px]">{!! $title !!}</a>
    </h2>

    @if ($subjectName || $levelName)
      <p class="flex flex-wrap gap-[0.4rem]">
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
  </div>

  {{--
    Sin flex-1 fijo: si no hay excerpt (10 de los 13 cursos tienen
    post_content vacío a propósito) este bloque simplemente no existe, en
    vez de reservar un hueco vacío. El pie de precio/duración se ancla
    abajo con mt-auto sobre el propio article en flex-col, así que las
    cards siguen alineando su pie entre sí dentro de la misma fila del
    grid tengan o no extracto.
  --}}
  @if (get_the_excerpt())
    <div class="text-ink-muted text-[0.95rem] leading-[1.6] [&>p]:m-0">
      @php(the_excerpt())
    </div>
  @endif

  @if ($duracion || $precio !== '')
    {{--
      El precio es el dato que decide la compra, la duración es de apoyo:
      se diferencian por tamaño/peso (jerarquía tipográfica), no con
      etiquetas "DURACIÓN"/"PRECIO" encima de cada valor — "45 horas" y
      "130 €" ya se leen solos por su unidad, la etiqueta era redundante.
    --}}
    <div class="mt-auto flex items-baseline justify-between gap-4 border-t border-border pt-4">
      @if ($duracion)
        <span class="text-sm text-ink-muted">{{ $duracion }}</span>
      @endif

      @if ($precio !== '')
        <span class="ml-auto text-xl font-bold text-ink tabular-nums">{{ $precio }}</span>
      @endif
    </div>
  @endif
</article>
