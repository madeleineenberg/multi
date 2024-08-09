<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class PuffRepeater extends Composer
{
    protected static $views = [
        'blocks.puff-repeater',
    ];

    public function with(): array
    {
        return [
            'fade_block' => get_field('puff_column_fade_block'),
            'puff_columns' => $this->items(),
            'title' => get_field('group_title')
        ];
    }

    /**
     * @return array
     */
    private function items(): array
    {
        $items = [];
        $columns = get_field('puff-repeater');

        foreach ($columns as $column) {
            $items[] = [
                'image' => $column['image']['sizes']['large'],
                'image_alt' => $column['image']['alt'],
                'title' => $column['title'],
                'text' => $column['text_area'],
                'link' => $column['link'] ? $column['link']['url'] : '',
                'link_text' => $column['link'] ? $column['link']['title'] : '',
                'border_color' => $column['border_color']
            ];
        }

        return $items;
    }
}
