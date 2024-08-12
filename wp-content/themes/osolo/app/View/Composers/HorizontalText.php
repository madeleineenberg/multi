<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class HorizontalText extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'blocks.horizontal-text'
    ];


    public function with()
    {
        return [
            'heading' => get_field('heading'),
            'subheading' => get_field('subheading'),
            'textStrips' => get_field('text_strips')
        ];
    }

}