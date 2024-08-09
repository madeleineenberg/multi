<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class Footer extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'partials.footer',
    ];

    /**
     * Data to be passed to view before rendering.
     *
     * @return array
     */
    public function with(): array
    {
        return [
            'addressInfo' => get_field('address_info', 'option'),
            'hide_newsletter' => get_field('hide_newsletter_form', 'option'),
            'newsletter_heading' => get_field('newsletter_heading', 'option'),
            'newsletter_id' => get_field('newsletter_form_id', 'option'),
            'text_area' => get_field('text_area', 'option'),
            'businessName' => get_field('business_name', 'option'),
            'post_box' => get_field('post_box', 'option'),
            'address' => get_field('address', 'option'),
            'phone' => get_field('phone', 'option'),
            'infoMail' => get_field('info_mail', 'option'),
            'logos' => $this->items(),
        ];
    }

    private function items()
    {
        $items = [];
        $logos = get_field('additional_logos', 'option') ?: [];

        foreach ($logos as &$logo) {
            $items[] = [
                'link' => $logo['logo_url'],
                'logo' => $logo['logo_image'],
            ];
        }

        return $items;
    }
}
