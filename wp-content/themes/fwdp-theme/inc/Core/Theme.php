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
     * Holds instantiated components that implement Hookable
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
        Pages::class,
        Enqueue::class,
        Navigation::class,
        Customizer::class,
        PostTypes::class
    ];

    /**
     * Bootstraps the theme by loading and registering components.
     *
     * Note: we perform bootstrap immediately when Theme is instantiated to
     * avoid hook-order timing issues (so components that register their
     * own hooks during register() run correctly).
     */
    public function __construct() {
        // Immediately bootstrap components (deterministic order)
        $this->bootstrap_components();

        // Enqueue front-end assets at the normal hook
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
                // class missing — skip
                continue;
            }

            try {
                $instance = new $class();
            } catch ( \Throwable $e ) {
                // instantiation failed — skip
                continue;
            }

            if ( $instance instanceof Hookable ) {
                // store and call the contract method
                $this->components[] = $instance;
                try {
                    $instance->register();
                } catch ( \Throwable $e ) {
                    // swallow errors so theme still boots
                }
            } elseif ( method_exists( $instance, 'register' ) ) {
                // best-effort fallback for classes that have register() but don't implement Hookable
                try {
                    $instance->register();
                } catch ( \Throwable $e ) {
                    // ignore
                }
            }
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
                [], // add dependencies if required
                $theme_version,
                true
            );
        }
    }

    /**
     * Enqueue the customizer preview script (for live preview).
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
     * Initializes the theme instance — helper for bootstrap calls.
     *
     * Note: Prefer to call this early in functions.php (right after autoloader).
     */
    public static function init(): void {
        new self();
    }
}
