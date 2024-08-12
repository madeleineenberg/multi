<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class HoverLink extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'blocks.hover-link'
    ];


    public function with()
    {
        return [
           'galleries' => get_field('galleries'),
        ];
    }

}
