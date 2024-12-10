<?php
add_action('init', function () {
    register_post_type(
        'Galleri',

        array(
            'labels' => array(
                'name' => __('Galleri'),
                'singular_name' => __('galleri'),
                'add_new'       => 'lägg till galleri',

            ),
            'public'        => true,
            'has_archive'   => false,
            'rewrite'       => array('slug' => 'gallery'),
            'public'        => true,
            'show_ui'       => true,
            'show_in_menu'  => true,
            'show_in_nav_menus'   => true,
            'show_in_admin_bar'   => true,
            'hierarchical'        => false,
            'show_in_rest'        => true,
            'menu_icon'           => 'dashicons-format-image',
            'supports' => array('title', 'custom-fields', 'thumbnail'),
        )
    );
});
