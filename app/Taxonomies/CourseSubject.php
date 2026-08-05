<?php

namespace App\Taxonomies;

use App\Base\Taxonomy;

/**
 * Taxonomía "course_subject" (materia del curso), jerárquica: puede tener
 * términos padre/hijo, igual que las categorías nativas de WordPress
 * (ej. "Informática" > "Programación 1").
 */
class CourseSubject extends Taxonomy
{
    protected static $taxonomy = 'course_subject';
    protected static $object_types = ['course'];

    // Redeclarada aquí (aunque ya existe en la clase padre) para que esta
    // subclase tenga su propio "casillero" de memoria y no comparta el
    // valor con otras taxonomías hermanas como CourseLevel.
    protected static $args = [];

    public static function register()
    {
        $labels = [
            'name'              => __('Materias', 'novicell-sage-test'),
            'singular_name'     => __('Materia', 'novicell-sage-test'),
            'search_items'      => __('Buscar Materias', 'novicell-sage-test'),
            'all_items'         => __('Todas las Materias', 'novicell-sage-test'),
            'parent_item'       => __('Materia Padre', 'novicell-sage-test'),
            'parent_item_colon' => __('Materia Padre:', 'novicell-sage-test'),
            'edit_item'         => __('Editar Materia', 'novicell-sage-test'),
            'update_item'       => __('Actualizar Materia', 'novicell-sage-test'),
            'add_new_item'      => __('Añadir Nueva Materia', 'novicell-sage-test'),
            'new_item_name'     => __('Nuevo nombre de Materia', 'novicell-sage-test'),
            'menu_name'         => __('Materias', 'novicell-sage-test'),
        ];

        // 'hierarchical' => true pisa el valor por defecto (false) de la
        // clase base: los términos de esta taxonomía admiten jerarquía padre/hijo.
        static::$args = [
            'hierarchical' => true,
        ];

        parent::registerWithLabels($labels);
    }
}
