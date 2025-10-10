<?php
namespace FWDP\Core;

class Helpers {
    public static function get_excerpt($limit = 20) {
        return wp_trim_words(get_the_excerpt(), $limit, '...');
    }

    public static function get_thumbnail_url($post_id = null) {
        if (has_post_thumbnail($post_id)) {
            return get_the_post_thumbnail_url($post_id, 'large');
        }
        return get_template_directory_uri() . '/assets/img/placeholder.png';
    }
}
