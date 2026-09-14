<?php
/**
 * page.php — Generic Page Template (fallback for all pages)
 * Renders banner + WordPress content editor output.
 *
 * @package Altysier
 */

get_header();
while ( have_posts() ) : the_post(); ?>

<main id="main-content">
  <?php get_template_part( 'template-parts/banner', 'inner' ); ?>

  <section class="page-content">
    <div class="container page-content__container">
      <?php the_content(); ?>
    </div>
  </section>
</main>

<?php endwhile; get_footer(); ?>
