<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class PageFooter extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'blocks.page-footer'
    ];


    public function with()
    {
        return [
            'mode_settings' => get_field('mode_settings'),
            'work' => get_field('work'),
            'location' => get_field('location'),
            'bold_text' => get_field('bold_text'),
            'sub_text' => get_field('sub_text'),
            'credits' => get_field('credits'),
            'first' => get_field('first_sentence'),
            'second' => get_field('second_sentence'),
            'icon'  => get_field('icon'),
            'anchor' => get_field('anchor_link'),
        ];
    }
}
