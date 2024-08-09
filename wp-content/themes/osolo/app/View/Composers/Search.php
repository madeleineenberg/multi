<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class Search extends Composer
{
    protected static $views = [
        'search'
    ];

    public function with(): array
    {
        global $wp_query;

        return [
            'search' => get_search_query(),
            'found_posts' => $wp_query->found_posts
        ];
    }
}
