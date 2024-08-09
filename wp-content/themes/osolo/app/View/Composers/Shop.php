<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class Shop extends Composer
{
    protected static $views = [
        'partials.header'
    ];

    public function with(): array
    {
        return [
            'hide_cart_btn' => get_field('hide_cart', 'option'),
        ];
    }
}
