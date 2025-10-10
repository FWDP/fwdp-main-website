<?php
namespace FWDP\Core;

use FWDP\Interfaces\Hookable;

class Pages implements Hookable {
    public function register() {
        add_action('init', [$this, 'register_page_type']);
    }

    public function register_page_type() {
        register_post_type('fwdp_page', [
            'labels' => [
                'name'          => __('Page Contents', 'fwdp'),
                'singular_name' => __('Page Content', 'fwdp'),
            ],
            'public'      => true,
            'menu_icon'   => 'dashicons-media-document',
            'supports'    => ['title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'],
            'rewrite'     => ['slug' => 'content'],
            'show_in_rest'=> true,
        ]);
    }
}
