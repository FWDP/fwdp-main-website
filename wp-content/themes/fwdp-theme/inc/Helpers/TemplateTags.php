<?php
/**
 * Template Tags
 *
 * Helper class for commonly used theme functions
 *
 * @package FWDP
 */

namespace FWDP\Helpers;

use FWDP\Core\Customizer;

class TemplateTags {

	/**
	 * Get the current primary color from the Customizer
	 *
	 * @return string HEX color value
	 */
	public static function get_primary_color() {
		return Customizer::get_primary_color();
	}

	/**
	 * Example: Get site logo or fallback to title
	 *
	 * @return string HTML markup
	 */
	public static function get_logo() {
		if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
			return get_custom_logo();
		}

		return sprintf(
			'<a href="%1$s" class="text-xl font-bold">%2$s</a>',
			esc_url( home_url( '/' ) ),
			esc_html( get_bloginfo( 'name' ) )
		);
	}

	/**
	 * Example: Display site description/tagline
	 *
	 * @return string
	 */
	public static function get_tagline() {
		$description = get_bloginfo( 'description', 'display' );
		return $description ? esc_html( $description ) : '';
	}
}
