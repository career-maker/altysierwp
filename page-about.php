<?php
/**
 * Template Name: About Us
 *
 * Pixel-perfect recreation of about.html
 *
 * @package Altysier
 */

get_header();

$has_acf = function_exists( 'get_field' );
$gf      = function( $key, $default = '' ) use ( $has_acf ) {
	if ( ! $has_acf ) {
		return $default;
	}
	// A field explicitly cleared in the editor returns '' and must render as
	// empty, not fall back to the placeholder default. Only a field that has
	// never been set (false/null) should use the default.
	$val = get_field( $key );
	return ( false === $val || null === $val ) ? $default : $val;
};

// Banner fields
$banner_bg   = $gf( 'banner_bg_image', 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?w=1200&q=80&auto=format&fit=crop' );
$banner_mark = $gf( 'banner_watermark', 'ABOUT US' );
$banner_title= $gf( 'banner_title', 'Creating Opportunities Across Markets' );
$banner_sub  = $gf( 'banner_subtitle', 'Altysier Group brings together specialized businesses across international trade, industrial investment, manufacturing and distribution, supporting essential industries across international markets.' );
?>

<main id="main-content">

<!-- 01. INNER HERO -->
<section class="inner-hero" id="inner-hero" data-wp-section="page_banner">
  <div class="inner-hero__bg" aria-hidden="true" data-wp-field="banner_bg_image">
    <img class="section-photo" src="<?php echo esc_url( $banner_bg ); ?>" alt="" loading="eager" decoding="async">
    <div class="inner-hero__scrim"></div>
  </div>
  <span class="section-watermark" aria-hidden="true" data-wp-field="banner_watermark"><?php echo esc_html( $banner_mark ); ?></span>

  <div class="container inner-hero__container">
    <nav class="breadcrumb reveal" aria-label="Breadcrumbs" data-wp-field="breadcrumbs">
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'altysier' ); ?></a>
      <span class="breadcrumb__sep">/</span>
      <span aria-current="page" data-wp-field="breadcrumb_current"><?php esc_html_e( 'About Us', 'altysier' ); ?></span>
    </nav>
    <h1 class="inner-hero__title reveal" data-wp-field="banner_title"><?php echo esc_html( $banner_title ); ?></h1>
    <p class="inner-hero__text reveal" data-wp-field="banner_subtitle"><?php echo esc_html( $banner_sub ); ?></p>
  </div>
</section>

<!-- 02. WHO WE ARE -->
<section class="about-intro" id="who-we-are" data-wp-section="about_intro">
  <span class="section-watermark" aria-hidden="true" data-wp-field="intro_watermark"><?php echo esc_html( $gf( 'intro_watermark', 'WHO WE ARE' ) ); ?></span>
  <div class="container">
    <div class="about-intro__head">
      <p class="eyebrow reveal" data-wp-field="intro_eyebrow"><?php echo esc_html( $gf( 'intro_eyebrow', 'Who We Are' ) ); ?></p>
      <h2 class="group__title reveal" data-wp-field="intro_heading"><?php echo esc_html( $gf( 'intro_heading', 'A Trusted International Business Group' ) ); ?></h2>
      <span class="group__accent-line reveal" aria-hidden="true"></span>
    </div>

    <div class="about-intro__grid">
      <div class="about-intro__statement reveal" data-wp-field="intro_statement">
        <?php echo esc_html( $gf( 'intro_statement', 'A diversified group connecting specialized businesses across international trade, industrial investment, manufacturing and distribution.' ) ); ?>
      </div>
      <div class="about-intro__narrative reveal" data-wp-field="intro_narrative">
        <p><?php echo esc_html( $gf( 'intro_narrative', 'Altysier Group brings together specialized companies operating across international trade, industrial investment, manufacturing, and distribution. Our businesses support essential sectors including energy products, agriculture, food security, healthcare supplies, transportation, and industrial development. With strong market knowledge and reliable partnerships, we connect suppliers and buyers through transparent operations and consistent delivery standards.' ) ); ?></p>
      </div>
    </div>

    <div class="about-intro__photo-wrap reveal" data-wp-field="intro_photo">
      <img class="about-intro__photo" src="<?php echo esc_url( $gf( 'intro_photo', 'https://images.unsplash.com/photo-1541888946425-d81bb19240f5?w=1600&q=80&auto=format&fit=crop' ) ); ?>" alt="Altysier Group Global Operations" loading="lazy" decoding="async">
    </div>
  </div>
