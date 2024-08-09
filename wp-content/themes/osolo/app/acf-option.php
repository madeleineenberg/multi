<?php
if (function_exists('acf_add_options_page')) {
    acf_add_options_page([
        'page_title' => __('Temainställningar', 'osolo'),
        'menu_title' => __('Temainställningar', 'osolo'),
        'menu_slug' => 'theme-general-settings',
        'capability' => 'edit_posts',
        'redirect' => true
    ]);

    acf_add_options_page([
        'page_title' => __('Inställningar för Osolo', 'osolo'),
        'menu_title' => __('Inställningar för Osolo', 'osolo'),
        'menu_slug' => 'osolo-general-settings',
        'capability' => 'edit_posts',
        'redirect' => true
    ]);

    acf_add_options_sub_page(array(
        'page_title' => 'Inställningar sidhuvud',
        'menu_title' => 'Sidhuvud',
        'menu_slug' => 'header',
        'parent_slug' => 'theme-general-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title' => 'Inställningar sidfot',
        'menu_title' => 'Sidfot',
        'menu_slug' => 'footer',
        'parent_slug' => 'theme-general-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title' => 'Inställningar 404-sida',
        'menu_title' => '404-sida',
        'menu_slug' => '404',
        'parent_slug' => 'theme-general-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title' => 'Inställningar sök-sida',
        'menu_title' => 'Sök-sida',
        'menu_slug' => 'search',
        'parent_slug' => 'osolo-general-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title'     => 'Inställningar nyheter',
        'menu_title'    => 'Inställningar-nyheter',
        'parent_slug'    => 'edit.php?post_type=news',
    ));

    if (class_exists('WooCommerce')) {
        acf_add_options_sub_page(array(
            'page_title' => 'Inställningar webbshop',
            'menu_title' => 'Webbshop',
            'menu_slug' => 'shop',
            'parent_slug' => 'osolo-general-settings',
        ));
    }
}
