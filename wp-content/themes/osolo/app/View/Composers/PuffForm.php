<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class PuffForm extends Composer
{
    protected static $views = [
        'blocks.form',
    ];

    public function with(): array
    {
        return [
            'fade_block' => get_field('form_fade_block'),
            'form_position' => get_field('form_position'),
            'image' => get_field('image'),
            'heading' => get_field('heading') ?: '',
            'text' => get_field('text'),
            'text_color' => get_field('text_color'),
            'form_title' => get_field('title'),
            'form_desc' => get_field('description'),
            'form_id' => get_field('form_id')
        ];
    }
}
