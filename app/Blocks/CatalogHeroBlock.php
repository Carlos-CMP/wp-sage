<?php

namespace App\Blocks;

class CatalogHeroBlock
{
    public static function register(): void
    {
        register_block_type('novicell/catalog-hero', [
            'attributes' => [
                'eyebrow' => [
                    'type' => 'string',
                    'default' => 'Catálogo de formación',
                ],
                'headline' => [
                    'type' => 'string',
                    'default' => 'Cursos pensados para que aprendas lo que vas a usar.',
                ],
            ],
            'render_callback' => [self::class, 'render'],
        ]);
    }

    public static function render(array $attributes): string
    {
        return view('blocks.catalog-hero', [
            'eyebrow' => $attributes['eyebrow'] ?? '',
            'headline' => $attributes['headline'] ?? '',
            'subjects' => self::subjectsWithCourses(),
        ])->render();
    }

    /**
     * Materias (course_subject) con al menos un curso publicado
     * directamente asignado. hide_empty descarta automáticamente
     * "Marketing" (deliberadamente sin cursos todavía) sin necesidad de
     * excluirlo a mano, así el índice nunca miente sobre lo que hay.
     *
     * 'hierarchical' => false es necesario: con el valor por defecto (true),
     * get_terms() cuela también los términos padre con 0 cursos propios
     * cuando algún hijo suyo sí tiene (p.ej. "Idiomas", vacío, aparecería
     * solo por ser el padre de "Inglés"), para no romper árboles cuando se
     * pintan como checklist jerárquico. Aquí no hay árbol, es una lista
     * plana, así que ese término padre vacío sería una etiqueta engañosa.
     *
     * @return \WP_Term[]
     */
    private static function subjectsWithCourses(): array
    {
        $terms = get_terms([
            'taxonomy' => 'course_subject',
            'hide_empty' => true,
            'hierarchical' => false,
        ]);

        return is_array($terms) ? $terms : [];
    }
}
