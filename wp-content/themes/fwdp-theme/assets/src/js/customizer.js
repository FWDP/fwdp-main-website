/**
 * Theme Customizer Live Preview
 * Enables asynchronous updates for site title, description, and colors.
 */

(function ($) {
    wp.customize('blogname', function (value) {
        value.bind(function (newVal) {
            $('.site-title a').text(newVal);
        });
    });

    wp.customize('blogdescription', function (value) {
        value.bind(function (newVal) {
            $('.site-description').text(newVal);
        });
    });

    wp.customize('header_textcolor', function (value) {
        value.bind(function (newColor) {
            if (newColor === 'blank') {
                $('.site-title, .site-description').css({
                    clip: 'rect(1px, 1px, 1px, 1px)',
                    position: 'absolute',
                });
            } else {
                $('.site-title, .site-description').css({
                    clip: 'auto',
                    position: 'relative',
                    color: newColor,
                });
            }
        });
    });

    // Optional: Live update background color if you added custom-background support
    wp.customize('background_color', function (value) {
        value.bind(function (newColor) {
            $('body').css('background-color', newColor);
        });
    });

    // Optional: Live preview for site logo (if custom logo is supported)
    wp.customize('custom_logo', function (value) {
        value.bind(function () {
            // Simply refresh the page for now to reflect logo changes
            location.reload();
        });
    });
})(jQuery);
