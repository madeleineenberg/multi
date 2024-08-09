<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class ImageSlider extends Composer
{
    protected static $views = [
        'blocks.image-slider',
    ];

    public function with(): array
    {
        return [
            'images' => $this->items(),
            'heading' => get_field('heading') ?: ''
        ];
    }

    /**
     * @return array
     */
    private function items(): array
    {
        $items = [];
        $images = get_field('images');

        foreach ($images as $image) {
            $items[] = [
                'image' => $image['image']['sizes']['large'],
                'image_alt' => $image['image']['alt'],
            ];
        }

        return $items;
    }
}
