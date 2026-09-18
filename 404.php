<?php
/**
 * 404.php — 404 Error Template
 * Pixel-perfect recreation of 404.html
 *
 * @package Altysier
 */

get_header();

// ── 404 content, managed from Altysier Settings → 404 Page ─────────────────────
$err_bg     = altysier_get_option( 'error_page_bg_image', 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?w=1800&q=75&auto=format&fit=crop' );
$err_title  = altysier_get_option( 'error_page_title', 'Destination Unavailable' );
$err_text   = altysier_get_option( 'error_page_text', 'The page you are attempting to access does not exist, has been relocated, or is temporarily unavailable across our network. Please use the navigation links below to redirect your query.' );
$err_btn1_label = altysier_get_option( 'error_page_btn1_label', 'Return to Home' );
$err_btn1_link  = altysier_get_option( 'error_page_btn1_link', home_url( '/' ) );
$err_btn2_label = altysier_get_option( 'error_page_btn2_label', 'Our Companies' );
$err_btn2_link  = altysier_get_option( 'error_page_btn2_link', home_url( '/#companies' ) );

$err_links = function_exists( 'get_field' ) ? get_field( 'error_page_links', 'option' ) : false;
if ( empty( $err_links ) ) {
	$err_links = array(
		array( 'title' => 'About Us', 'desc' => 'Heritage, values, leadership & vision', 'link' => home_url( '/about/' ) ),
		array( 'title' => 'Our Companies', 'desc' => '6 operating subsidiaries across trade & industry', 'link' => home_url( '/#companies' ) ),
		array( 'title' => 'CSR & Impact', 'desc' => 'Food security, jobs, mobility & sustainability', 'link' => home_url( '/csr/' ) ),
		array( 'title' => 'Contact Us', 'desc' => 'Dubai headquarters & Khartoum operations', 'link' => home_url( '/contact/' ) ),
	);
}
?>

<main id="main-content">
  <section class="error-hero">
    <div class="error-hero__bg" aria-hidden="true">
      <img src="<?php echo esc_url( $err_bg ); ?>" alt="" loading="eager">
    </div>
    <span class="section-watermark" aria-hidden="true" style="color: rgba(255,255,255,0.03);">NOT FOUND</span>

    <div class="container error-hero__container">
      <div class="error-hero__code">404</div>
      <h1 class="error-hero__title"><?php echo esc_html( $err_title ); ?></h1>
      <p class="error-hero__text"><?php echo esc_html( $err_text ); ?></p>

      <div class="error-hero__actions">
        <a href="<?php echo esc_url( $err_btn1_link ); ?>" class="btn _accent"><?php echo esc_html( $err_btn1_label ); ?></a>
        <a href="<?php echo esc_url( $err_btn2_link ); ?>" class="btn _white"><?php echo esc_html( $err_btn2_label ); ?></a>
      </div>

      <div class="error-links-grid">
        <?php foreach ( $err_links as $card ) : ?>
          <a href="<?php echo esc_url( $card['link'] ); ?>" class="error-link-card">
            <h3 class="error-link-card__title"><?php echo esc_html( $card['title'] ); ?> &rarr;</h3>
            <p class="error-link-card__desc"><?php echo esc_html( $card['desc'] ); ?></p>
          </a>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
</main>

<?php get_footer(); ?>
