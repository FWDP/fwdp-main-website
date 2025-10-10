<?php
namespace FWDP\Core;

use FWDP\Interfaces\Hookable;

class PostTypes implements Hookable {
    public function register() {
        add_action('init', [$this, 'register_post_types']);
    }

    public function register_post_types() {

        // Example: Projects
        register_post_type('project', [
            'labels' => [
                'name'          => __('Projects', 'fwdp'),
                'singular_name' => __('Project', 'fwdp'),
            ],
            'public'      => true,
            'has_archive' => true,
            'menu_icon'   => 'dashicons-portfolio',
            'supports'    => ['title', 'editor', 'thumbnail', 'excerpt'],
            'rewrite'     => ['slug' => 'projects'],
            'show_in_rest'=> true,
        ]);
    }
}
