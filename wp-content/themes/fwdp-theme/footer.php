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
        <div class="container mx-auto px-6 py-10 flex flex-col gap-8">

            <!-- Top: Navigation Row -->
            <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-6">

                <!-- Left: Footer Navigation -->
                <?php if ( has_nav_menu('footer') ) : ?>
                    <div class="footer-navigation flex-1 md:justify-start">
                        <?php Navigation::display_footer_menu(); ?>
                    </div>
                <?php endif; ?>

                <!-- Right: Social Links -->
                <?php if ( has_nav_menu('social') ) : ?>
                    <div class="social-navigation flex-1 md:flex md:justify-end">
                        <?php Navigation::display_social_menu('text-white hover:text-gray-200 transition-colors'); ?>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Bottom: Divider + Copyright -->
            <div class="border-t border-white/20 pt-4 text-center opacity-80">
                <p class="text-sm">
                    &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved.
                </p>
            </div>
        </div>

        <?php wp_footer(); ?>
    </footer>
</body>
</html>
