<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class LinkRepeater extends Composer
{
    protected static $views = [
        'blocks.link-repeater',
    ];

    public function with(): array
    {
        return [
            'links' => get_field('link_repeater'),
        ];
    }
}
