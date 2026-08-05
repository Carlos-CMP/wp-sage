<?php

namespace App\Taxonomies;

use App\Base\Taxonomy;

/**
 * Taxonomía "course_level" (nivel del curso), plana: sus términos no
 * tienen jerarquía padre/hijo, igual que las etiquetas nativas de WordPress
 * (ej. "Básico", "Intermedio", "Avanzado").
 */
class CourseLevel extends Taxonomy
{
    protected static $taxonomy = 'course_level';
    protected static $object_types = ['course'];

    // Redeclarada aquí (aunque ya existe en la clase padre) para que esta
    // subclase tenga su propio "casillero" de memoria y no comparta el
    // valor con otras taxonomías hermanas como CourseSubject.
    protected static $args = [];

    public static function register()
    {
        $labels = [
            'name'          => __('Niveles', 'novicell-sage-test'),
            'singular_name' => __('Nivel', 'novicell-sage-test'),
            'search_items'  => __('Buscar Niveles', 'novicell-sage-test'),
            'all_items'     => __('Todos los Niveles', 'novicell-sage-test'),
            'edit_item'     => __('Editar Nivel', 'novicell-sage-test'),
            'update_item'   => __('Actualizar Nivel', 'novicell-sage-test'),
            'add_new_item'  => __('Añadir Nuevo Nivel', 'novicell-sage-test'),
            'new_item_name' => __('Nuevo nombre de Nivel', 'novicell-sage-test'),
            'menu_name'     => __('Niveles', 'novicell-sage-test'),
        ];

        // No hace falta pisar 'hierarchical': la clase base ya lo pone en
        // false por defecto, que es justo lo que queremos aquí.

        parent::registerWithLabels($labels);
    }
}
