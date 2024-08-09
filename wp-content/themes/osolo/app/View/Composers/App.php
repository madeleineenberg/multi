<?php

namespace App\View\Composers;

use WP_Error;
use Roots\Acorn\View\Composer;
use OTGS\Installer\FP\Undefined;

class App extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        '*',
    ];

    /**
     * Data to be passed to view before rendering.
     *
     * @return array
     */
    public function with(): array
    {
        return [
            'categories' => $this->categories(),
        ];
    }

    /**
     * Returns the category link
     *
     * @param string $taxonomy The taxonomy slug.
     * @param string $slug The term slug
     * @return string
     */

    static function getCategoryLink($taxonomy, $slug): string
    {
        if (
            function_exists('wc_get_page_id') &&
            isset(get_queried_object()->slug) &&
            get_queried_object()->slug === $slug
        ) {
            $url = get_permalink(wc_get_page_id('shop'));
        } else {
            $url = get_term_link($slug, $taxonomy);
        }

        $args = http_build_query($_GET);
        $url = strtok($url, '?');

        return $_GET ? "$url?$args" : $url;
    }

    /**
     * Returns the categories
     *
     * @return array
     */
    private function categories(): array|WP_Error
    {
        return get_terms([
            'taxonomy' => 'product_cat',
            'orderby' => 'term_order',
            'exclude' => [
                get_term_by('slug', 'uncategorized', 'product_cat')->term_id ?? null
            ]
        ]);
    }



    /**
     * Returns the site name.
     *
     * @return string
     */
    public function siteName()
    {
        return get_bloginfo('name', 'display');
    }
}
