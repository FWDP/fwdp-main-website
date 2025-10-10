<?php
/**
 * Main Theme Bootstrap File
 * Responsible for initializing all core theme components (OOP-based)
 */

namespace FWDP\Core;

use FWDP\Interfaces\Hookable;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Theme {

    /**
     * Holds all theme components that implement Hookable
     *
     * @var Hookable[]
     */
    private $components = [];

    /**
     * List of component class names to attempt to register.
     * Add other core component class names here as needed.
     *
     * @var string[]
     */
    protected $component_classes = [
        Setup::class,
        Navigation::class,
        Customizer::class,
    ];

    /**
     * Bootstraps the theme by loading and registering components.
     */
    public function __construct() {
        // Register components on a safe hook so other plugins/themes can be loaded.
        // We do not call register_component() directly here to avoid ordering issues.
        add_action( 'after_setup_theme', [ $this, 'bootstrap_components' ] );

        // Enqueue front-end assets
        add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_assets' ] );

        // Enqueue customizer preview script when in customizer
        add_action( 'customize_preview_init', [ $this, 'enqueue_customizer_preview' ] );
    }

    /**
     * Attempt to instantiate and register listed components.
     * Skips any class that does not exist or does not implement Hookable.
     */
    public function bootstrap_components(): void {
        foreach ( $this->component_classes as $class ) {
            if ( ! class_exists( $class ) ) {
                // optionally log or notify: class missing
                continue;
            }

            // instantiate
            try {
                $instance = new $class();
            } catch ( \Throwable $e ) {
                // If instantiation fails for any reason, skip gracefully.
                continue;
            }

            // Only register if it implements Hookable
            if ( $instance instanceof Hookable ) {
                $this->register_component( $instance );
            } else {
                // skip non-Hookable components to avoid type errors
                // optional: you can still call a register() method if present, but we prefer Hookable contract
                if ( method_exists( $instance, 'register' ) ) {
                    // best-effort: call register but do not store in $this->components
                    try {
                        $instance->register();
                    } catch ( \Throwable $e ) {
                        // ignore errors
                    }
                }
            }
        }
    }

    /**
     * Registers a Hookable component into the theme
     *
     * @param Hookable $component Component instance implementing Hookable.
     */
    private function register_component( Hookable $component ): void {
        $this->components[] = $component;
        // call the component's register method (contract of Hookable)
        try {
            $component->register();
        } catch ( \Throwable $e ) {
            // swallow to avoid breaking theme boot
        }
    }

    /**
     * Enqueue theme-wide assets (compiled/dist files)
     */
    public function enqueue_assets(): void {
        $theme_version = wp_get_theme()->get( 'Version' ) ?: time();

        // Main compiled CSS
        $css_file = get_template_directory() . '/assets/dist/main.css';
        if ( file_exists( $css_file ) ) {
            wp_enqueue_style(
                'fwdp-main',
                get_template_directory_uri() . '/assets/dist/main.css',
                [],
                $theme_version
            );
        } else {
            // fallback to style.css if dist not built
            wp_enqueue_style(
                'fwdp-style',
                get_stylesheet_uri(),
                [],
                $theme_version
            );
        }

        // Main JS
        $js_file = get_template_directory() . '/assets/dist/main.js';
        if ( file_exists( $js_file ) ) {
            wp_enqueue_script(
                'fwdp-main',
                get_template_directory_uri() . '/assets/dist/main.js',
                [], // deps: add ['jquery'] if your scripts need it
                $theme_version,
                true
            );
        }
    }

    /**
     * Enqueue the customizer preview script (for live preview).
     * Expects an output at assets/dist/customizer.js or assets/js/customizer.js as fallback.
     */
    public function enqueue_customizer_preview(): void {
        $theme_version = wp_get_theme()->get( 'Version' ) ?: time();
        $customizer_dist = get_template_directory() . '/assets/dist/customizer.js';
        $customizer_src  = get_template_directory() . '/assets/src/js/customizer.js';

        if ( file_exists( $customizer_dist ) ) {
            wp_enqueue_script(
                'fwdp-customizer',
                get_template_directory_uri() . '/assets/dist/customizer.js',
                [ 'jquery', 'customize-preview' ],
                $theme_version,
                true
            );
        } elseif ( file_exists( $customizer_src ) ) {
            // useful during development when dist isn't built
            wp_enqueue_script(
                'fwdp-customizer',
                get_template_directory_uri() . '/assets/src/js/customizer.js',
                [ 'jquery', 'customize-preview' ],
                $theme_version,
                true
            );
        }
    }

    /**
     * Initializes the theme instance (helper).
     */
    public static function init(): void {
        new self();
    }
}
