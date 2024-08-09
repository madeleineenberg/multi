<?php

add_action('init', function () {
    register_post_type(
        'events',
        [
            'labels' => [
                'name' => __('Aktiviteter'),
                'singular_name' => __('Aktivitet'),
                'add_new'       => 'Lägg till aktivitet'
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
        'event-category',
        'events',
        [
            'label' => __('Typ av aktivitet'),
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
