<?php get_header(); ?>

<div class="container mx-auto">
    <?php if (have_posts()) : while (have_posts()) : the_post();
        get_template_part('template-parts/content');
    endwhile; else : ?>
        <p><?php _e('No posts found.', 'fwdp'); ?></p>
    <?php endif; ?>
</div>

<?php get_footer(); ?>
