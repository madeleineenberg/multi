<?php

namespace App;

function getURLargs($slugs, $args)
{
    foreach ($_GET as $key => $param) {
        foreach ($slugs as $mask => $slug) {
            if ($key === $mask) {
                switch ($slug['type']) {
                    case 'taxonomy': {
                            $args['tax_query'][] = [
                                'taxonomy' => $slug['slug'],
                                'field' => 'slug',
                                'terms' => $param
                            ];
                            break;
                        }
                    case 'year': {
                            $args['year'] = $param;
                            break;
                        }
                    case 'meta_key': {
                            if ($key === 'status') {
                                if ($param === 'upcoming-events') {
                                    $args['meta_key'] = 'date_of_event';
                                    $args['orderby'] = 'meta_value';
                                    $args['order'] = 'ASC';
                                    $args['meta_query'] = [
                                        [
                                            'key' => 'date_of_event',
                                            'value' => date("Y-m-d"),
                                            'compare' => '>=',
                                            'type' => 'DATE'
                                        ]
                                    ];
                                } else {
                                    $args['meta_key'] = 'date_of_event';
                                    $args['orderby'] = 'meta_value';
                                    $args['order'] = 'DESC';
                                    $args['meta_query'] = [
                                        [
                                            'key' => 'date_of_event',
                                            'value' => date("Y-m-d"),
                                            'compare' => '<',
                                            'type' => 'DATE'
                                        ]
                                    ];
                                }
                                break;
                            }
                        }
                }
            }
        }
    }

    return $args;
}