</section>

<!-- 03. WHAT DEFINES ALTYSIER -->
<section class="about-statement" id="what-defines-us" data-wp-section="about_statement">
  <span class="section-watermark" aria-hidden="true" data-wp-field="statement_watermark"><?php echo esc_html( $gf( 'statement_watermark', 'WHAT DEFINES US' ) ); ?></span>
  <div class="about-statement__bg" aria-hidden="true" data-wp-field="statement_bg_image">
    <img src="<?php echo esc_url( $gf( 'statement_bg_image', 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?w=1800&q=75&auto=format&fit=crop' ) ); ?>" alt="" loading="lazy" decoding="async">
    <div class="about-statement__scrim"></div>
  </div>
  <div class="container about-statement__container">
    <p class="eyebrow reveal" style="color: rgba(255,255,255,0.7);" data-wp-field="statement_eyebrow"><?php echo esc_html( $gf( 'statement_eyebrow', 'Our Foundation' ) ); ?></p>
    <h2 class="about-statement__heading reveal" data-wp-field="statement_heading"><?php echo esc_html( $gf( 'statement_heading', 'Established for Long-Term Growth' ) ); ?></h2>
    <p class="about-statement__text reveal" data-wp-field="statement_text"><?php echo esc_html( $gf( 'statement_text', 'Building sustainable trade relationships through integrity, consistency and operational excellence across global markets.' ) ); ?></p>
  </div>
</section>

<!-- 04. OUR CULTURE -->
<section class="about-culture" id="our-culture" data-wp-section="about_culture">
  <span class="section-watermark" aria-hidden="true" data-wp-field="culture_watermark"><?php echo esc_html( $gf( 'culture_watermark', 'OUR CULTURE' ) ); ?></span>
  <div class="container">
    <div class="about-culture__head">
      <p class="eyebrow reveal" data-wp-field="culture_eyebrow"><?php echo esc_html( $gf( 'culture_eyebrow', 'Our Culture & Values' ) ); ?></p>
      <h2 class="group__title reveal" data-wp-field="culture_heading"><?php echo esc_html( $gf( 'culture_heading', 'Built on Trust. Driven by Excellence.' ) ); ?></h2>
      <span class="group__accent-line reveal" aria-hidden="true"></span>
      <p class="group__intro reveal" data-wp-field="culture_intro"><?php echo esc_html( $gf( 'culture_intro', 'Our values define how we operate, govern our companies, and forge enduring partnerships worldwide.' ) ); ?></p>
    </div>

    <div class="about-culture__grid" data-wp-repeater="culture_values">
      <?php
      $default_culture_values = array(
        array( 'num' => '01', 'title' => 'Trust', 'text' => 'Building lasting partnerships grounded in transparency, commitment, and mutual respect across every transaction.' ),
        array( 'num' => '02', 'title' => 'Excellence', 'text' => 'Upholding the highest standards of operational precision, quality control, and technical execution in all ventures.' ),
        array( 'num' => '03', 'title' => 'Accountability', 'text' => 'Taking complete ownership of outcomes, adhering to international compliance, and delivering on every promise.' ),
        array( 'num' => '04', 'title' => 'Collaboration', 'text' => 'Connecting diverse capabilities and specialized industry teams to achieve shared, compounding success.' ),
        array( 'num' => '05', 'title' => 'Integrity', 'text' => 'Conducting ethical, responsible business across international jurisdictions, trade routes, and regulatory frameworks.' ),
        array( 'num' => '06', 'title' => 'Long-Term Value', 'text' => 'Focusing on generational stability, economic resilience, and sustainable development for stakeholders and communities.' ),
      );
      $culture_values = $default_culture_values;
      if ( $has_acf && have_rows( 'culture_values' ) ) {
        $rows = array();
        while ( have_rows( 'culture_values' ) ) { the_row(); $rows[] = array( 'num' => get_sub_field( 'num' ), 'title' => get_sub_field( 'title' ), 'text' => get_sub_field( 'text' ) ); }
        if ( ! empty( $rows ) ) { $culture_values = $rows; }
      }
      foreach ( $culture_values as $cv ) : ?>
      <div class="culture-card reveal" data-wp-item="culture_value">
        <span class="culture-card__num" data-wp-field="num"><?php echo esc_html( $cv['num'] ); ?></span>
        <h3 class="culture-card__title" data-wp-field="title"><?php echo esc_html( $cv['title'] ); ?></h3>
        <p class="culture-card__text" data-wp-field="text"><?php echo esc_html( $cv['text'] ); ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- 05. VISION / MISSION / MOTTO -->
