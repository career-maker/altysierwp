<?php
/**
 * index.php — Main Template Fallback
 *
 * @package Altysier
 */

get_header(); ?>

<main id="main-content">
  <?php get_template_part( 'template-parts/banner', 'inner' ); ?>

  <section class="page-content" style="padding: 120rem 0 80rem;">
    <div class="container page-content__container">
      <?php
      if ( have_posts() ) :
        while ( have_posts() ) : the_post();
          the_content();
        endwhile;
      else :
        echo '<p>' . esc_html__( 'No content found.', 'altysier' ) . '</p>';
      endif;
      ?>
    </div>
  </section>
</main>

<?php get_footer(); ?>
