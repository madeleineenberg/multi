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
 * Hide "Custom fields" from admin menu when in staging or production
 */
if (env('WP_ENV') !== 'development') {
    add_action('admin_menu', function () {
        remove_menu_page('edit.php?post_type=acf-field-group');
    }, 999);
}

/**
 * Hide updates for filebird plugin
 */
add_filter('site_transient_update_plugins', function ($value) {
    unset($value->response['filebird/filebird.php']);
    return $value;
});

/**
 * Edit block html, only if it's not acf block
 */
add_filter('render_block', function ($block_content, $block) {
    $blocks = [];

    if (!$block['blockName']) {
        return $block_content;
    }

    if (in_array($block['blockName'], $blocks) || strpos($block['blockName'], 'core/') !== false) {
        if (is_singular('events') || is_singular('news')) {
            $block_content = '<div class="block-' . str_replace('/', '-', $block['blockName']) . '">' . $block_content . '</div>';
        } else if ($block['blockName'] === 'core/image') {
            $block_content = '<div class="block-' . str_replace('/', '-', $block['blockName']) . ' container fade-block"><div class="row justify-content-md-center"><div class="col-12 col-md-8 col-xl-6">' . $block_content . '</div></div></div>';
        } else if ($block['blockName'] === 'core/button') {
            $block_content = '<div class="block-' . str_replace('/', '-', $block['blockName']) . ' container"><div class="row justify-content-md-center"><div class="col-12 col-md-8 text-center">' . $block_content . '</div></div></div>';
        } else if ($block['blockName'] === 'core/shortcode') {
            $block_content = '<div class="block-' . str_replace('/', '-', $block['blockName']) . ' container"><div class="row justify-content-md-center"><div class="col-12 col-md-10">' . $block_content . '</div></div></div>';
        } else {
            $block_content = '<div class="block-' . str_replace('/', '-', $block['blockName']) . ' container"><div class="row justify-content-md-center"><div class="col-12 col-md-8 col-xl-6">' . $block_content . '</div></div></div>';
        }
    } else if ($block['blockName'] === 'acf/video-with-placeholder' || $block['blockName'] === 'acf/link-repeater') {
        if (is_singular('events') || is_singular('news')) {
            $block_content = '<div class="block-' . str_replace('/', '-', $block['blockName']) . '">' . $block_content . '</div>';
        } else {
            $block_content = '<div class="block-' . str_replace('/', '-', $block['blockName']) . ' container"><div class="row justify-content-md-center"><div class="col-12 col-md-10">' . $block_content . '</div></div></div>';
        }
    } else if (strpos($block['blockName'], 'acf/') === false) {
        $block_content = '<div class="block-' . str_replace('/', '-', $block['blockName']) . '">' . $block_content . '</div>';
    }

    return $block_content;
}, 10, 2);

//allowed blocks

add_filter('allowed_block_types_all', function ($allowed_block_types) {
    return [
        'core/paragraph',
        'core/list',
        'core/heading',
        'core/image',
        'core/buttons',
        'core/spacer',
        'acf/contact-info-repeater',
        'acf/event-repeater',
        'acf/form',
        'acf/image-slider',
        'acf/link-repeater',
        'acf/news-repeater',
        'acf/partners',
        'acf/puff-repeater',
        'acf/startpage-hero',
        'acf/text-image',
        'acf/video-with-placeholder',
        'acf/columns'
    ];
});


add_filter('nav_menu_css_class', function ($classes, $item) {
    if (is_singular('news') && $item->title == 'News') {
        $classes[] = 'current-menu-item';
    }
    if (is_singular('events') && $item->title == 'Events') {
        $classes[] = 'current-menu-item';
    }
    return $classes;
}, 10, 2);

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

add_filter('posts_search', function ($search, $query_vars) {
    global $wpdb;

    if (isset($query_vars->query['s']) && !empty($query_vars->query['s'])) {
        $args = [
            'posts_per_page' => -1,
            'post_type' => ['product', 'product_variation'],
            'meta_query' => [
                [
                    'key' => '_sku',
                    'value' => $query_vars->query['s'],
                    'compare' => 'LIKE'
                ]
            ],
            'fields' => 'ids'
        ];

        $product_ids = get_posts($args);

        if (sizeof($product_ids) > 0) {
            $search = str_replace('AND (((', "AND ((({$wpdb->posts}.ID IN (" . implode(',', $product_ids) . ")) OR (", $search);
        }
    }

    return $search;
}, 10, 2);

add_filter('pre_get_posts', function ($query) {
    if (!is_admin() && $query->is_main_query() && is_search()) {
        $query->set('posts_per_page', -1);
        $query->set('post_type', ['product', 'product_variation', 'page']);

        return $query;
    }

    return $query;
});
