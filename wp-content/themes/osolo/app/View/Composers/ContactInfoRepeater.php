<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class ContactInfoRepeater extends Composer
{
    protected static $views = [
        'blocks.contact-info-repeater',
    ];

    public function with(): array
    {
        return [
            'heading' => get_field('heading') ?: '',
            'columns' => $this->items(),
            'fade_block' => get_field('contact_fade_block')
        ];
    }

    private function items()
    {
        $items = [];
        $columns = get_field('columns');

        foreach ($columns as $column) {
            $items[] = [
                'image' => $column['image'],
                'title' => $column['title'],
                'subtitle' => $column['subtitle'],
                'phone' => $column['phone'],
                'email' => $column['email'],
                'linkedin' => $column['linkedin'],
            ];
        }

        return $items;
    }
}
