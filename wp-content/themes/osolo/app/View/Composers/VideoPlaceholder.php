<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class VideoPlaceholder extends Composer
{
    protected static $views = [
        'blocks.video-with-placeholder',
    ];

    public function with(): array
    {
        return [
            'fade_block' => get_field('video_fade_block'),
            'placeholderImage' => get_field('placeholder_image'),
            'videoUrl' => get_field('video_url'),
            'videoTitle' => get_field('text')
        ];
    }
}
