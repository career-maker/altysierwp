<?php
/**
 * Template Name: Terms of Use
 *
 * Pixel-perfect recreation of terms.html
 *
 * @package Altysier
 */

get_header();

$has_acf = function_exists( 'get_field' );
$gf      = function( $key, $default = '' ) use ( $has_acf ) {
	return $has_acf ? ( get_field( $key ) ?: $default ) : $default;
};

// Banner fields (shared "Page Banner / Inner Hero" field group)
$banner_bg    = $gf( 'banner_bg_image', 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?w=1200&q=80&auto=format&fit=crop' );
$banner_mark  = $gf( 'banner_watermark', 'TERMS' );
$banner_title = $gf( 'banner_title', 'Terms of Use' );
$banner_sub   = $gf( 'banner_subtitle', 'The legal framework, rights, and responsibilities governing interactions with Altysier Group and its digital platforms.' );

// Legal meta
$effective_date = $gf( 'effective_date', 'January 1, 2026' );
$last_updated    = $gf( 'last_updated', 'September 2026' );
?>

<main id="main-content">

<!-- Canonical Inner Banner -->
<section class="inner-hero" id="terms-hero" data-wp-section="page_banner">
  <div class="inner-hero__bg" aria-hidden="true" data-wp-field="banner_bg_image">
    <img class="section-photo" src="<?php echo esc_url( $banner_bg ); ?>" alt="" loading="eager" decoding="async">
    <div class="inner-hero__scrim"></div>
  </div>
  <span class="section-watermark" aria-hidden="true" data-wp-field="banner_watermark"><?php echo esc_html( $banner_mark ); ?></span>

  <div class="container inner-hero__container">
    <nav class="breadcrumb reveal" aria-label="Breadcrumbs">
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
      <span class="breadcrumb__sep">/</span>
      <span aria-current="page">Terms of Use</span>
    </nav>
    <h1 class="inner-hero__title reveal" data-wp-field="banner_title"><?php echo esc_html( $banner_title ); ?></h1>
    <p class="inner-hero__text reveal" data-wp-field="banner_subtitle"><?php echo esc_html( $banner_sub ); ?></p>
  </div>
</section>

<!-- Legal Content Body -->
<section class="legal-page" data-wp-section="legal_sections">
  <div class="container legal-page__container">
    <div class="legal-page__meta reveal" data-wp-field="effective_date,last_updated">
      <span>Effective Date: <strong><?php echo esc_html( $effective_date ); ?></strong></span>
      <span>•</span>
      <span>Last Updated: <strong><?php echo esc_html( $last_updated ); ?></strong></span>
    </div>

    <?php if ( $has_acf && have_rows( 'legal_sections' ) ) : ?>
      <?php $i = 0; while ( have_rows( 'legal_sections' ) ) : the_row(); $i++; ?>
        <div class="legal-page__section reveal">
          <h2 class="legal-page__h2"><span class="legal-page__num"><?php echo esc_html( sprintf( '%02d.', $i ) ); ?></span> <?php echo esc_html( get_sub_field( 'heading' ) ); ?></h2>
          <?php
          $body       = get_sub_field( 'body' );
          $box        = get_sub_field( 'highlight_box' );
          $body_after = get_sub_field( 'body_after' );
          ?>
          <?php if ( $body ) : ?>
            <div class="legal-page__wysiwyg"><?php echo wp_kses_post( $body ); ?></div>
          <?php endif; ?>
          <?php if ( $box ) : ?>
            <div class="legal-page__box"><?php echo wp_kses_post( $box ); ?></div>
          <?php endif; ?>
          <?php if ( $body_after ) : ?>
            <div class="legal-page__wysiwyg"><?php echo wp_kses_post( $body_after ); ?></div>
          <?php endif; ?>
        </div>
      <?php endwhile; ?>

    <?php else : ?>
      <!-- Fallback: original hardcoded copy (used only if ACF/PRO is inactive or fields are empty) -->
      <div class="legal-page__section reveal">
        <h2 class="legal-page__h2"><span class="legal-page__num">01.</span> Agreement &amp; Acceptance of Terms</h2>
        <p class="legal-page__p">By accessing, browsing, or utilizing this website (<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo esc_url( home_url( '/' ) ); ?></a>) or any associated corporate portals operated by Altysier Group and its operating subsidiaries (collectively, &ldquo;Altysier Group&rdquo;, &ldquo;we&rdquo;, &ldquo;us&rdquo;, or &ldquo;our&rdquo;), you acknowledge that you have read, understood, and agreed to be legally bound by these Terms of Use and our companion Privacy Policy.</p>
        <p class="legal-page__p">If you do not agree with any provision set forth herein, you must immediately cease navigating or using this website.</p>
      </div>

      <div class="legal-page__section reveal">
        <h2 class="legal-page__h2"><span class="legal-page__num">02.</span> Intellectual Property &amp; Brand Rights</h2>
        <p class="legal-page__p">All materials displayed or accessible across this website—including, but not limited to, corporate trademarks, trade names, logos, wordmarks, graphic emblems, visual designs, photography, editorial text, interactive interfaces, icons, and software code—are the exclusive intellectual property of Altysier Group or its respective subsidiary entities, protected under international copyright, trademark, and unfair competition laws.</p>
        <div class="legal-page__box">
          <p><strong>Reservation of Rights:</strong> No portion of this website may be reproduced, modified, distributed, framed, scraped, re-posted, or commercially exploited in any medium without prior express written consent from the executive management of Altysier Group.</p>
        </div>
      </div>

      <div class="legal-page__section reveal">
        <h2 class="legal-page__h2"><span class="legal-page__num">03.</span> Permitted Website Use &amp; User Conduct</h2>
        <p class="legal-page__p">You agree to use this platform exclusively for lawful commercial and informational purposes. You specifically agree not to:</p>
        <ul class="legal-page__list">
          <li>Transmit any unsolicited promotional, advertising, spam, or bulk commercial messages through our enquiry forms.</li>
          <li>Attempt to circumvent, probe, breach, or compromise the authentication, security, or network infrastructure of the site.</li>
          <li>Deploy any automated bots, spiders, scrapers, or software to crawl, index, or harvest data from our servers without written authorization.</li>
          <li>Impersonate any individual, corporate officer, enterprise partner, or representative of Altysier Group.</li>
        </ul>
      </div>

      <div class="legal-page__section reveal">
        <h2 class="legal-page__h2"><span class="legal-page__num">04.</span> Commercial Enquiries &amp; Trade Disclaimer</h2>
        <p class="legal-page__p">The materials, business sector descriptions, company profiles, and product overviews presented on this website are provided solely for general informational and corporate positioning purposes. Nothing on this website constitutes a binding commercial offer, formal commodity quotation, or financial guarantee.</p>
        <p class="legal-page__p">All commercial trading relationships, bulk commodity transactions, supply agreements, and joint-venture investments are subject to separate, formal, legally executed contracts, due diligence procedures, and applicable international trade laws (including Incoterms 2020 rules).</p>
      </div>

      <div class="legal-page__section reveal">
        <h2 class="legal-page__h2"><span class="legal-page__num">05.</span> Limitation of Liability</h2>
        <p class="legal-page__p">While Altysier Group makes reasonable efforts to ensure the accuracy, completeness, and timeliness of information on this website, the content is provided on an &ldquo;as is&rdquo; and &ldquo;as available&rdquo; basis without warranties of any kind, whether express or statutory.</p>
        <p class="legal-page__p">To the fullest extent permitted by applicable law, Altysier Group, its directors, officers, subsidiaries, and affiliates shall not be held liable for any direct, indirect, incidental, consequential, or punitive damages resulting from your access to, use of, or inability to use this platform or any materials contained herein.</p>
      </div>

      <div class="legal-page__section reveal">
        <h2 class="legal-page__h2"><span class="legal-page__num">06.</span> Third-Party Links &amp; External Services</h2>
        <p class="legal-page__p">Our website may feature links to external third-party resources (such as Google Maps or external social networks). These links are provided solely for user convenience. Altysier Group does not control, endorse, or accept responsibility for the availability, content, privacy standards, or practices of third-party platforms.</p>
      </div>

      <div class="legal-page__section reveal">
        <h2 class="legal-page__h2"><span class="legal-page__num">07.</span> Governing Law &amp; Jurisdiction</h2>
        <p class="legal-page__p">These Terms of Use, their validity, interpretation, and enforcement, shall be governed by and construed in accordance with the substantive laws of the <strong>United Arab Emirates</strong> as applicable in the Emirate of Dubai.</p>
        <p class="legal-page__p">Any dispute, controversy, or claim arising out of or relating to these Terms shall be subject to the exclusive jurisdiction of the competent courts located in Dubai, United Arab Emirates.</p>
      </div>

      <div class="legal-page__section reveal">
        <h2 class="legal-page__h2"><span class="legal-page__num">08.</span> Inquiries &amp; Legal Notices</h2>
        <p class="legal-page__p">For any legal enquiries, formal correspondence, or questions regarding these Terms of Use, please contact:</p>
        <div class="legal-page__box">
          <p><strong>Altysier Group — Executive Legal Counsel</strong><br>
          Al Barsha, Dubai, United Arab Emirates<br>
          Email: <a href="mailto:info@altysier.com" style="color: var(--accent); font-weight: 600;">info@altysier.com</a><br>
          Telephone: +971 4 268 0666 | WhatsApp: +971 56 144 2525</p>
        </div>
      </div>
    <?php endif; ?>
  </div>
</section>

</main>

<?php get_footer(); ?>
