<?php
namespace FWDP\Core;

class Navigation {
    public function __construct() {
        add_action('after_setup_theme', [$this, 'register_menus']);
    }

    public function register_menus() {
        register_nav_menus([
            'primary' => __('Primary Menu', 'fwdp'),
            'footer'  => __('Footer Menu', 'fwdp'),
        ]);
    }

    /**
     * Echo menu directly with Tailwind walker.
     */
    public static function render_menu($location, $extra_classes = '') {
        if (!has_nav_menu($location)) return;

        wp_nav_menu([
            'theme_location' => $location,
            'container'      => false,
            'menu_class'     => "flex space-x-6 {$extra_classes}",
            'fallback_cb'    => false,
            'walker'         => new \FWDP\Core\Tailwind_Navwalker(),
        ]);
    }

    /**
     * Fallback if you just want array form.
     */
    public static function get_menu($location) {
        $menu_items = [];

        $locations = get_nav_menu_locations();
        if (!isset($locations[$location])) return $menu_items;

        $menu = wp_get_nav_menu_object($locations[$location]);
        if (!$menu) return $menu_items;

        $items = wp_get_nav_menu_items($menu->term_id);
        foreach ($items as $item) {
            $menu_items[] = [
                'title' => $item->title,
                'url'   => $item->url,
            ];
        }

        return $menu_items;
    }
}

/**
 * Tailwind Custom Walker for dropdown menus
 */
class Tailwind_Navwalker extends \Walker_Nav_Menu {
    public function start_lvl( &$output, $depth = 0, $args = null ) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"absolute left-0 mt-2 w-48 bg-white border border-gray-200 rounded-lg shadow-lg hidden group-hover:block\">\n";
    }

    public function end_lvl( &$output, $depth = 0, $args = null ) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n";
    }

    public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        $indent = ($depth) ? str_repeat("\t", $depth) : '';
        $classes = empty($item->classes) ? [] : (array) $item->classes;

        $is_active = in_array('current-menu-item', $classes) || in_array('current_page_item', $classes);
        $active_class = $is_active ? 'text-blue-600 font-semibold' : 'text-gray-700 hover:text-gray-900';
        $has_children = in_array('menu-item-has-children', $classes);

        $output .= $indent . '<li class="relative group">';

        $attributes  = !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';
        $item_output = $args->before ?? '';
        $item_output .= '<a' . $attributes . ' class="block px-3 py-2 ' . $active_class . ' transition-colors">';
        $item_output .= apply_filters('the_title', $item->title, $item->ID);
        $item_output .= '</a>';

        if ($has_children) {
            $item_output .= '<span class="absolute right-2 top-3 text-gray-500 group-hover:text-gray-800">▼</span>';
        }

        $item_output .= $args->after ?? '';
        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }

    public function end_el( &$output, $item, $depth = 0, $args = null ) {
        $output .= "</li>\n";
    }
}
