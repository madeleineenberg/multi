<?php

return function () {
    $args = [
        'p' => $_GET['id'],
        'post_type' => 'galleri'
    ];

    $query = new WP_Query($args);
    $image = [];

    foreach ($query->posts as $post) {
        foreach (get_field('images', $post->ID) as $image) {
            $images[] = $image['image']['sizes']['large'];
        }
    }

    return [
        'query' => $query->posts,
        'images' => $images,
    ];
};
