<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class TextImageBlock extends Composer
{
    protected static $views = [
        'blocks.text-image',
    ];

    public function with(): array
    {
        return [
            'fade_block' => get_field('text_image_fade_block'),
            'text_position' => get_field('text_position'),
            'text_color' => get_field('text_color'),
            'background_color' => get_field('background_color'),
            'title' => get_field('title'),
            'text' => get_field('textarea'),
            'link' => get_field('link'),
            'image' => get_field('image'),
        ];
    }
}
