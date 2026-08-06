<section>
  <h2 class="course-highlight__title">{{ $heading }}</h2>

  @if (count($courses))
    <div class="course-highlight__list">
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
  @else
    <p class="course-highlight__empty">{{ __('Todavía no hay cursos publicados.', 'novicell-sage-test') }}</p>
  @endif
</section>
