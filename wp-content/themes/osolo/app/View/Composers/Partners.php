<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class Partners extends Composer
{
    protected static $views = [
        'blocks.partners',
    ];

    public function with(): array
    {
        return [
            'heading' => get_field('section_title') ?: '',
            'textArea' => get_field('text_area'),
            'partners' => $this->items()
        ];
    }

    /**
     * @return array
     */
    private function items(): array
    {
        $items = [];
        $partners = get_field('partners');

        foreach ($partners as $partner) {
            $items[] = [
                'link' => $partner['partner_link'],
                'logo' => $partner['partner_logo'],
            ];
        }

        return $items;
    }
}
