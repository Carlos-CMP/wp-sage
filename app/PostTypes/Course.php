<?php

namespace App\PostTypes;

use App\Base\CPT;

/**
 * Custom Post Type "course" (curso).
 * Solo define lo que es específico de este CPT: nombre técnico, textos
 * que ve el editor en wp-admin y argumentos particulares si hacen falta.
 * Toda la lógica común de registro vive en App\Base\CPT.
 */
class Course extends CPT
{
    // Nombre técnico usado por WordPress internamente (columna post_type en wp_posts).
    protected static $post_type = 'course';

    public static function register()
    {
        // Textos que ve el editor de contenido en el admin de WordPress.
        // 'novicell-sage-test' es el textdomain: agrupa estas cadenas para traducción.
        $labels = [
            'name'               => __('Cursos', 'novicell-sage-test'),
            'singular_name'      => __('Curso', 'novicell-sage-test'),
            'menu_name'          => __('Cursos', 'novicell-sage-test'),
            'name_admin_bar'     => __('Curso', 'novicell-sage-test'),
            'add_new'            => __('Añadir Nuevo', 'novicell-sage-test'),
            'add_new_item'       => __('Añadir Nuevo Curso', 'novicell-sage-test'),
            'new_item'           => __('Nuevo Curso', 'novicell-sage-test'),
            'edit_item'          => __('Editar Curso', 'novicell-sage-test'),
            'view_item'          => __('Ver Curso', 'novicell-sage-test'),
            'all_items'          => __('Todos los Cursos', 'novicell-sage-test'),
            'search_items'       => __('Buscar Cursos', 'novicell-sage-test'),
            'not_found'          => __('No se encontraron cursos.', 'novicell-sage-test'),
            'not_found_in_trash' => __('No se encontraron cursos en la papelera.', 'novicell-sage-test'),
        ];

        // Args específicos de "course": icono propio en el menú de admin.
        // 'custom-fields' en supports no es obligatorio para que ACF funcione,
        // pero deja explícito que este CPT está pensado para llevar campos ACF.
        static::$args = [
            'menu_icon' => 'dashicons-welcome-learn-more',
            'supports'  => ['title', 'editor', 'excerpt', 'thumbnail', 'custom-fields'],
        ];

        // Delega en la clase base: ahí se hace el guard de 'init', el merge
        // de $args con los valores por defecto, y la llamada real a register_post_type().
        parent::registerWithLabels($labels);
    }
}
