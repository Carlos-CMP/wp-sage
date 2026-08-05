<?php

namespace App\Fields;

/**
 * ACF: campos del CPT "course" (precio, duración).
 * Patrón de Casino (app/Fields/*.php): el grupo de campos se registra en
 * PHP puro vía acf_add_local_field_group(), no desde la UI de wp-admin.
 * Así queda versionado en git y viaja entre entornos sin exportar/sincronizar.
 */
class CourseFields
{
    public function __construct()
    {
        // 'acf/init' es el hook recomendado por ACF para registrar field
        // groups en PHP (equivalente a 'init', pero garantiza que ACF ya
        // esté cargado antes de llamar a sus funciones).
        add_action('acf/init', [$this, 'register_fields']);
    }

    public function register_fields(): void
    {
        // Guard por si el plugin ACF no está activo: evita un fatal error
        // al llamar a una función que no existiría.
        if (! function_exists('acf_add_local_field_group')) {
            return;
        }

        acf_add_local_field_group([
            'key'    => 'group_course_fields',
            'title'  => 'Datos del curso',
            'fields' => [
                [
                    'key'   => 'field_course_precio',
                    // 'label' es el texto que ve el editor en wp-admin.
                    // 'name' es el slug interno que usa get_field('precio').
                    'label' => 'Precio',
                    'name'  => 'precio',
                    'type'  => 'number',
                    'instructions' => 'Precio del curso en euros. Deja 0 para curso gratuito.',
                    'required' => 0,
                    'min'   => 0,
                    'step'  => 0.01,
                ],
                [
                    'key'   => 'field_course_duracion',
                    'label' => 'Duración',
                    'name'  => 'duracion',
                    'type'  => 'text',
                    'instructions' => 'Duración del curso (ej. "8 horas", "3 semanas").',
                    'required' => 0,
                    'placeholder' => 'Ej: 8 horas',
                ],
            ],
            // 'location' asocia el grupo al post type 'course': solo
            // aparecerá en el editor cuando se edite un curso.
            'location' => [
                [
                    [
                        'param'    => 'post_type',
                        'operator' => '==',
                        'value'    => 'course',
                    ],
                ],
            ],
        ]);
    }

    /**
     * Formatea el precio con "€" al leerlo (mismo filtro que en el
     * proyecto clásico). Distingue precio = 0 (curso gratuito, se
     * muestra "0 €") de precio vacío/null (sin precio definido, no
     * se muestra nada).
     */
    public function format_precio($valor)
    {
        if ($valor === '' || is_null($valor)) {
            return '';
        }

        return $valor . ' €';
    }
}
