<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class Form extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'blocks.form'
    ];


    public function with()
    {
        return [
            'links' => get_field('links'),
            'heading' => get_field('form_heading'),
            'text' => get_field('form_text'),
            'id' => get_field('ninja_forms_id')
        ];
    }
}
