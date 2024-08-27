<?php

namespace App;

/**
 * Add "… Continued" to the excerpt.
 *
 * @return string
 */
add_filter('excerpt_more', function () {
    return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'osolo') . '</a>';
});

/**
 * Hide updates for filebird plugin
 */
add_filter('site_transient_update_plugins', function ($value) {
    unset($value->response['filebird/filebird.php']);
    return $value;
});


//allowed blocks

add_filter('allowed_block_types_all', function ($allowed_block_types) {
    return [
        'core/paragraph',
        'core/list',
        'core/heading',
        'core/image',
        'core/buttons',
        'core/spacer',
        'acf/hero-start',
        'acf/horizontal-text',
        'acf/hover-link',
        'acf/image-reveal',
        'acf/image',
        'acf/page-footer',
        'acf/page-hero',
        'acf/social',
        'acf/sticky-image-text',
        'acf/text-block',
        'acf/image-text',
        'acf/form',
        'acf/project-archive',
    ];
});


add_action('generate_rewrite_rules', function () {
    global $wp_rewrite;

    $removals = [
        "/category/",
        "/author/",
        "/comment/",
        "/tag/"
    ];

    $result = [];

    foreach ($removals as $removal) {
        $matches = preg_grep($removal, $wp_rewrite->rules);

        if ($matches) {
            $result = array_merge($matches, $result);
        }
    }

    $wp_rewrite->rules = array_diff($wp_rewrite->rules, $result);

    return $wp_rewrite->rules;
});

/**
 * Removes gutenberg for cpt
 */

add_filter('use_block_editor_for_post_type', function ($current_status, $post_type) {
    if ($post_type === 'galleri') return false;
    return $current_status;
}, 10, 2);
