<?php
return function (): array {
    if (!isset($_GET['post_type'])) {
        wp_die('Missing post type');
    }

    $args = [
        'post_type' => $_GET['post_type']
    ];
    $html = '';
    $partial = '';

    switch ($_GET['post_type']) {
        case 'news':
            $partial = 'partials.news-list-item';
            $taxonomy = 'news-category';
            break;
        case 'events': {
                $partial = 'partials.event-list-item';
                $taxonomy = 'event-category';
                break;
            }
    }

    if (isset($_GET['terms']) && $_GET['terms']) {
        $args['tax_query'][] = [
            'taxonomy'  => 'news-category',
            'field'     => 'slug',
            'terms'     => $_GET['terms']
        ];
    }

    if (isset($_GET['year']) && $_GET['year']) {
        $args['year'] = $_GET['year'];
    }

    if (isset($_GET['status'])) {
        if ($_GET['status'] === 'upcoming-events') {
            $args['meta_key'] = 'date_of_event';
            $args['orderby'] = 'meta_value';
            $args['order'] = 'ASC';
            $args['meta_query'] = [
                [
                    'key' => 'date_of_event',
                    'value' => date("Y-m-d"),
                    'compare' => '>=',
                    'type' => 'DATE'
                ]
            ];
        } else {
            $args['meta_key'] = 'date_of_event';
            $args['orderby'] = 'meta_value';
            $args['order'] = 'DESC';
            $args['meta_query'] = [
                [
                    'key' => 'date_of_event',
                    'value' => date("Y-m-d"),
                    'compare' => '<',
                    'type' => 'DATE'
                ]
            ];
        }
    }


    if (isset($_GET['s'])) {
        $args['s'] = $_GET['s'];
    }

    if (isset($_GET['offset'])) {
        $args['offset'] = $_GET['offset'];
    }

    if (isset($_GET['posts_per_page'])) {
        $args['posts_per_page'] = $_GET['posts_per_page'] ?? 9;
    }

    $query = new WP_Query($args);

    foreach ($query->posts as $post) {
        $html .= \Roots\view($partial, [
            'link' => get_permalink($post->ID),
            'heading' => get_the_title($post->ID) ?: '',
            'excerpt' => get_the_excerpt($post->ID),
            'newsDate' => get_the_date('Y/m/d', $post->ID),
            'image' => get_field('image_list_view', $post->ID),
            'term' => get_the_terms($post->ID, $taxonomy)[0]->name,
            'date' => get_field('date_of_event', $post->ID),
            'place' => get_field('place', $post->ID),
        ]);
    }

    return [
        'html' => $html,
        'found_posts' => $query->found_posts,
        'post_count' => $query->post_count
    ];
};
