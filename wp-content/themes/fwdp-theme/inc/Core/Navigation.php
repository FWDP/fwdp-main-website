<?php
namespace FWDP\Core;

use FWDP\Interfaces\Hookable;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Navigation implements Hookable {

    /**
     * Register method called by Theme bootstrap.
     * We register menu locations immediately here to avoid timing
     * problems when Theme boots components on after_setup_theme.
     */
    public function register(): void {
        $this->register_menus();
    }

    /**
     * Register theme navigation menu locations.
     */
    public function register_menus(): void {
        register_nav_menus([
            'primary' => __( 'Primary Menu', 'fwdp' ),
            'footer'  => __( 'Footer Menu', 'fwdp' ),
            'social'  => __( 'Social Links Menu', 'fwdp' ),
        ]);
    }

    /**
     * Helper: Render the Primary Menu
     */
    public static function display_primary_menu(): void {
        if ( ! has_nav_menu( 'primary' ) ) {
            return;
        }

        wp_nav_menu([
            'theme_location'  => 'primary',
            'container'       => 'nav',
            'container_class' => 'primary-navigation',
            'menu_class'      => 'nav-list flex space-x-6',
            'fallback_cb'     => false,
            'depth'           => 2,
        ]);
    }

    /**
     * Helper: Render the Footer Menu
     */
    public static function display_footer_menu(): void {
        if ( ! has_nav_menu( 'footer' ) ) {
            return;
        }

        wp_nav_menu([
            'theme_location'  => 'footer',
            'container'       => 'nav',
            'container_class' => 'footer-navigation',
            'menu_class'      => 'footer-menu flex flex-wrap space-x-6',
            'fallback_cb'     => false,
            'depth'           => 1,
        ]);
    }

    /**
     * Helper: Render the Social Links Menu (same pattern as footer nav)
     */
    public static function display_social_menu( string $extra_classes = '' ): void {
        if ( ! has_nav_menu( 'social' ) ) {
            return;
        }

        wp_nav_menu([
            'theme_location'  => 'social',
            'container'       => 'nav',
            'container_class' => 'social-navigation',
            'menu_class'      => trim('social-menu flex flex-wrap justify-center md:justify-end space-x-6 ' . $extra_classes),
            'fallback_cb'     => false,
            'depth'           => 1,
        ]);
    }
}
