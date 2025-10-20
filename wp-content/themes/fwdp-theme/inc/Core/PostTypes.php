<?php
namespace FWDP\Core;

use FWDP\Interfaces\Hookable;

class PostTypes implements Hookable {
    public function register() {
        add_action('init', [$this, 'register_post_types']);
    }

    public function register_post_types() {

        // Services
        register_post_type('services', [
            'labels' => [
                'name'          => __('Services', 'fwdp'),
                'singular_name' => __('Service', 'fwdp'),
            ],
            'public'      => true,
            'has_archive' => true,
            'menu_icon'   => 'dashicons-hammer',
            'supports'    => ['title', 'editor', 'thumbnail', 'excerpt'],
            'rewrite'     => ['slug' => 'services'],
            'show_in_rest'=> true,
        ]);
    }
}
