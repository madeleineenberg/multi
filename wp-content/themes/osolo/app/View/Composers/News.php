<?php

namespace App\View\Composers;

use WP_Query;
use Roots\Acorn\View\Composer;

class News extends Composer
{
    protected static $views = [
        'partials.content-single-news',
        'partials.content-news',
        'partials.news-list-item',
        'blocks.news-repeater',

    ];

    public function with(): array
    {
        return [
            'fade_block' => get_field('news_fade_block'),
            'heading' => get_the_title() ?: '',
            'blockHeading' => get_field('block_title'),
            'newsDate' =>  get_the_date('Y-m-d'),
            'link' => get_the_permalink(),
            'excerpt' => get_the_excerpt(),
            'listImage' => get_field('image_list_view'),
            'allNews' => $this->getAllNews(),
            'allTerms' => $this->getAllTerms(),
            'getNews' => $this->getNews(),
            'years' => $this->getYearArray(),
            'archive_heading' => get_field('news_heading', 'options'),
            'archive_preamble' => get_field('news_preamble', 'options')
        ];
    }

    /**
     * @param int $id
     *
     * @return string
     */
    static function getTermName(int $id = 0): string
    {
        global $post;

        if (!$id) {
            $id = $post->ID;
        }

        $terms = wp_get_post_terms($id, 'news-category');

        if (!$terms || is_wp_error($terms)) {
            return '';
        }

        $term = !empty($terms) ? array_shift($terms) : null;

        return $term->name;
    }

    /**
     * @return array|int|\WP_Error
     */
    private function getAllTerms(): array|int|\WP_Error
    {
        $items = ($this->getAllNews())->posts;
        $post_ids = [];

        foreach ($items as $item) {
            $post_ids[] = $item->ID;
        }

        $terms = get_terms([
            'taxonomy' => 'news-category',
            'exclude' => 1,
            'object_ids' => $post_ids
        ]);

        return $terms;
    }

    /**
     * @return array
     */
    private function getYearArray(): array
    {
        $allNews = ($this->getAllNews())->posts;
        $years = [];

        foreach ($allNews as $news) {
            $year = get_the_date('Y', $news->ID);

            if (!in_array($year, $years)) {
                $years[] = $year;
            }
        }

        return $years;
    }

    /**
     * @return mixed
     */
    private function getAllNews(): mixed
    {
        $args = [
            'post_type' => 'news',
            'posts_per_page' => -1
        ];

        return new WP_Query($args);
    }

    /**
     * @return mixed
     */
    private function getNews(): mixed
    {
        $slugs = [
            'type' => [
                'slug' => 'news-category',
                'type' => 'taxonomy',
                'order' => false
            ],
            'published-year' => [
                'slug'  => 'year',
                'type'  => 'year',
                'order' => false
            ]
        ];

        $args = [
            'post_type' => 'news',
            'posts_per_page' => 6
        ];

        // Change args by URL params
        $args = \App\getURLargs($slugs, $args);

        return new WP_Query($args);
    }
}
