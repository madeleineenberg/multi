<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class ImageText extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'blocks.image-text'
    ];


    public function with()
    {
        return [
            'block_title' => get_field('block_title'),
            'image_position' => get_field('image_position') ? 'left' : '',
            'image' => get_field('image'),
            'video' => get_field('video'),
            'heading' => get_field('heading'),
            'subheading' => get_field('subheading'),
            'text' => get_field('text'),
            'color_background' => get_field('color_background') ? get_field('color_background') : '#FAEBE1',
            'project_link' => get_field('project_link'),
            'file' => get_field('file'),
        ];
    }
}
