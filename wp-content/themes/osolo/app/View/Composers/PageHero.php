<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class PageHero extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'blocks.page-hero'
    ];


    public function with()
    {
        return [
            'opacity' => get_field('image_opacity') ? get_field('image_opacity') : '1',
           'image' => get_field('image'),
           'video' => get_field('video_background'),
           'title' => get_field('title'),
        ];
    }

}
