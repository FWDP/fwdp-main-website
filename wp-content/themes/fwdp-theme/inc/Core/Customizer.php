<?php
/**
 * Theme Customizer Class
 *
 * @package FWDP
 */

namespace FWDP\Core;

class Customizer {
	/**
	 * Initialize hooks
	 */
	public static function init() {
		add_action( 'customize_register', [ __CLASS__, 'register' ] );
		add_action( 'customize_preview_init', [ __CLASS__, 'live_preview' ] );
	}

	/**
	 * Register customizer settings
	 *
	 * @param \WP_Customize_Manager $wp_customize Customizer instance.
	 */
	public static function register( $wp_customize ) {
		// === SECTION ===
		$wp_customize->add_section(
			'fwdp_theme_colors',
			[
				'title'       => __( 'Theme Colors', 'fwdp' ),
				'priority'    => 30,
				'description' => __( 'Customize theme color palette.', 'fwdp' ),
			]
		);

		// === SETTING ===
		$wp_customize->add_setting(
			'primary_color',
			[
				'default'           => '#1e40af',
				'sanitize_callback' => [ __CLASS__, 'sanitize_hex_color' ],
				'transport'         => 'postMessage',
			]
		);

		// === CONTROL ===
		$wp_customize->add_control(
			new \WP_Customize_Color_Control(
				$wp_customize,
				'primary_color',
				[
					'label'    => __( 'Primary Color', 'fwdp' ),
					'section'  => 'fwdp_theme_colors',
					'settings' => 'primary_color',
				]
			)
		);
	}

	/**
	 * Sanitize hex color.
	 *
	 * @param string $color Input color.
	 * @return string Sanitized color.
	 */
	public static function sanitize_hex_color( $color ) {
		return sanitize_hex_color( $color ) ?: '#1e40af';
	}

	/**
	 * Retrieve the current primary color.
	 *
	 * @return string The current primary color (HEX).
	 */
	public static function get_primary_color() {
		return get_theme_mod( 'primary_color', '#1e40af' );
	}

	/**
	 * Live preview script.
	 */
	public static function live_preview() {
		wp_enqueue_script(
			'fwdp-customizer',
			get_template_directory_uri() . '/assets/dist/customizer.js',
			[ 'jquery', 'customize-preview' ],
			'1.0.0',
			true
		);
	}
}

// Boot it up
Customizer::init();