<?php
if (function_exists('acf_add_options_page')) {
    acf_add_options_page([
        'page_title' => __('Temainställningar', 'osolo'),
        'menu_title' => __('Temainställningar', 'osolo'),
        'menu_slug' => 'theme-general-settings',
        'capability' => 'edit_posts',
        'redirect' => true
    ]);

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
}
