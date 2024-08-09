<?php

/**
 * Enables the Excerpt meta box in post type edit screen.
 */
add_action('init', function () {
    add_post_type_support('events', 'excerpt');
    add_post_type_support('news', 'excerpt');
    add_post_type_support('page', 'excerpt');
});


// ************* Remove default Posts type since no blog *************

// Remove side menu
add_action('admin_menu', function () {
    remove_menu_page('edit.php');
});


// Remove +New post in top Admin Menu Bar
add_action('admin_bar_menu', function ($wp_admin_bar) {
    $wp_admin_bar->remove_node('new-post');
}, 999);


// Remove Quick Draft Dashboard Widget
add_action('wp_dashboard_setup', function () {
    remove_meta_box('dashboard_quick_press', 'dashboard', 'side');
}, 999);

// *********** End remove post type ****************


// Set facebook og:image and twitter:image for sharing
add_action('wp_head', function () {
    global $post;
    $img_src = '';
    $default_image = ""; //default image src
    if (is_home() || is_archive() || is_404()) {
        return;
    }

    if (is_singular()) {
        $acfImage = get_field('image_list_view', $post->ID)['url'] ?? null;
    }
    if (is_page() && !is_home()) {
        $acfImage = get_field('hero_image', $post->ID)['url'] ?? null;
    }

    //if post has ACF 'image_og'
    if (!empty($acfImage)) {
        $img_src = $acfImage;
    }
    //if post does't has ACF 'image_og' but has thumbnail
    else if ($post && has_post_thumbnail($post->ID)) {
        $img_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID))[0];
    }
    //if post does't has thumbnail and also does't has ACF 'image_og' then set a default image
    else {
        $img_src = $default_image;
    }

?>
    <meta property="og:image" content="<?php echo $img_src; ?>" />
    <meta name="twitter:image" content="<?php echo $img_src; ?>">
<?php
}, 5);

add_action('plugins_loaded', function () {
    if (!\is_plugin_active('ninja-forms/ninja-forms.php')) {
        return;
    }

    global $wpdb;

    $is_maintenance = false;
    $forms = $wpdb->get_results("SELECT maintenance FROM `{$wpdb->prefix}nf3_upgrades`");

    if ($forms) {
        foreach ($forms as &$form) {
            if ($form->maintenance) {
                $is_maintenance = true;
            }
        }
    }

    if ($is_maintenance) {
        \WPN_Helper::set_forms_maintenance_mode(0);
    }
});

add_action('wpmdb_migration_complete', function () {
    if (env('WP_ENV') !== 'development') {
        return;
    }

    $active_plugins = get_option('active_plugins');
    $production_plugins = [
        'wordfence/wordfence.php',
        'wp-super-cache/wp-cache.php',
        'webp-express/webp-express.php',
        'redirection/redirection.php',
        'password-protected/password-protected.php'
    ];

    foreach ($active_plugins as $key => &$plugin) {
        if (in_array($plugin, $production_plugins)) {
            unset($active_plugins[$key]);
        }
    }

    update_option('active_plugins', $active_plugins);

    $smtp_settings = get_option('wp_mail_smtp');

    if (!$smtp_settings) {
        return;
    }

    $smtp_settings['mail']['mailer'] = 'mail';

    update_option('wp_mail_smtp', $smtp_settings);
});

add_action('wp_default_scripts', function ($scripts) {
    if (!is_admin() && isset($scripts->registered['jquery'])) {
        $script = $scripts->registered['jquery'];

        if ($script->deps) {
            $script->deps = array_diff($script->deps, ['jquery-migrate']);
        }
    }
});

// Hide Ninja Forms notice
add_action('admin_init', function () {
    $admin_notice = get_option('nf_admin_notice');

    if (!isset($admin_notice['one_week_support']['dismissed'])) {
        $admin_notice['one_week_support']['dismissed'] = 1;
        update_option('nf_admin_notice', $admin_notice);
    }
});
