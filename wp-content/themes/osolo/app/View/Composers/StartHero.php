<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class StartHero extends Composer
{
    protected static $views = [
        'blocks.startpage-hero',
    ];

    public function with(): array
    {
        return [
            'image' => get_field('background_image'),
            'video' => get_field('background_video'),
            'heading' => get_field('title') ?: '',
            'text' => get_field('text'),
            'link' => get_field('link'),
        ];
    }
}
