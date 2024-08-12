<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class TextBlock extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'blocks.text-block'
    ];


    public function with()
    {
        return [
           'heading' => get_field('heading'),
           'text' => get_field('text'),
           'icon' => get_field('icon'),
           'image' => get_field('image'),
           'opacity' => get_field('image_opacity') ? get_field('image_opacity') : '1',
        ];
    }

}
