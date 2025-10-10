<?php
use FWDP\Core\Navigation;
use FWDP\Helpers\TemplateTags;

$primary_color = TemplateTags::get_primary_color();
?>
<footer 
    class="border-t border-gray-200 dark:border-gray-700 mt-10 transition-colors duration-300" 
    style="background-color: <?php echo esc_attr($primary_color); ?>1A;"> <!-- Adds subtle tint of your primary color (10% opacity) -->
    <div class="container mx-auto p-6 flex flex-col md:flex-row justify-between items-center">
        <div class="mb-4 md:mb-0">
            <p class="text-gray-700 dark:text-gray-300">
                &copy; <?php echo date('Y'); ?> 
                <span class="font-semibold" style="color: <?php echo esc_attr($primary_color); ?>;">
                    <?php bloginfo('name'); ?>
                </span>
            </p>
        </div>

        <nav class="flex space-x-4">
            <?php Navigation::render_menu(
                'footer',
                'flex space-x-4 text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition-colors'
            ); ?>
        </nav>
    </div>

    <?php wp_footer(); ?>
</footer>
</body>
</html>
