<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class ImageReveal extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'blocks.image-reveal'
    ];


    public function with()
    {
        return [
           'galleries' => get_field('galleries'),
        ];
    }

}