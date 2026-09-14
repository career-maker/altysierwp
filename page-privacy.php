<?php
/**
 * Template Name: Privacy Policy
 *
 * Pixel-perfect recreation of privacy.html
 *
 * @package Altysier
 */

get_header();

$has_acf = function_exists( 'get_field' );
$gf      = function( $key, $default = '' ) use ( $has_acf ) {
	return $has_acf ? ( get_field( $key ) ?: $default ) : $default;
};

// Banner fields (shared "Page Banner / Inner Hero" field group)
$banner_bg    = $gf( 'banner_bg_image', 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?w=1200&q=80&auto=format&fit=crop' );
$banner_mark  = $gf( 'banner_watermark', 'PRIVACY' );
$banner_title = $gf( 'banner_title', 'Privacy Policy' );
$banner_sub   = $gf( 'banner_subtitle', 'How Altysier Group collects, protects, and handles personal and corporate information across its international operations.' );

// Legal meta
$effective_date = $gf( 'effective_date', 'January 1, 2026' );
$last_updated    = $gf( 'last_updated', 'September 2026' );
?>

<main id="main-content">

<!-- Canonical Inner Banner -->
<section class="inner-hero" id="privacy-hero" data-wp-section="page_banner">
  <div class="inner-hero__bg" aria-hidden="true" data-wp-field="banner_bg_image">
    <img class="section-photo" src="<?php echo esc_url( $banner_bg ); ?>" alt="" loading="eager" decoding="async">
    <div class="inner-hero__scrim"></div>
  </div>
  <span class="section-watermark" aria-hidden="true" data-wp-field="banner_watermark"><?php echo esc_html( $banner_mark ); ?></span>

  <div class="container inner-hero__container">
    <nav class="breadcrumb reveal" aria-label="Breadcrumbs">
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
      <span class="breadcrumb__sep">/</span>
      <span aria-current="page">Privacy Policy</span>
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
        <h2 class="legal-page__h2"><span class="legal-page__num">01.</span> Introduction &amp; Corporate Scope</h2>
        <p class="legal-page__p">Altysier Group and its constituent subsidiaries (including Altysier International General Trading LLC, Altysier International for Advanced Business Co LTD, Al Mutmeiza for Industries Investment Co LTD, Al Taysir Al Mutamayyiza Gulf Co, Haloub Feed Mill Factory, and TASABIH for Service and Transportation Co. Ltd., collectively referred to as &ldquo;Altysier Group&rdquo;, &ldquo;we&rdquo;, &ldquo;us&rdquo;, or &ldquo;our&rdquo;) respect your privacy and are committed to protecting the integrity, confidentiality, and security of any personal and corporate data entrusted to us.</p>
        <p class="legal-page__p">This Privacy Policy governs the collection, processing, and safeguarding of information obtained through this website (<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo esc_url( home_url( '/' ) ); ?></a>), corporate communications, business enquiry portals, and direct commercial relationships across our operating regions, including the United Arab Emirates, Saudi Arabia, Sudan, and international trade channels.</p>
      </div>

      <div class="legal-page__section reveal">
        <h2 class="legal-page__h2"><span class="legal-page__num">02.</span> Information We Collect</h2>
        <p class="legal-page__p">In the ordinary course of business, commercial facilitation, and digital interaction, Altysier Group may collect the following categories of information:</p>
        <ul class="legal-page__list">
          <li><strong>Commercial &amp; Business Inquiry Data:</strong> Contact details including your name, professional title, corporate affiliation, business email address, physical office location, and telephone or WhatsApp numbers when you submit an enquiry, request trading terms, or propose a business partnership.</li>
          <li><strong>Contractual &amp; Due Diligence Information:</strong> Corporate registration documents, tax identifiers, banking references, trade licenses, and authorized signatory details required for vendor onboarding, compliance review, and Know-Your-Customer (KYC) protocols under applicable international trade regulations.</li>
          <li><strong>Technical &amp; Usage Metadata:</strong> IP addresses, browser specifications, device identifiers, time-zone settings, operating system parameters, referral URLs, and interactions with pages on our website to ensure system security and optimal browsing performance.</li>
        </ul>
      </div>

      <div class="legal-page__section reveal">
        <h2 class="legal-page__h2"><span class="legal-page__num">03.</span> Purpose of Data Processing</h2>
        <p class="legal-page__p">We collect and process your information strictly for legitimate, defined business purposes:</p>
        <ul class="legal-page__list">
          <li>To respond promptly and professionally to your procurement, partnership, and trade enquiries.</li>
          <li>To facilitate cross-border supply chain operations, logistics coordination, customs clearance, and commercial contract execution.</li>
          <li>To fulfill regulatory, legal, and compliance obligations, including anti-money laundering (AML), export compliance, and sanction screening.</li>
          <li>To maintain website performance, prevent cyber threats or unauthorized access, and enhance our digital services.</li>
        </ul>
      </div>

      <div class="legal-page__section reveal">
        <h2 class="legal-page__h2"><span class="legal-page__num">04.</span> Data Sharing &amp; International Transfers</h2>
        <p class="legal-page__p">As an international holding enterprise with multi-regional trade routes, information collected may be shared internally among Altysier Group subsidiaries or with authorized third-party service providers (such as shipping lines, logistics forwarders, financial institutions, and legal counsel) solely to the extent necessary to execute contractual commitments.</p>
        <div class="legal-page__box">
          <p><strong>Strict Prohibition on Sale of Data:</strong> Altysier Group does not sell, rent, monetize, or disclose personal or commercial information to third-party marketing brokers or unauthorized external organizations under any circumstances.</p>
        </div>
        <p class="legal-page__p">When personal data is transferred across international jurisdictions, we implement standard contractual clauses and robust technical safeguards to ensure a level of protection consistent with applicable data protection legislation.</p>
      </div>

      <div class="legal-page__section reveal">
        <h2 class="legal-page__h2"><span class="legal-page__num">05.</span> Information Security &amp; Storage</h2>
        <p class="legal-page__p">We employ multi-layered administrative, technical, and physical security measures to safeguard all digital and physical records against unauthorized alteration, disclosure, accidental loss, or destruction. Website communications are protected by modern Transport Layer Security (TLS / SSL) encryption protocols.</p>
        <p class="legal-page__p">We retain personal and corporate information only for as long as necessary to fulfill the operational purposes for which it was gathered, or to comply with statutory accounting, tax, legal, and regulatory retention requirements.</p>
      </div>

      <div class="legal-page__section reveal">
        <h2 class="legal-page__h2"><span class="legal-page__num">06.</span> Your Rights as a Data Subject</h2>
        <p class="legal-page__p">Depending on your jurisdiction, you are entitled to exercise specific statutory rights regarding your personal information, including:</p>
        <ul class="legal-page__list">
          <li>The right to request access to the personal records we hold regarding you.</li>
          <li>The right to request prompt rectification of inaccurate, outdated, or incomplete data.</li>
          <li>The right to request the erasure or restriction of processing of your personal data where permitted by law.</li>
          <li>The right to withdraw consent to processing where consent was the initial legal basis.</li>
        </ul>
      </div>

      <div class="legal-page__section reveal">
        <h2 class="legal-page__h2"><span class="legal-page__num">07.</span> Contact &amp; Data Protection Officer</h2>
        <p class="legal-page__p">If you have any questions, comments, or formal requests concerning this Privacy Policy or our corporate data practices, please contact our legal and compliance department:</p>
        <div class="legal-page__box">
          <p><strong>Altysier Group — Legal &amp; Compliance Office</strong><br>
          Al Barsha, Dubai, United Arab Emirates<br>
          Email: <a href="mailto:info@altysier.com" style="color: var(--accent); font-weight: 600;">info@altysier.com</a><br>
          Phone: +971 4 268 0666 | WhatsApp: +971 56 144 2525</p>
        </div>
      </div>
    <?php endif; ?>
  </div>
</section>

</main>

<?php get_footer(); ?>
