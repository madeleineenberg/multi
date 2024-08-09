<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class PageNotFound extends Composer
{
    protected static $views = [
        '404',
    ];

    public function with(): array
    {
        return [
            'topText' => get_field('top_text', 'option'),
            'pageTitle' => get_field('page_title', 'option'),
            'textArea' => get_field('textarea', 'option'),
        ];
    }
}
