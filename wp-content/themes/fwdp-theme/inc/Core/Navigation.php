<?php
namespace FWDP\Core;

use FWDP\Interfaces\Hookable;

class Navigation implements Hookable {

    /**
     * Hook the navigation setup into WordPress lifecycle.
     */
    public function register() {
        add_action('after_setup_theme', [$this, 'register_menus']);
    }

    /**
     * Register theme navigation menu locations.
     */
    public function register_menus() {
        register_nav_menus([
            'primary' => __('Primary Menu', 'fwdp'),
            'footer'  => __('Footer Menu', 'fwdp'),
            'social'  => __('Social Links Menu', 'fwdp'),
        ]);
    }

    /**
     * Helper: Render the Primary Menu
     */
    public static function display_primary_menu() {
        if (!has_nav_menu('primary')) return;

        wp_nav_menu([
            'theme_location' => 'primary',
            'container'      => 'nav',
            'container_class'=> 'primary-navigation',
            'menu_class'     => 'nav-list flex space-x-6',
            'fallback_cb'    => false,
            'depth'          => 2,
        ]);
    }

    /**
     * Helper: Render the Footer Menu
     */
    public static function display_footer_menu() {
        if (!has_nav_menu('footer')) return;

        wp_nav_menu([
            'theme_location' => 'footer',
            'container'      => 'nav',
            'container_class'=> 'footer-navigation',
            'menu_class'     => 'footer-menu flex flex-wrap justify-center md:justify-end space-x-6',
            'fallback_cb'    => false,
            'depth'          => 1,
        ]);
    }

    /**
     * Helper: Render the Social Links Menu (e.g., in footer)
     */
    public static function display_social_menu() {
        if (!has_nav_menu('social')) return;

        wp_nav_menu([
            'theme_location'  => 'social',
            'container'       => 'nav',
            'container_class' => 'social-navigation',
            'menu_class'      => 'social-links flex space-x-4',
            'link_before'     => '<span class="sr-only">',
            'link_after'      => '</span>',
            'depth'           => 1,
            'fallback_cb'     => false,
        ]);
    }
}
