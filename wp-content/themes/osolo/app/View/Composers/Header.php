<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class Header extends Composer
{
    protected static $views = [
        'partials.header-search',
        'partials.header'
    ];

    public function with(): array
    {
        return [
            'hide_search' => get_field('hide_search', 'option'),
        ];
    }
}
