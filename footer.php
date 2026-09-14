<?php
/**
 * footer.php — Altysier Group WordPress Theme
 * Pixel-perfect PHP recreation of parts/footer.html.
 *
 * @package Altysier
 */

$logo_url        = altysier_get_option( 'footer_logo', get_template_directory_uri() . '/assets/img/logo-icon.png' );
$home_url        = esc_url( home_url( '/' ) );
$footer_blurb    = altysier_get_option( 'footer_blurb', 'A diversified business group building long-term value across international trade, industry and mobility.' );
$footer_copy     = altysier_get_option( 'footer_copyright', 'Altysier Group. All rights reserved.' );
$social_linkedin = altysier_get_option( 'social_linkedin', '#' );
$social_instagram= altysier_get_option( 'social_instagram', '#' );
$social_twitter  = altysier_get_option( 'social_twitter', '#' );
$social_facebook = altysier_get_option( 'social_facebook', '#' );
$dubai_address   = altysier_get_option( 'dubai_address', 'Dubai, United Arab Emirates' );
$dubai_phone     = altysier_get_option( 'dubai_phone', '+971 4 268 0666' );
$dubai_whatsapp  = altysier_get_option( 'dubai_whatsapp', '+971 56 144 2525' );
$dubai_email     = altysier_get_option( 'dubai_email', 'info@altysier.com' );
$dubai_map_url   = altysier_get_option( 'dubai_map_url', 'https://maps.google.com/?q=Dubai,+United+Arab+Emirates' );
$saudi_address   = altysier_get_option( 'saudi_address', 'Riyadh, Saudi Arabia' );
$saudi_map_url   = altysier_get_option( 'saudi_map_url', 'https://maps.google.com/?q=Riyadh,+Saudi+Arabia' );
$khartoum_address= altysier_get_option( 'khartoum_address', 'Khartoum, Sudan' );
$khartoum_map_url= altysier_get_option( 'khartoum_map_url', 'https://maps.google.com/?q=Khartoum,+Sudan' );

// Query Companies CPT for footer list
$companies_query = new WP_Query( array(
	'post_type'      => 'company',
	'posts_per_page' => -1,
	'orderby'        => 'menu_order',
	'order'          => 'ASC',
	'post_status'    => 'publish',
) );
?>
</div><!-- #page -->

