<?php

namespace App\Base;

/**
 * Clase base abstracta para registrar Custom Post Types.
 * Cada CPT concreto (Course, Event...) extiende esta clase y solo tiene
 * que definir su $post_type y sus $labels; toda la lógica repetitiva
 * (guard de hook, evitar duplicados, merge de argumentos) vive aquí.
 */
abstract class CPT
{
    // Nombre técnico del post type (ej. 'course'). Lo define cada clase hija.
    protected static $post_type;

    // Argumentos que sobreescriben los valores por defecto (rewrite, menu_icon...).
    // Cada clase hija los rellena antes de llamar a registerWithLabels().
    protected static $args = [];

    /**
     * Registra el CPT en WordPress con los labels indicados.
     */
    protected static function registerWithLabels(array $labels)
    {
        // register_post_type() solo debe llamarse durante (o después de) el hook 'init'.
        // did_action('init') devuelve el nº de veces que 'init' ya se ha disparado;
        // si es 0, todavía no ha pasado, así que nos enganchamos y salimos para
        // no registrar el CPT en el momento equivocado del ciclo de vida de WP.
        if (did_action('init') === 0) {
            add_action('init', fn() => static::registerWithLabels($labels));
            return;
        }

        // post_type_exists() comprueba si ya está registrado. Sin este guard,
        // si 'init' se dispara más de una vez (o esta función se llama dos veces),
        // register_post_type() se ejecutaría por duplicado.
        if (post_type_exists(static::$post_type)) {
            return;
        }

        // Valores por defecto razonables para un CPT público típico.
        $default_args = [
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'show_in_nav_menus'  => true,
            'show_in_admin_bar'  => true,
            'show_in_rest'       => true, // imprescindible para Gutenberg y la REST API
            'query_var'          => true,
            'rewrite'            => ['slug' => static::$post_type],
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'supports'           => ['title', 'editor', 'excerpt', 'thumbnail'],
        ];

        // array_merge() hace que los $args propios de cada CPT concreto
        // pisen a los valores por defecto cuando coincide la clave.
        $args = array_merge($default_args, static::$args);

        // Esta es la única línea que realmente le habla a WordPress:
        // todo lo anterior solo prepara los datos que necesita.
        register_post_type(static::$post_type, $args);
    }
}
