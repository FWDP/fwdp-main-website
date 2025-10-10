<?php
use FWDP\Core\Navigation;
use FWDP\Helpers\TemplateTags;

$primary_color = TemplateTags::get_primary_color();
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
    <style>
        :root {
            --primary-color: <?php echo esc_attr($primary_color); ?>;
        }
    </style>
</head>

<body <?php body_class('bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 transition-colors duration-300'); ?>>
<header 
    class="border-b border-gray-200 dark:border-gray-700 shadow-sm sticky top-0 z-50 transition-colors duration-300"
    style="background-color: <?php echo esc_attr($primary_color); ?>1A;">
    <div class="container mx-auto flex items-center justify-between p-4 md:p-6">
        <!-- Logo / Site Title -->
        <div class="flex items-center space-x-2">
            <?php if (has_custom_logo()) : ?>
                <?php the_custom_logo(); ?>
            <?php else : ?>
                <a href="<?php echo esc_url(home_url('/')); ?>" 
                   class="text-xl font-semibold hover:opacity-80 transition-opacity"
                   style="color: <?php echo esc_attr($primary_color); ?>;">
                    <?php bloginfo('name'); ?>
                </a>
            <?php endif; ?>
        </div>

        <!-- Primary Navigation -->
        <nav class="hidden md:flex space-x-6">
            <?php
            Navigation::render_menu(
                'primary',
                'flex space-x-6 text-gray-800 dark:text-gray-200 hover:text-gray-900 dark:hover:text-white transition-colors'
            );
            ?>
        </nav>

        <!-- Mobile Nav Toggle -->
        <button id="mobile-menu-toggle" 
            class="md:hidden p-2 rounded-md hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none transition"
            aria-label="Toggle Menu">
            <svg id="menu-icon" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-800 dark:text-gray-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden md:hidden border-t border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900">
        <nav class="flex flex-col space-y-2 p-4 text-gray-800 dark:text-gray-200">
            <?php
            Navigation::render_menu(
                'primary',
                'flex flex-col space-y-2 hover:text-gray-900 dark:hover:text-white transition-colors'
            );
            ?>
        </nav>
    </div>

    <script>
        // Toggle Mobile Menu
        document.addEventListener('DOMContentLoaded', function() {
            const toggle = document.getElementById('mobile-menu-toggle');
            const menu = document.getElementById('mobile-menu');

            toggle.addEventListener('click', () => {
                menu.classList.toggle('hidden');
            });
        });
    </script>
</header>
