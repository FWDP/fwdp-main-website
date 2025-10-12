<?php
// Template Part: Service Grid Section

$args = array(
    'post_type' => 'service',
    'posts_per_page' => 4,
    'orderby' => 'menu_order',
    'order' => 'ASC'
);

$query = new WP_Query($args);
?>

<?php if ($query->have_posts()) : ?>
<section class="bg-gray-50 dark:bg-gray-900 py-12">
  <div class="max-w-screen-xl mx-auto px-4">
    <h2 class="text-3xl font-bold text-center text-gray-900 dark:text-white mb-8">Our Services</h2>

    <div class="grid mb-8 border border-gray-200 rounded-lg shadow-xs dark:border-gray-700 md:mb-12 md:grid-cols-2 bg-white dark:bg-gray-800">
      <?php $i = 0; while ($query->have_posts()) : $query->the_post();
          $thumbnail = get_the_post_thumbnail_url(get_the_ID(), 'medium');
          $excerpt = get_the_excerpt();
          
          // Optional: dynamic border classes to mimic Flowbite testimonial layout
          $border_classes = '';
          if ($i === 0) $border_classes = 'md:rounded-ss-lg md:border-e border-b';
          elseif ($i === 1) $border_classes = 'md:rounded-se-lg border-b';
          elseif ($i === 2) $border_classes = 'md:rounded-es-lg md:border-b-0 md:border-e';
          elseif ($i === 3) $border_classes = 'md:rounded-se-lg';
          else $border_classes = 'border-b';
      ?>
      <figure class="flex flex-col items-center justify-center p-8 text-center bg-white border-gray-200 dark:bg-gray-800 dark:border-gray-700 <?= esc_attr($border_classes); ?>">
        <blockquote class="max-w-2xl mx-auto mb-4 text-gray-500 lg:mb-8 dark:text-gray-400">
          <h3 class="text-lg font-semibold text-gray-900 dark:text-white"><?= esc_html(get_the_title()); ?></h3>
          <?php if ($excerpt): ?>
            <p class="my-4"><?= esc_html(wp_trim_words($excerpt, 25)); ?></p>
          <?php endif; ?>
        </blockquote>
        <figcaption class="flex items-center justify-center">
          <?php if ($thumbnail): ?>
            <img class="rounded-full w-9 h-9" src="<?= esc_url($thumbnail); ?>" alt="<?= esc_attr(get_the_title()); ?>">
          <?php endif; ?>
          <div class="space-y-0.5 font-medium dark:text-white text-left rtl:text-right ms-3">
            <div><?= esc_html(get_the_title()); ?></div>
            <div class="text-sm text-gray-500 dark:text-gray-400">Learn more</div>
          </div>
        </figcaption>
      </figure>
      <?php $i++; endwhile; ?>
    </div>

    <div class="text-center mt-6">
      <a href="<?= esc_url(get_post_type_archive_link('service')); ?>" class="inline-block px-6 py-3 text-white bg-blue-600 hover:bg-blue-700 rounded-lg font-medium transition">
        View All Services
      </a>
    </div>
  </div>
</section>
<?php wp_reset_postdata(); endif; ?>