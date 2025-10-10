<?php
namespace FWDP\Helpers;

class TemplateTags {

    /**
     * Get the primary color defined in the Customizer.
     */
    public static function get_primary_color(): string {
        // Fetch color from Customizer setting
        $primary_color = get_theme_mod('primary_color', '#1e40af');

        // Fallback to default if somehow invalid
        if (empty($primary_color) || !preg_match('/^#[a-fA-F0-9]{6}$/', $primary_color)) {
            $primary_color = '#1e40af';
        }

        return $primary_color;
    }

    /**
     * Example: Returns site title wrapped in a semantic tag.
     */
    public static function site_title(): string {
        return sprintf(
            '<a href="%1$s" class="text-xl font-semibold">%2$s</a>',
            esc_url(home_url('/')),
            esc_html(get_bloginfo('name'))
        );
    }

}
