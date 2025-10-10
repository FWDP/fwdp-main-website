<?php
/**
 * Template part for displaying posts in archive or blog listings
 *
 * @package FWDP
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('group bg-white dark:bg-gray-800 rounded-2xl shadow-sm hover:shadow-md transition overflow-hidden aos-init aos-animate'); ?> data-aos="fade-up">
  <?php if ( has_post_thumbnail() ) : ?>
    <a href="<?php the_permalink(); ?>" class="block overflow-hidden">
      <?php the_post_thumbnail('large', ['class' => 'w-full h-64 object-cover transform group-hover:scale-105 transition duration-300']); ?>
    </a>
  <?php endif; ?>

  <div class="p-6">
    <header class="mb-3">
      <div class="text-sm text-gray-500 dark:text-gray-400 mb-1">
        <?php echo esc_html( get_the_date() ); ?> · <?php the_author_posts_link(); ?>
      </div>
      <?php the_title( sprintf( '<h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100 hover:text-primary transition"><a href="%s">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
    </header>

    <div class="text-gray-600 dark:text-gray-400 mb-4"><?php the_excerpt(); ?></div>

    <footer>
      <a href="<?php the_permalink(); ?>" class="inline-block text-primary font-medium hover:underline">
        <?php esc_html_e( 'Read More →', 'fwdp' ); ?>
      </a>
    </footer>
  </div>
</article>