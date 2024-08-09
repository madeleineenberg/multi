<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class Columns extends Composer
{
    protected static $views = [
        'blocks.columns',
    ];

    public function with(): array
    {
        return [
            'fade_block' => get_field('columns_fade_block'),
            'columns' => get_field('columns')
        ];
    }
}