<footer class="footer" role="contentinfo">
  <div class="container">
    <div class="footer__top">

      <!-- Brand Column -->
      <div class="footer__brand-col">
        <a href="<?php echo $home_url; ?>" class="footer__logo">
          <img src="<?php echo esc_url( $logo_url ); ?>" alt="" class="footer__logo-icon" width="59" height="52">
          ALTYSIER<span>GROUP</span>
        </a>
        <p class="footer__blurb"><?php echo esc_html( $footer_blurb ); ?></p>
        <div class="footer__social">
          <a href="<?php echo esc_url( $social_linkedin ); ?>" aria-label="LinkedIn" class="footer__social-link" target="_blank" rel="noopener noreferrer">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2"/><line x1="7.5" y1="10" x2="7.5" y2="17"/><circle cx="7.5" cy="6.8" r="0.9" fill="currentColor" stroke="none"/><path d="M11.5 17v-4.2c0-1.5 1-2.3 2.2-2.3 1.2 0 2.1.8 2.1 2.3V17"/></svg>
          </a>
          <a href="<?php echo esc_url( $social_instagram ); ?>" aria-label="Instagram" class="footer__social-link" target="_blank" rel="noopener noreferrer">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17" cy="7" r="0.8" fill="currentColor" stroke="none"/></svg>
          </a>
          <a href="<?php echo esc_url( $social_twitter ); ?>" aria-label="X (Twitter)" class="footer__social-link" target="_blank" rel="noopener noreferrer">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"><line x1="5" y1="5" x2="19" y2="19"/><line x1="19" y1="5" x2="5" y2="19"/></svg>
          </a>
          <a href="<?php echo esc_url( $social_facebook ); ?>" aria-label="Facebook" class="footer__social-link" target="_blank" rel="noopener noreferrer">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M14 21v-7h2.5l.5-3H14V9c0-.9.3-1.5 1.7-1.5H17V4.8c-.3 0-1.2-.1-2.3-.1-2.3 0-3.9 1.4-3.9 4V11H8.5v3H11v7Z"/></svg>
          </a>
        </div>
      </div>

      <!-- Quick Links -->
      <div class="footer__col footer__accordion" data-open="false">
        <button type="button" class="footer__heading-btn" aria-expanded="false">
          <span class="footer__heading"><?php esc_html_e( 'Quick Links', 'altysier' ); ?></span>
          <svg class="footer__accordion-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg>
        </button>
        <div class="footer__panel">
          <div class="footer__content">
            <a href="<?php echo esc_url( home_url( '/about/' ) ); ?>"><?php esc_html_e( 'About Us', 'altysier' ); ?></a>
            <a href="<?php echo esc_url( home_url( '/csr/' ) ); ?>"><?php esc_html_e( 'CSR &amp; Sustainability', 'altysier' ); ?></a>
            <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Contact Us', 'altysier' ); ?></a>
            <a href="<?php echo esc_url( home_url( '/news/' ) ); ?>"><?php esc_html_e( 'News &amp; Insights', 'altysier' ); ?></a>
          </div>
        </div>
      </div>

      <!-- Group Companies -->
      <div class="footer__col footer__accordion" data-open="false">
        <button type="button" class="footer__heading-btn" aria-expanded="false">
          <span class="footer__heading"><?php esc_html_e( 'Group Companies', 'altysier' ); ?></span>
          <svg class="footer__accordion-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg>
        </button>
        <div class="footer__panel">
          <div class="footer__content">
            <?php if ( $companies_query->have_posts() ) :
              while ( $companies_query->have_posts() ) : $companies_query->the_post();
            ?>
              <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            <?php endwhile; wp_reset_postdata();
            else : ?>
              <a href="<?php echo esc_url( home_url( '/companies/altysier-general-trading/' ) ); ?>">ALTYSIER INTERNATIONAL GENERAL TRADING LLC</a>
              <a href="<?php echo esc_url( home_url( '/companies/altysier-advanced-business/' ) ); ?>">ALTYSIER INTERNATIONAL FOR ADVANCED BUSINESS CO LTD</a>
              <a href="<?php echo esc_url( home_url( '/companies/al-mutmeiza-industries/' ) ); ?>">AL MUTMEIZA FOR INDUSTRIES INVESTMENT CO LTD</a>
              <a href="<?php echo esc_url( home_url( '/companies/al-taysir-gulf/' ) ); ?>">AL TAYSIR AL MUTAMAYYIZA GULF CO</a>
              <a href="<?php echo esc_url( home_url( '/companies/haloub-feed-mill/' ) ); ?>">HALOUB FEED MILL FACTORY</a>
              <a href="<?php echo esc_url( home_url( '/companies/tasabih-services/' ) ); ?>">TASABIH FOR SERVICE AND TRANSPORTATION CO LTD.</a>
            <?php endif; ?>
          </div>
        </div>
      </div>

      <!-- Locations & Contact -->
      <div class="footer__col footer__accordion" data-open="false">
        <button type="button" class="footer__heading-btn" aria-expanded="false">
          <span class="footer__heading"><?php esc_html_e( 'Locations &amp; Contact', 'altysier' ); ?></span>
          <svg class="footer__accordion-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg>
        </button>
        <div class="footer__panel">
          <div class="footer__content">
            <a href="<?php echo esc_url( $dubai_map_url ); ?>" target="_blank" rel="noopener noreferrer" class="footer__map-link" title="<?php esc_attr_e( 'Open Dubai Office in Google Maps', 'altysier' ); ?>">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
              <span><?php echo esc_html( $dubai_address ); ?></span>
            </a>
            <a href="<?php echo esc_url( $saudi_map_url ); ?>" target="_blank" rel="noopener noreferrer" class="footer__map-link" title="<?php esc_attr_e( 'Open Saudi Arabia Office in Google Maps', 'altysier' ); ?>">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
              <span><?php echo esc_html( $saudi_address ); ?></span>
            </a>
            <a href="<?php echo esc_url( $khartoum_map_url ); ?>" target="_blank" rel="noopener noreferrer" class="footer__map-link" title="<?php esc_attr_e( 'Open Sudan Office in Google Maps', 'altysier' ); ?>">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
              <span><?php echo esc_html( $khartoum_address ); ?></span>
            </a>
            <a href="mailto:<?php echo esc_attr( $dubai_email ); ?>" class="footer__contact-link">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
              <span><?php echo esc_html( $dubai_email ); ?></span>
            </a>
            <a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $dubai_phone ) ); ?>" class="footer__contact-link">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
              <span><?php echo esc_html( $dubai_phone ); ?></span>
            </a>
            <?php if ( $dubai_whatsapp ) : ?>
            <a href="https://wa.me/<?php echo esc_attr( preg_replace( '/[^0-9]/', '', $dubai_whatsapp ) ); ?>" target="_blank" rel="noopener noreferrer" class="footer__contact-link">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg>
              <span><?php echo esc_html( $dubai_whatsapp ); ?> (WhatsApp)</span>
            </a>
            <?php endif; ?>
          </div>
        </div>
      </div>

    </div>

    <p class="footer__wordmark" aria-hidden="true">Altysier Group</p>

    <div class="footer__bottom">
      <span class="footer__copyrights">
        &copy; <span id="current-year"><?php echo esc_html( date( 'Y' ) ); ?></span> <?php echo esc_html( $footer_copy ); ?>
      </span>
      <span class="footer__tagline"><?php esc_html_e( 'A diversified business group.', 'altysier' ); ?></span>

      <div class="footer__legal-links">
        <a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>"><?php esc_html_e( 'Privacy Policy', 'altysier' ); ?></a>
        <a href="<?php echo esc_url( home_url( '/terms-and-conditions/' ) ); ?>"><?php esc_html_e( 'Terms &amp; Conditions', 'altysier' ); ?></a>
      </div>

      <span class="footer__credit">
        <?php esc_html_e( 'Designed By', 'altysier' ); ?>
        <a href="https://www.intersmart.ae/" target="_blank" rel="noopener noreferrer">InterSmart</a>
      </span>

      <button type="button" class="footer__up-btn" data-scroll-to="hero" aria-label="<?php esc_attr_e( 'Back to top', 'altysier' ); ?>">
        <span><?php esc_html_e( 'Up', 'altysier' ); ?></span>
        <span class="footer__up-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 19V5M5 12l7-7 7 7"/></svg>
        </span>
      </button>
    </div>
  </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
