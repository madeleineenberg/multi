<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;
use WP_Post;

class Gallery extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'single-galleri'
    ];

    /**
     * Hur många gallerier som listas i sidospalten.
     */
    protected const NAV_LIMIT = 10;

    public function with()
    {
        return [
            'images' => get_field('images'),
            'galleries' => $this->latestGalleries(),
            'archive_url' => $this->archiveUrl(),
        ];
    }

    /**
     * De senaste gallerierna, det nuvarande inräknat så att sidospalten kan
     * markera var man befinner sig.
     *
     * @return WP_Post[]
     */
    protected function latestGalleries(): array
    {
        return get_posts([
            'post_type' => 'galleri',
            'posts_per_page' => self::NAV_LIMIT,
            'orderby' => 'date',
            'order' => 'DESC',
            'suppress_filters' => false,
        ]);
    }

    /**
     * Galleriarkivet är en vanlig sida, post_type galleri har ingen egen
     * arkivsida registrerad.
     */
    protected function archiveUrl(): string
    {
        $page = get_page_by_path('gallery');

        return $page ? (string) get_permalink($page) : (string) home_url('/');
    }
}
