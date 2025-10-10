<?php
namespace FWDP\Core;

use FWDP\Interfaces\Hookable;

class Setup implements Hookable {
    public function register() {
        add_action('after_setup_theme', [$this, 'theme_supports']);
    }

    public function theme_supports() {
        add_theme_support('title-tag');
        add_theme_support('post-thumbnails');
        add_theme_support('custom-logo');
        add_theme_support('automatic-feed-links');
        add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption']);
        register_nav_menus([
            'primary' => __('Primary Menu', 'fwdp'),
        ]);
    }
}
