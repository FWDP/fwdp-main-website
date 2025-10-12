<?php
get_header();
while ( have_posts() ) :
  the_post();
  if (is_front_page('home')){
    get_template_part( 'template-parts/content', 'home' );
  } else {
    get_template_part( 'template-parts/content', 'page' );
  }
endwhile;
get_footer();
