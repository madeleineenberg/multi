<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class Gallery extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'single-galleri'
    ];


    public function with()
    {
        return [
           'images' => get_field('images'),
        ];
    }

}