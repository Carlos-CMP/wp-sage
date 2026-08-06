<section>
  <h2 class="m-0 mb-2 text-[clamp(1.35rem,3vw,1.75rem)] font-bold text-ink">{{ $heading }}</h2>

  @if (count($courses))
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
      {{--
        Secondary loop: hay que asignar $post directamente (no basta con
        setup_postdata, que solo prepara datos secundarios como el autor y
        la paginación) para que partials.content-course, pensada para vivir
        dentro de The Loop, pueda usar get_the_ID()/get_field()/the_excerpt()
        como si estuviera en el archive normal. wp_reset_postdata() al
        salir del bucle devuelve $post a la query principal de la página.
      --}}
      @php
        global $post;
      @endphp
      @foreach ($courses as $post)
        @php(setup_postdata($post))
        @include('partials.content-course')
      @endforeach
      @php(wp_reset_postdata())
    </div>

    @if ($archiveUrl)
      <p class="mt-8">
        <a href="{{ $archiveUrl }}" class="inline-flex items-center text-sm font-semibold text-accent no-underline hover:underline [text-underline-offset:0.15em] focus-visible:outline focus-visible:outline-2 focus-visible:outline-accent focus-visible:outline-offset-[3px] focus-visible:rounded-[2px]">
          {{ __('Ver todos los cursos', 'novicell-sage-test') }} &rarr;
        </a>
      </p>
    @endif
  @else
    <p class="text-ink-muted">{{ __('Todavía no hay cursos publicados.', 'novicell-sage-test') }}</p>
  @endif
</section>
