<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

/**
 * Inyecta duracion/precio (campos ACF de "course") en las vistas que los
 * necesitan, para que las plantillas Blade no llamen a get_field() directamente.
 */
class CourseMeta extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'partials.content-single-course',
        'partials.content-course',
    ];

    /**
     * Data to be passed to view before rendering.
     *
     * @return array
     */
    public function with(): array
    {
        return [
            'duracion' => $this->duracion(),
            'precio' => $this->precio(),
            'levelSlug' => $this->levelSlug(),
            'levelName' => $this->levelTerm()?->name,
            'subjectName' => $this->subjectTerm()?->name,
        ];
    }

    /**
     * Returns the "duracion" ACF field of the current course.
     */
    public function duracion()
    {
        return get_field('duracion');
    }

    /**
     * Returns the "precio" ACF field of the current course, ya formateado
     * con "€" por el filtro acf/format_value/name=precio (App\Fields\CourseFields).
     */
    public function precio()
    {
        return get_field('precio');
    }

    /**
     * Término (plano) de "course_level" del curso actual, o null si no
     * tiene ninguno asignado.
     */
    public function levelTerm(): ?\WP_Term
    {
        $terms = get_the_terms(get_the_ID(), 'course_level');

        return is_array($terms) ? $terms[0] : null;
    }

    /**
     * Slug del nivel, usado como clase CSS para elegir la intensidad del
     * acento con la que se pinta la etiqueta de nivel (más intensa cuanto
     * más avanzado).
     */
    public function levelSlug(): string
    {
        return $this->levelTerm()->slug ?? 'sin-nivel';
    }

    /**
     * Término más específico de "course_subject" asignado al curso
     * actual, o null si no tiene ninguno.
     */
    public function subjectTerm(): ?\WP_Term
    {
        $terms = get_the_terms(get_the_ID(), 'course_subject');

        return is_array($terms) ? $terms[0] : null;
    }
}
