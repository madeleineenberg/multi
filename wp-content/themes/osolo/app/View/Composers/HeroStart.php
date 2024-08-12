<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class HeroStart extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'blocks.hero-start'
    ];


    public function with()
    {
        return [
           'hero_title' => get_field('hero_title'),
           'hero_image' => get_field('hero_image')['sizes']['large'] ? get_field('hero_image')['sizes']['large'] : '',
           'right_image' => get_field('right_image')['sizes']['large'] ? get_field('right_image')['sizes']['large'] : '',
           'left_image' => get_field('left_image')['sizes']['large'] ? get_field('left_image')['sizes']['large'] : '',
           'link' => get_field('link'),

        ];
    }

}