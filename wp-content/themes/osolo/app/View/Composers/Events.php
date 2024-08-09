<?php

namespace App\View\Composers;

use WP_Query;
use Roots\Acorn\View\Composer;

class Events extends Composer
{

    protected static $views = [
        'partials.content-single-events',
        'partials.content-events',
        'partials.event-list-item',
        'blocks.event-repeater',

    ];

    public function with(): array
    {
        return [
            'fade_block' => get_field('event_fade_block'),
            'heading' => get_the_title() ?: '',
            'blockHeading' => get_field('block_title'),
            'link' => get_the_permalink(),
            'date' => get_field('date_of_event'),
            'time' => get_field('time_of_event'),
            'place' => get_field('place'),
            'listImage' => get_field('image_list_view'),
            'infoMail' => get_field('info_mail'),
            'allEvents' => $this->getAllEvents(),
            'upcomingEvents' => $this->getUpcomingEvents(),
            'completedEventsExist' => $this->completedEventExist(),
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

        $terms = wp_get_post_terms($id, 'event-category');
        $term = !empty($terms) ? array_shift($terms) : null;

        return $term->name ?? '';
    }

    private function getAllEvents()
    {
        $args = [
            'post_type' => 'events',
            'posts_per_page' => -1
        ];

        return new WP_Query($args);
    }

    private function getUpcomingEvents()
    {
        $slugs = [
            'status' => [
                'slug'  => 'date_of_event',
                'type'  => 'meta_key',
                'order' => false
            ]
        ];

        $args = [
            'post_type' => 'events',
            'posts_per_page' => -1,
            'meta_key'            => 'date_of_event',
            'orderby'            => 'meta_value',
            'order'                => 'ASC',
            'meta_query'  => [
                [
                    'key' => 'date_of_event',
                    'value' => date("Y-m-d"),
                    'compare' => '>=',
                    'type' => 'DATE'
                ]
            ]
        ];

        // Change args by URL params
        $args = \App\getURLargs($slugs, $args);

        return new WP_Query($args);
    }

    private function completedEventExist()
    {
        $args = [
            'post_type' => 'events',
            'posts_per_page' => -1,
            'meta_key'            => 'date_of_event',
            'orderby'            => 'meta_value',
            'order'                => 'ASC',
            'meta_query'  => [
                [
                    'key' => 'date_of_event',
                    'value' => date("Y-m-d"),
                    'compare' => '<',
                    'type' => 'DATE'
                ]
            ]
        ];

        return new WP_Query($args);
    }
}
