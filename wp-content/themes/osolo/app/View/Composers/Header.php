<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class Header extends Composer
{
    protected static $views = [
        'partials.header',
    ];

    public function with()
    {
        return [
            'menu_items' => $this->menu(),
            
        ];
    }

    private function menu()
    {
        $menu_items = array();

        if (($locations = get_nav_menu_locations()) && isset($locations['primary_navigation'])) {
            $menu = get_term($locations['primary_navigation']);
            $menu_items = wp_get_nav_menu_items($menu->term_id);
        }

        foreach ($menu_items as $key => $menu_item) {
            $menu_items[$key]->url = rtrim($menu_items[$key]->url, '/');
        }

        return $menu_items;
    }

}
