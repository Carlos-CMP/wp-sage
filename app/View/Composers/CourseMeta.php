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
}
