<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class Page extends Composer
{
    protected static $views = [
        'partials.content-page',
        'partials.page-header',
        'partials.header',
        'page',
    ];

    public function with(): array
    {
        return [
            'heroImage' => $this->heroImage(),
            'preamble' => get_field('preamble'),
            'logo' => get_field('header_company_logo', 'option'),
            'backgroundColor' => get_field('header_background_color', 'option'),
        ];
    }

    private function heroImage()
    {
        $image = get_field('hero_image');

        if (function_exists('wc_get_page_id') && !$image && (is_shop() || is_product_category())) {
            $shop_id = \wc_get_page_id('shop');
            $image = get_field('hero_image', $shop_id);
        }

        return $image;
    }
}
