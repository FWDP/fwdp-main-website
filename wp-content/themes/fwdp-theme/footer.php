<?php
use FWDP\Core\Navigation;
use FWDP\Helpers\TemplateTags;

$primary_color = TemplateTags::get_primary_color();
?>
    </main>

    <footer 
        class="mt-10 text-white transition-colors duration-300"
        style="background-color: <?php echo esc_attr($primary_color); ?>;"
    >
        <div class="container mx-auto px-6 py-8 flex flex-col md:flex-row justify-between items-center gap-6">

            <!-- Left: Copyright -->
            <div class="text-center md:text-left">
                <p class="text-sm opacity-80">
                    &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved.
                </p>
            </div>

            <!-- Right: Footer Navigation -->
            <div class="flex flex-col md:flex-row md:items-center gap-4 md:gap-8">
                <nav class="flex justify-center md:justify-end space-x-4 text-white hover:text-gray-200 transition-colors">
                    <?php Navigation::display_footer_menu(); ?>
                </nav>

                <!-- Social Links Menu -->
                <?php if (has_nav_menu('social')) : ?>
                    <nav class="flex justify-center md:justify-end space-x-4">
                        <?php Navigation::display_social_menu(); ?>
                    </nav>
                <?php endif; ?>
            </div>
        </div>

        <?php wp_footer(); ?>
    </footer>
</body>
</html>
