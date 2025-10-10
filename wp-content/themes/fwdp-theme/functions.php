<?php
// functions.php (top of file)
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Autoloader
 * Make sure your autoloader is required before we try to init classes.
 * If you use Composer, this would typically be: require_once __DIR__ . '/vendor/autoload.php';
 */
$autoloader = get_template_directory() . '/inc/autoloader.php';
if ( file_exists( $autoloader ) ) {
    require_once $autoloader;
}

/**
 * Boot the Theme (init components immediately)
 * We prefer calling Theme::init() directly after the autoloader so
 * components register their menu locations and supports before admin pages render.
 */
if ( class_exists( \FWDP\Core\Theme::class ) ) {
    \FWDP\Core\Theme::init();
} else {
    // Fallback: try to require the Theme class file directly (if not autoloaded)
    $theme_file = get_template_directory() . '/inc/Core/Theme.php';
    if ( file_exists( $theme_file ) ) {
        require_once $theme_file;
        if ( class_exists( \FWDP\Core\Theme::class ) ) {
            \FWDP\Core\Theme::init();
        }
    }
}

/**
 * --- IMPORTANT ---
 * If you previously had:
 *   add_action('after_setup_theme', ['FWDP\\Core\\Theme','init']);
 * remove or comment that line to avoid double initialization.
 */
