<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class Image extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'blocks.image'
    ];


    public function with()
    {
        return [
            'placement' => get_field('object_placement'),
            'image' => get_field('image'),
            'video' => get_field('video'),
            'opacity' => get_field('image_opacity') ? get_field('image_opacity') : '1'
        ];
    }
}
