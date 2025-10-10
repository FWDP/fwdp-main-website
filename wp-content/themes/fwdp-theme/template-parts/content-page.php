<?php
/**
 * Template part for displaying page content in page.php
 *
 * @package FWDP
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('prose prose-lg max-w-3xl mx-auto px-6 py-16'); ?>>
  <?php if ( has_post_thumbnail() ) : ?>
    <div class="mb-8 rounded-2xl overflow-hidden shadow-lg">
      <?php the_post_thumbnail( 'full', ['class' => 'w-full h-auto object-cover'] ); ?>
    </div>
  <?php endif; ?>

  <header class="mb-8">
    <h1 class="text-4xl font-extrabold text-gray-800 dark:text-gray-100">
      <?php the_title(); ?>
    </h1>
  </header>

  <div class="entry-content text-gray-700 dark:text-gray-300">
    <?php
    the_content();

    wp_link_pages([
      'before' => '<div class="page-links text-sm mt-8">' . esc_html__( 'Pages:', 'fwdp' ),
      'after'  => '</div>',
    ]);
    ?>
  </div>

  <?php if ( comments_open() || get_comments_number() ) : ?>
    <div class="mt-12">
      <?php comments_template(); ?>
    </div>
  <?php endif; ?>
</article>
