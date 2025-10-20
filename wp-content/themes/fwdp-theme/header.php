<?php
use FWDP\Core\Navigation;
use FWDP\Helpers\TemplateTags;

$primary_color = TemplateTags::get_primary_color();
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body>

<header 
    class="w-full shadow-md sticky top-0 z-50 transition-colors duration-300"
    style="background-color: <?php echo esc_attr($primary_color); ?>;"
>
    <div class="container mx-auto px-4 py-3 flex justify-between items-center">
        <div class="flex items-center space-x-3">
            <?php if (has_custom_logo()) : ?>
                <div class="site-logo">
                    <?php the_custom_logo(); ?>
                </div>
            <?php else : ?>
                <a href="<?php echo esc_url(home_url('/')); ?>" class="text-white text-xl font-semibold">
                    <?php bloginfo('name'); ?>
                </a>
            <?php endif; ?>
        </div>

        <nav class="hidden md:flex space-x-6 text-white font-medium">
            <?php Navigation::display_primary_menu(); ?>
        </nav>

        <!-- Mobile Menu Toggle -->
        <button id="menu-toggle" class="md:hidden text-white focus:outline-none" aria-label="Toggle Menu">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>
    </div>

    <!-- Mobile Navigation -->
    <nav id="mobile-menu" class="hidden md:hidden bg-gray-800 text-white py-4">
        <?php Navigation::display_primary_menu(); ?>
    </nav>
</header>

<main class="w-full">
