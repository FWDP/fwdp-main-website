<?php
/**
 * Template part for displaying a message when no posts are found.
 *
 * @package FWDP
 */
?>

<section class="py-24 text-center">
  <div class="max-w-2xl mx-auto px-6">
    <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-100 mb-4">
      <?php esc_html_e( 'Nothing Found', 'fwdp' ); ?>
    </h1>

    <p class="text-gray-600 dark:text-gray-400 mb-8">
      <?php esc_html_e( 'Sorry, but nothing matched your search terms. Try again with some different keywords or browse our latest articles.', 'fwdp' ); ?>
    </p>

    <?php get_search_form(); ?>

    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="inline-block mt-6 bg-primary text-white font-medium px-5 py-3 rounded-lg hover:opacity-90 transition">
      <?php esc_html_e( 'Return Home', 'fwdp' ); ?>
    </a>
  </div>
</section>
