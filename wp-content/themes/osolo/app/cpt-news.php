<?php

add_action('init', function () {
    register_post_type(
        'news',
        [
            'labels' => [
                'name' => __('Nyheter'),
                'singular_name' => __('Nyhet'),
                'add_new'       => 'Lägg till nyheter'
            ],
            'public'        => true,
            'has_archive'   => true,
            'public'        => true,
            'show_ui'       => true,
            'show_in_menu'  => true,
            'show_in_nav_menus'   => true,
            'show_in_admin_bar'   => true,
            'hierarchical'        => true,
            'show_in_rest'        => true,
        ]
    );

    register_taxonomy(
        'news-category',
        'news',
        [
            'label' => __('Typ av nyhet'),
            'hierarchical' => true,
            'has_archive' => true,
            'show_ui' => true,
            'public' => true,
            'show_in_menu'  => true,
            'show_in_nav_menus'   => true,
            'show_in_admin_bar'   => true,
            'show_in_rest'        => true,
        ]
    );
});
