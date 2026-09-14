<?php
/**
 * 404.php — 404 Error Template
 * Pixel-perfect recreation of 404.html
 *
 * @package Altysier
 */

get_header(); ?>

<main id="main-content">
  <section class="error-hero">
    <div class="error-hero__bg" aria-hidden="true">
      <img src="https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?w=1800&q=75&auto=format&fit=crop" alt="" loading="eager">
    </div>
    <span class="section-watermark" aria-hidden="true" style="color: rgba(255,255,255,0.03);">NOT FOUND</span>

    <div class="container error-hero__container">
      <div class="error-hero__code">404</div>
      <h1 class="error-hero__title"><?php esc_html_e( 'Destination Unavailable', 'altysier' ); ?></h1>
      <p class="error-hero__text"><?php esc_html_e( 'The page you are attempting to access does not exist, has been relocated, or is temporarily unavailable across our network. Please use the navigation links below to redirect your query.', 'altysier' ); ?></p>

      <div class="error-hero__actions">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn _accent"><?php esc_html_e( 'Return to Home', 'altysier' ); ?></a>
        <a href="<?php echo esc_url( home_url( '/#companies' ) ); ?>" class="btn _white"><?php esc_html_e( 'Our Companies', 'altysier' ); ?></a>
      </div>

      <div class="error-links-grid">
        <a href="<?php echo esc_url( home_url( '/about/' ) ); ?>" class="error-link-card">
          <h3 class="error-link-card__title">About Us &rarr;</h3>
          <p class="error-link-card__desc">Heritage, values, leadership &amp; vision</p>
        </a>
        <a href="<?php echo esc_url( home_url( '/#companies' ) ); ?>" class="error-link-card">
          <h3 class="error-link-card__title">Our Companies &rarr;</h3>
          <p class="error-link-card__desc">6 operating subsidiaries across trade &amp; industry</p>
        </a>
        <a href="<?php echo esc_url( home_url( '/csr/' ) ); ?>" class="error-link-card">
          <h3 class="error-link-card__title">CSR &amp; Impact &rarr;</h3>
          <p class="error-link-card__desc">Food security, jobs, mobility &amp; sustainability</p>
        </a>
        <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="error-link-card">
          <h3 class="error-link-card__title">Contact Us &rarr;</h3>
          <p class="error-link-card__desc">Dubai headquarters &amp; Khartoum operations</p>
        </a>
      </div>
    </div>
  </section>
</main>

<?php get_footer(); ?>
