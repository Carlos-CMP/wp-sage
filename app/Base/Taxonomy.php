<?php

namespace App\Base;

/**
 * Clase base abstracta para registrar taxonomías.
 * Mismo patrón que App\Base\CPT: cada taxonomía concreta (CourseSubject,
 * CourseLevel...) solo define $taxonomy, $object_types y sus $labels;
 * la lógica repetitiva de registro vive aquí.
 */
abstract class Taxonomy
{
    // Nombre técnico de la taxonomía (ej. 'course_subject'). Lo define cada clase hija.
    protected static $taxonomy;

    // A qué post type(s) se asocia esta taxonomía. Es un array porque una
    // misma taxonomía puede compartirse entre varios CPT (ej. 'categoria'
    // podría aplicarse tanto a 'course' como a 'event').
    protected static $object_types = [];

    // Argumentos que sobreescriben los valores por defecto (hierarchical, rewrite...).
    protected static $args = [];

    /**
     * Registra la taxonomía en WordPress con los labels indicados.
     */
    protected static function registerWithLabels(array $labels)
    {
        // Igual que en CPT::registerWithLabels(): register_taxonomy() solo
        // debe llamarse durante (o después de) 'init'.
        if (did_action('init') === 0) {
            add_action('init', fn() => static::registerWithLabels($labels));
            return;
        }

        // taxonomy_exists() evita registrar la misma taxonomía dos veces.
        if (taxonomy_exists(static::$taxonomy)) {
            return;
        }

        $default_args = [
            'labels'            => $labels,
            'hierarchical'      => false, // cada clase hija decide si es jerárquica (tipo categoría) o plana (tipo etiqueta)
            'public'            => true,
            'show_ui'           => true,
            'show_admin_column' => true,
            'show_in_nav_menus' => true,
            'show_in_rest'      => true, // imprescindible para Gutenberg y la REST API
            'query_var'         => true,
            'rewrite'           => ['slug' => static::$taxonomy],
        ];

        $args = array_merge($default_args, static::$args);

        // Única línea que le habla a WordPress: registra la taxonomía y la
        // asocia a los post types indicados en $object_types.
        register_taxonomy(static::$taxonomy, static::$object_types, $args);
    }
}