<section class="about-vmm" id="vision-mission" data-wp-section="about_vmm">
  <span class="section-watermark" aria-hidden="true" data-wp-field="vmm_watermark"><?php echo esc_html( $gf( 'vmm_watermark', 'VISION & MISSION' ) ); ?></span>
  <div class="container">
    <div class="about-vmm__head">
      <p class="eyebrow reveal" data-wp-field="vmm_eyebrow"><?php echo esc_html( $gf( 'vmm_eyebrow', 'Our Purpose' ) ); ?></p>
      <h2 class="group__title reveal" data-wp-field="vmm_heading"><?php echo esc_html( $gf( 'vmm_heading', 'Guiding Principles for Enduring Impact' ) ); ?></h2>
      <span class="group__accent-line reveal" aria-hidden="true"></span>
      <p class="group__intro reveal" data-wp-field="vmm_intro"><?php echo esc_html( $gf( 'vmm_intro', 'The foundational pillars that steer Altysier Group\'s long-term commercial direction and institutional vision.' ) ); ?></p>
    </div>

    <div class="about-vmm__flow">
      <div class="vmm-stage reveal" data-wp-item="vision">
        <div class="vmm-stage__header">
          <span class="vmm-stage__num">01 / Strategic Vision</span>
          <h3 class="vmm-stage__name" data-wp-field="vision_title"><?php echo esc_html( $gf( 'vision_title', 'Vision' ) ); ?></h3>
        </div>
        <p class="vmm-stage__statement" data-wp-field="vision_statement"><?php echo esc_html( $gf( 'vision_statement', 'To be a trusted global business group delivering essential products and industrial value through reliable partnerships and responsible trade.' ) ); ?></p>
      </div>

      <div class="vmm-stage _accent reveal" data-wp-item="mission">
        <div class="vmm-stage__header">
          <span class="vmm-stage__num">02 / Core Purpose</span>
          <h3 class="vmm-stage__name" data-wp-field="mission_title"><?php echo esc_html( $gf( 'mission_title', 'Mission' ) ); ?></h3>
        </div>
        <p class="vmm-stage__statement" data-wp-field="mission_statement"><?php echo esc_html( $gf( 'mission_statement', 'To create long-term value by connecting markets, optimizing supply chains, and investing in industries that support economic stability and growth across regions.' ) ); ?></p>
      </div>

      <div class="vmm-stage reveal" data-wp-item="motto">
        <div class="vmm-stage__header">
          <span class="vmm-stage__num">03 / Operating Philosophy</span>
          <h3 class="vmm-stage__name" data-wp-field="motto_title"><?php echo esc_html( $gf( 'motto_title', 'Motto' ) ); ?></h3>
        </div>
        <p class="vmm-stage__statement" data-wp-field="motto_statement"><?php echo esc_html( $gf( 'motto_statement', 'We bridge industries and markets through smart trading and industrial investments.' ) ); ?></p>
      </div>
    </div>
  </div>
</section>

