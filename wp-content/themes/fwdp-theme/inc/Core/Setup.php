<?php
namespace FWDP\Core;

use FWDP\Interfaces\Hookable;

/**
 * Class Setup
 * Handles theme setup and default feature support.
 *
 * @package FWDP\Core
 */
class Setup implements Hookable
{
    /**
     * Registers the hooks for the theme setup.
     */
    public function register(): void
    {
        add_action('after_setup_theme', [$this, 'theme_supports']);
    }

    /**
     * Declares theme support features and registers menus.
     */
    public function theme_supports(): void
    {
        // Core theme supports
        add_theme_support('title-tag');
        add_theme_support('post-thumbnails');
        add_theme_support('custom-logo', [
            'height'      => 100,
            'width'       => 400,
            'flex-height' => true,
            'flex-width'  => true,
        ]);
        add_theme_support('automatic-feed-links');
        add_theme_support('html5', [
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
        ]);

        // Custom background and header support
        add_theme_support('custom-background', [
            'default-color' => 'f5f5f5',
            'default-image' => '',
        ]);

        add_theme_support('custom-header', [
            'width'              => 1920,
            'height'             => 600,
            'flex-height'        => true,
            'flex-width'         => true,
            'default-text-color' => '000',
            'uploads'            => true,
        ]);

        // Enables selective refresh for widgets in the customizer
        add_theme_support('customize-selective-refresh-widgets');

        // Register navigation menus
        register_nav_menus([
            'primary' => __('Primary Menu', 'fwdp'),
            'footer'  => __('Footer Menu', 'fwdp'),
            'social'  => __('Social Links Menu', 'fwdp'),
        ]);
    }
}
