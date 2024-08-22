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
            'heading' => get_field('block_heading'),
            'galleries' => get_field('galleries'),
            'link' => get_field('gallery_link'),
        ];
    }
}