<!-- 06. OUR LEADERSHIP -->
<section class="about-leadership" id="leadership" data-wp-section="about_leadership">
  <span class="section-watermark" aria-hidden="true" data-wp-field="leadership_watermark"><?php echo esc_html( $gf( 'leadership_watermark', 'OUR LEADERSHIP' ) ); ?></span>
  <div class="container">
    <div class="about-leadership__head">
      <p class="eyebrow reveal" data-wp-field="leadership_eyebrow"><?php echo esc_html( $gf( 'leadership_eyebrow', 'Executive Leadership' ) ); ?></p>
      <h2 class="group__title reveal" data-wp-field="leadership_heading"><?php echo esc_html( $gf( 'leadership_heading', 'A Word From Our Leadership' ) ); ?></h2>
      <span class="group__accent-line reveal" aria-hidden="true"></span>
      <p class="group__intro leadership-intro reveal" data-wp-field="leadership_intro"><?php echo esc_html( $gf( 'leadership_intro', 'Guiding our diversified business portfolio with strategic focus, integrity, and long-term vision.' ) ); ?></p>
    </div>

    <div class="leadership-spread leadership-spread--noPhoto reveal">
      <div class="leadership-spread__sidebar">
        <div class="leadership-spread__meta">
          <h3 class="leadership-spread__name" data-wp-field="leader_name"><?php echo esc_html( $gf( 'leader_name', 'Omer Mahmoud Yousif Ali' ) ); ?></h3>
          <span class="leadership-spread__role" data-wp-field="leader_role"><?php echo esc_html( $gf( 'leader_role', 'Chief Executive Officer, Altysier Group' ) ); ?></span>
        </div>
        <div class="leadership-spread__divider" aria-hidden="true"></div>
        <?php
        $leader_values = ( $has_acf && have_rows( 'leader_values' ) ) ? array() : array( 'Trust', 'Integrity', 'Long-Term Growth' );
        if ( $has_acf && have_rows( 'leader_values' ) ) {
          while ( have_rows( 'leader_values' ) ) {
            the_row();
            $val = get_sub_field( 'value' );
            if ( $val ) { $leader_values[] = $val; }
          }
          if ( empty( $leader_values ) ) { $leader_values = array( 'Trust', 'Integrity', 'Long-Term Growth' ); }
        }
        ?>
        <ul class="leadership-spread__values">
          <?php foreach ( $leader_values as $value ) : ?>
            <li><?php echo esc_html( $value ); ?></li>
          <?php endforeach; ?>
        </ul>
        <img class="leadership-spread__watermark" src="<?php echo esc_url( get_theme_file_uri( 'assets/img/logo-icon.png' ) ); ?>" alt="" aria-hidden="true">
      </div>

      <div class="leadership-spread__content">
        <span class="leadership-spread__quote-mark" aria-hidden="true">&ldquo;</span>
        <blockquote class="leadership-spread__quote" data-wp-field="leader_quote">
          <?php
          $leader_quote_default = '<p>&#8220;At Altysier Group, we believe that strong businesses are built on trust, consistency, and responsibility. From our earliest operations, our focus has been on creating reliable trade channels that support essential industries and contribute to economic stability.</p><p>Global markets are constantly evolving, and our role is to adapt with integrity while maintaining the highest standards of quality and professionalism. Whether we are trading strategic commodities, investing in industrial growth, supporting transportation solutions, or manufacturing agricultural products, our objective remains the same: to deliver value that lasts.</p><p>We place great importance on long-term partnerships, transparent business practices, and operational excellence. Through our group companies, we continue to expand responsibly while supporting communities, industries, and supply chains across international markets.</p><p>We look forward to building meaningful collaborations and growing together.&#8221;</p>';
          echo wp_kses_post( $gf( 'leader_quote', $leader_quote_default ) );
          ?>
        </blockquote>
      </div>
    </div>
  </div>
</section>

