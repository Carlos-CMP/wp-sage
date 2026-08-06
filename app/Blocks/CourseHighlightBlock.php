<?php

namespace App\Blocks;

/**
 * Bloque Gutenberg "Destacado de cursos". A diferencia del CPT/Taxonomy/
 * Fields (registrados en PHP puro sin más), un bloque tiene dos mitades
 * que deben coincidir: el 'attributes' de aquí y el 'attributes' del
 * registerBlockType() en course-highlight-block.jsx. Si se desincronizan,
 * WordPress sigue guardando el atributo en post_content pero deja de
 * llegar aquí como se espera.
 */
class CourseHighlightBlock
{
    public static function register(): void
    {
        register_block_type('novicell/course-highlight', [
            'attributes' => [
                'title' => [
                    'type' => 'string',
                    'default' => 'Nuestros cursos',
                ],
                'numberOfCourses' => [
                    'type' => 'number',
                    'default' => 3,
                ],
            ],
            // render_callback: WordPress lo llama tanto para pintar el
            // frontend real como para la vista previa de ServerSideRender
            // en el editor. Es el mismo código en los dos casos.
            'render_callback' => [self::class, 'render'],
        ]);
    }

    public static function render(array $attributes): string
    {
        $courses = get_posts([
            'post_type' => 'course',
            'posts_per_page' => $attributes['numberOfCourses'] ?? 3,
            'orderby' => 'date',
            'order' => 'DESC',
        ]);

        return view('blocks.course-highlight', [
            // 'heading', no 'title': partials.content-course ya usa una
            // variable $title propia (el título de cada curso) inyectada
            // por el View Composer Post; @include hereda todo el scope del
            // padre, así que un $title aquí pisaría al de cada curso.
            'heading' => $attributes['title'] ?? '',
            'courses' => $courses,
            'archiveUrl' => get_post_type_archive_link('course'),
        ])->render();
    }
}
