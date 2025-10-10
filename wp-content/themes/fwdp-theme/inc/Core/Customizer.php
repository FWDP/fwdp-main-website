<?php
namespace FWDP\Core;

use FWDP\Interfaces\Hookable;

class Customizer implements Hookable {

    public function register() {
        add_action('customize_register', [$this, 'register_customizer_settings']);
    }

    public function register_customizer_settings($wp_customize) {
        // Primary Color Setting
        $wp_customize->add_setting('primary_color', [
            'default'   => '#1e40af',
            'transport' => 'postMessage',
            'sanitize_callback' => 'sanitize_hex_color',
        ]);

        $wp_customize->add_control(
            new \WP_Customize_Color_Control(
                $wp_customize,
                'primary_color',
                [
                    'label'   => __('Primary Color', 'fwdp'),
                    'section' => 'colors',
                ]
            )
        );
    }
}