<!-- 07. OUR BUSINESS ECOSYSTEM -->
<section class="about-ecosystem" id="ecosystem" data-wp-section="about_ecosystem">
  <span class="section-watermark" aria-hidden="true" data-wp-field="ecosystem_watermark"><?php echo esc_html( $gf( 'ecosystem_watermark', 'OUR ECOSYSTEM' ) ); ?></span>
  <div class="container">
    <div class="about-ecosystem__head">
      <p class="eyebrow reveal" data-wp-field="ecosystem_eyebrow"><?php echo esc_html( $gf( 'ecosystem_eyebrow', 'Group Capabilities' ) ); ?></p>
      <h2 class="group__title reveal" data-wp-field="ecosystem_heading"><?php echo esc_html( $gf( 'ecosystem_heading', 'One Group. Multiple Capabilities.' ) ); ?></h2>
      <span class="group__accent-line reveal" aria-hidden="true"></span>
      <p class="group__intro reveal" data-wp-field="ecosystem_intro"><?php echo esc_html( $gf( 'ecosystem_intro', 'Connecting specialized industry leaders under a shared institutional framework across essential sectors.' ) ); ?></p>
    </div>

    <div class="about-ecosystem__grid" data-wp-repeater="capabilities_list">
      <?php
      $default_capabilities = array(
        array( 'icon_key' => 'trade_ship', 'title' => 'International Trade' ),
        array( 'icon_key' => 'industry', 'title' => 'Industrial Investment' ),
        array( 'icon_key' => 'default', 'title' => 'Manufacturing' ),
        array( 'icon_key' => 'transport_truck', 'title' => 'Transportation & Logistics' ),
        array( 'icon_key' => 'feed', 'title' => 'Agriculture & Food Security' ),
        array( 'icon_key' => 'medical', 'title' => 'Healthcare & Medical Supplies' ),
        array( 'icon_key' => 'bajaj', 'title' => 'Mobility & Vehicle Distribution' ),
      );
      $capabilities = $default_capabilities;
      if ( $has_acf && have_rows( 'capabilities_list' ) ) {
        $rows = array();
        while ( have_rows( 'capabilities_list' ) ) { the_row(); $rows[] = array( 'icon_key' => get_sub_field( 'icon_key' ), 'title' => get_sub_field( 'title' ) ); }
        if ( ! empty( $rows ) ) { $capabilities = $rows; }
      }
      foreach ( $capabilities as $cap ) : ?>
      <div class="ecosystem-pill reveal" data-wp-item="capability">
        <div class="ecosystem-pill__icon">
          <?php echo altysier_get_sector_icon( $cap['icon_key'] ); ?>
        </div>
        <span class="ecosystem-pill__title" data-wp-field="title"><?php echo esc_html( $cap['title'] ); ?></span>
      </div>
      <?php endforeach; ?>
    </div>

    <div class="about-ecosystem__action reveal">
      <a href="<?php echo esc_url( home_url( '/#companies' ) ); ?>" class="btn _accent"><?php echo esc_html( $gf( 'ecosystem_action_label', 'Explore Our Companies' ) ); ?></a>
    </div>
  </div>
</section>

<!-- 08. ABOUT CTA -->
<section class="about-cta" id="contact" data-wp-section="call_to_action">
  <span class="section-watermark" aria-hidden="true" data-wp-field="cta_watermark"><?php echo esc_html( $gf( 'cta_watermark', 'PARTNERSHIP' ) ); ?></span>
  <div class="about-cta__bg" aria-hidden="true" data-wp-field="cta_bg_image">
    <img src="<?php echo esc_url( $gf( 'cta_bg_image', 'https://images.unsplash.com/photo-1494412574643-ff11b0a5c1c3?w=1800&q=75&auto=format&fit=crop' ) ); ?>" alt="" loading="lazy" decoding="async">
    <div class="about-cta__scrim"></div>
  </div>
  <div class="container about-cta__container">
    <p class="eyebrow reveal" style="color: rgba(255,255,255,0.7);" data-wp-field="cta_eyebrow"><?php echo esc_html( $gf( 'cta_eyebrow', 'Work With Us' ) ); ?></p>
    <h2 class="about-cta__title reveal" data-wp-field="cta_heading"><?php echo esc_html( $gf( 'cta_heading', 'Let\'s Build Strong Trade Partnerships Together.' ) ); ?></h2>
    <p class="about-cta__text reveal" data-wp-field="cta_text"><?php echo esc_html( $gf( 'cta_text', 'Whether you are seeking supply chain resilience, market expansion, or strategic co-investment, our leadership team is ready to connect.' ) ); ?></p>
    <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn _accent reveal" data-wp-field="cta_btn"><?php echo esc_html( $gf( 'cta_btn', 'Partner With Us' ) ); ?></a>
  </div>
</section>

</main>

<?php get_footer(); ?>
