<?php
require_once get_template_directory() . '/inc/autoloader.php';

$theme = new \FWDP\Theme();
add_action('after_setup_theme', function() use ($theme) {
    $theme->init();
});
