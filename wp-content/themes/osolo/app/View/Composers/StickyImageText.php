<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class StickyImageText extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'blocks.sticky-image-text'
    ];


    public function with()
    {
        return [
            'image_position' => get_field('image_position') ? 'left' : '',
            'image' => get_field('image'),
            'video' => get_field('video'),
            'heading' => get_field('heading'),
            'subheading' => get_field('subheading'),
            'text' => get_field('text'),
            'color_background' => get_field('color_background') ? get_field('color_background') : '#FAEBE1',
            'role' => get_field('role'),
            'project_link' => get_field('project_link'),
        ];
    }

}
