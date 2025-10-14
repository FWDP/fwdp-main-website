<?php
/**
 * Template Part: Service Grid
 * Responsive "pyramid" layout with fixed 600x150 cards.
 */

$posts_per_page = $args['count'] ?? 6;
$title          = $args['title'] ?? 'Our Services';
$show_button    = $args['show_button'] ?? false;

$args = array(
    'post_type'      => 'services',
    'posts_per_page' => intval($posts_per_page),
    'orderby'        => 'menu_order',
    'order'          => 'ASC'
);
$query = new WP_Query($args);

if ($query->have_posts()) :
  $total = $query->post_count;

  // Determine how many cards go on top and bottom rows
  if ($total % 2 === 0) {
      $top_count = $total / 2;
      $bottom_count = $total / 2;
  } else {
      $top_count = ceil($total / 2);
      $bottom_count = $total - $top_count;
  }

  $index = 0;
?>

<section class="bg-gray-50 dark:bg-gray-900 py-12">
  <div class="max-w-screen-xl mx-auto px-4">
    <h1 class="text-4xl font-bold text-center text-gray-900 dark:text-white mb-10">
      <?= esc_html($title); ?>
    </h1>

    <!-- Top Row -->
    <div class="grid gap-6 
                sm:grid-cols-2 
                md:grid-cols-<?= ($top_count >= 3) ? 3 : $top_count; ?> 
                lg:grid-cols-<?= ($top_count >= 4) ? 4 : $top_count; ?> 
                justify-center mb-8">
      <?php while ($query->have_posts() && $index < $top_count) : $query->the_post(); $index++;
          $thumbnail = get_the_post_thumbnail_url(get_the_ID(), 'medium');
          $excerpt = get_the_excerpt();
      ?>
      <div class="flex flex-col items-center justify-center bg-white dark:bg-gray-800 
                  rounded-xl shadow hover:shadow-md transition text-center mx-auto py-8"
           style="width:400px; height:200px;">
        <div class="flex items-center justify-center gap-4 px-6">
          <?php if ($thumbnail): ?>
            <img src="<?= esc_url($thumbnail); ?>" alt="<?= esc_attr(get_the_title()); ?>" 
                 class="w-16 h-16 rounded-full object-cover">
          <?php endif; ?>
          <div class="text-left">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-1">
              <?= esc_html(get_the_title()); ?>
            </h3>
            <?php if ($excerpt): ?>
              <p class="text-gray-500 dark:text-gray-400 text-sm mb-1">
                <?= esc_html(wp_trim_words($excerpt, 20)); ?>
              </p>
            <?php endif; ?>
            <a href="<?= esc_url(get_permalink()); ?>" 
               class="inline-block text-blue-600 hover:underline text-sm font-medium">Learn More →</a>
          </div>
        </div>
      </div>
      <?php endwhile; ?>
    </div>

    <!-- Bottom Row -->
    <?php if ($bottom_count > 0): ?>
    <div class="grid gap-6 
                sm:grid-cols-<?= ($bottom_count == 1) ? 1 : 2; ?> 
                md:grid-cols-<?= ($bottom_count >= 3) ? 3 : $bottom_count; ?> 
                lg:grid-cols-<?= $bottom_count; ?> 
                justify-center place-items-center">
      <?php while ($query->have_posts()) : $query->the_post();
          $thumbnail = get_the_post_thumbnail_url(get_the_ID(), 'medium');
          $excerpt = get_the_excerpt();
      ?>
      <div class="flex flex-col items-center justify-center bg-white dark:bg-gray-800 
                  rounded-xl shadow hover:shadow-md transition text-center mx-auto py-8"
           style="width:400px; height:200px;">
        <div class="flex items-center justify-center gap-4 px-6">
          <?php if ($thumbnail): ?>
            <img src="<?= esc_url($thumbnail); ?>" alt="<?= esc_attr(get_the_title()); ?>" 
                 class="w-16 h-16 rounded-full object-cover">
          <?php endif; ?>
          <div class="text-left">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-1">
              <?= esc_html(get_the_title()); ?>
            </h3>
            <?php if ($excerpt): ?>
              <p class="text-gray-500 dark:text-gray-400 text-sm mb-1">
                <?= esc_html(wp_trim_words($excerpt, 20)); ?>
              </p>
            <?php endif; ?>
            <a href="<?= esc_url(get_permalink()); ?>" 
               class="inline-block text-blue-600 hover:underline text-sm font-medium">Learn More →</a>
          </div>
        </div>
      </div>
      <?php endwhile; ?>
    </div>
    <?php endif; ?>

    <?php if ($show_button): ?>
    <div class="text-center mt-10">
      <a href="<?= esc_url(get_post_type_archive_link('service')); ?>" 
         class="inline-block px-6 py-3 text-white bg-blue-600 hover:bg-blue-700 rounded-lg font-medium transition">
        View All Services
      </a>
    </div>
    <?php endif; ?>
  </div>
</section>

<?php wp_reset_postdata(); endif; ?>
