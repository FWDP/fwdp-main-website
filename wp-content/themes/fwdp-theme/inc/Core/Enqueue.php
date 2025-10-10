<?php
namespace FWDP\Core;

use FWDP\Interfaces\Hookable;

class Enqueue implements Hookable {
    public function register() {
        add_action('wp_enqueue_scripts', [$this, 'enqueue_assets']);
    }

    public function enqueue_assets() {
        $theme_version = wp_get_theme()->get('Version');

        wp_enqueue_style('fwdp-style', get_template_directory_uri() . '/assets/dist/style.css', [], $theme_version);
        wp_enqueue_script('fwdp-main', get_template_directory_uri() . '/assets/dist/main.js', ['jquery'], $theme_version, true);
    }
}
