<?php
/**
 * Template part for displaying single posts (Enhanced)
 *
 * @package FWDP
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('prose prose-lg dark:prose-invert max-w-3xl mx-auto px-6 py-16 aos-init aos-animate'); ?> data-aos="fade-up">
  
  <header class="mb-8 text-center">
    <h1 class="text-4xl font-extrabold text-gray-900 dark:text-gray-100 mb-2">
      <?php the_title(); ?>
    </h1>
    <p class="text-sm text-gray-500 dark:text-gray-400">
      <?php echo esc_html( get_the_date() ); ?> · <?php the_author_posts_link(); ?>
    </p>
  </header>

  <?php if ( has_post_thumbnail() ) : ?>
    <div class="mb-10 rounded-2xl overflow-hidden shadow-lg">
      <?php the_post_thumbnail('full', ['class' => 'w-full h-auto object-cover']); ?>
    </div>
  <?php endif; ?>

  <div class="entry-content">
    <?php the_content(); ?>
  </div>

  <!-- Author Box -->
  <section class="mt-12 flex items-center gap-4 border-t border-gray-200 dark:border-gray-700 pt-6">
    <?php echo get_avatar( get_the_author_meta('ID'), 64, '', '', ['class' => 'rounded-full'] ); ?>
    <div>
      <h3 class="font-semibold text-gray-800 dark:text-gray-100"><?php the_author(); ?></h3>
      <p class="text-sm text-gray-600 dark:text-gray-400">
        <?php echo esc_html( get_the_author_meta('description') ); ?>
      </p>
    </div>
  </section>

  <!-- Post Navigation -->
  <nav class="mt-12 flex justify-between text-primary font-medium">
    <div><?php previous_post_link('%link', '← %title'); ?></div>
    <div><?php next_post_link('%link', '%title →'); ?></div>
  </nav>

  <!-- Related Posts -->
  <?php
  $categories = wp_get_post_categories( get_the_ID() );
  if ( $categories ) :
      $related = new WP_Query([
          'category__in'   => $categories,
          'post__not_in'   => [get_the_ID()],
          'posts_per_page' => 3,
      ]);
      if ( $related->have_posts() ) :
  ?>
  <section class="mt-16 border-t border-gray-200 dark:border-gray-700 pt-8">
    <h2 class="text-2xl font-bold mb-6 text-gray-800 dark:text-gray-100"><?php esc_html_e('Related Posts', 'fwdp'); ?></h2>
    <div class="grid md:grid-cols-3 gap-6">
      <?php while ( $related->have_posts() ) : $related->the_post(); ?>
        <a href="<?php the_permalink(); ?>" class="group block rounded-xl overflow-hidden shadow-sm hover:shadow-md transition">
          <?php if ( has_post_thumbnail() ) the_post_thumbnail('medium', ['class' => 'w-full h-40 object-cover group-hover:scale-105 transition']); ?>
          <div class="p-4">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 group-hover:text-primary transition"><?php the_title(); ?></h3>
          </div>
        </a>
      <?php endwhile; wp_reset_postdata(); ?>
    </div>
  </section>
  <?php endif; endif; ?>

  <?php if ( comments_open() || get_comments_number() ) : ?>
    <div class="mt-12"><?php comments_template(); ?></div>
  <?php endif; ?>
</article>
