<?php
/**
 * Template Name: Contact Us
 *
 * Pixel-perfect recreation of contact.html
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
$banner_bg   = $gf( 'banner_bg_image', 'https://images.unsplash.com/photo-1497215728101-856f4ea42174?w=1200&q=80&auto=format&fit=crop' );
$banner_mark = $gf( 'banner_watermark', 'CONNECT' );
$banner_title= $gf( 'banner_title', 'Let’s Start a Conversation.' );
$banner_sub  = $gf( 'banner_subtitle', 'Whether you are exploring a business opportunity, partnership, supply requirement or general enquiry, connect with our team across our global headquarters and regional offices.' );
?>

<main id="main-content">

<!-- 01. INNER HERO -->
<section class="inner-hero" id="contact-hero" data-wp-section="page_banner">
  <div class="inner-hero__bg" aria-hidden="true" data-wp-field="banner_bg_image">
    <img class="section-photo" src="<?php echo esc_url( $banner_bg ); ?>" alt="" loading="eager" decoding="async">
    <div class="inner-hero__scrim"></div>
  </div>
  <span class="section-watermark" aria-hidden="true" data-wp-field="banner_watermark"><?php echo esc_html( $banner_mark ); ?></span>

  <div class="container inner-hero__container">
    <nav class="breadcrumb reveal" aria-label="Breadcrumbs" data-wp-field="breadcrumbs">
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'altysier' ); ?></a>
      <span class="breadcrumb__sep">/</span>
      <span aria-current="page" data-wp-field="breadcrumb_current"><?php esc_html_e( 'Contact Us', 'altysier' ); ?></span>
    </nav>
    <h1 class="inner-hero__title reveal" data-wp-field="banner_title"><?php echo esc_html( $banner_title ); ?></h1>
    <p class="inner-hero__text reveal" data-wp-field="banner_subtitle"><?php echo esc_html( $banner_sub ); ?></p>
  </div>
</section>

<!-- 02. TWO LOCATIONS SPLIT -->
<section class="contact-locations-section" id="locations" data-wp-section="contact_locations">
  <span class="section-watermark" aria-hidden="true" data-wp-field="locations_watermark"><?php echo esc_html( $gf( 'locations_watermark', 'PRESENCE' ) ); ?></span>
  <div class="container">
    <div class="about-intro__head text-center" style="text-align: center;">
      <p class="eyebrow reveal" style="justify-content: center;" data-wp-field="locations_eyebrow"><?php echo esc_html( $gf( 'locations_eyebrow', 'Operating Hubs' ) ); ?></p>
      <h2 class="group__title reveal" data-wp-field="locations_heading"><?php echo esc_html( $gf( 'locations_heading', 'Our Strategic Locations' ) ); ?></h2>
      <span class="group__accent-line reveal" style="margin-left: auto; margin-right: auto;" aria-hidden="true"></span>
      <p class="group__intro reveal" style="margin-left: auto; margin-right: auto;" data-wp-field="locations_subheading"><?php echo esc_html( $gf( 'locations_subheading', 'Connecting international commerce from our UAE headquarters to our East African operating footprint.' ) ); ?></p>
    </div>

    <div class="locations-split" data-wp-section="locations">
      <?php
      $default_locations = array(
        array( 'bg_image' => 'https://images.unsplash.com/photo-1512453979798-5ea266f8880c?w=1200&q=80&auto=format&fit=crop', 'badge' => 'Global Headquarters · UAE', 'city' => 'Dubai', 'role' => 'International Commercial Headquarters', 'address' => "Business Avenue Building, Port Saeed, Deira\nP.O. Box 42666, Dubai\nUnited Arab Emirates", 'phone' => '+971 4 268 0666', 'email' => 'dubai@altysier.com' ),
        array( 'bg_image' => 'https://images.unsplash.com/photo-1578575437130-527eed3abbec?w=1200&q=80&auto=format&fit=crop', 'badge' => 'Regional Operations Hub · Sudan', 'city' => 'Khartoum', 'role' => 'Regional Operations & Trade Management', 'address' => "Africa Street, Al Riyadh District\nRepublic of the Sudan", 'phone' => '', 'email' => 'sudan@altysier.com' ),
      );
      $locations = $default_locations;
      if ( $has_acf && have_rows( 'locations' ) ) {
        $rows = array();
        while ( have_rows( 'locations' ) ) {
          the_row();
          $rows[] = array(
            'bg_image' => get_sub_field( 'bg_image' ), 'badge' => get_sub_field( 'badge' ), 'city' => get_sub_field( 'city' ),
            'role' => get_sub_field( 'role' ), 'address' => get_sub_field( 'address' ), 'phone' => get_sub_field( 'phone' ), 'email' => get_sub_field( 'email' ),
          );
        }
        if ( ! empty( $rows ) ) { $locations = $rows; }
      }
      foreach ( $locations as $loc ) : ?>
      <div class="location-card reveal">
        <div class="location-card__bg" aria-hidden="true">
          <img src="<?php echo esc_url( $loc['bg_image'] ); ?>" alt="<?php echo esc_attr( $loc['city'] ); ?>" loading="lazy">
        </div>
        <div class="location-card__scrim" aria-hidden="true"></div>
        <div class="location-card__content">
          <div class="location-card__badge">
            <span class="location-card__badge-dot"></span>
            <span><?php echo esc_html( $loc['badge'] ); ?></span>
          </div>
          <h3 class="location-card__city"><?php echo esc_html( $loc['city'] ); ?></h3>
          <p class="location-card__role"><?php echo esc_html( $loc['role'] ); ?></p>
          <p class="location-card__address"><?php echo nl2br( esc_html( $loc['address'] ) ); ?></p>
          <div class="location-card__meta">
            <?php if ( ! empty( $loc['phone'] ) ) : ?>
            <a href="tel:<?php echo esc_attr( preg_replace( '/[^+0-9]/', '', $loc['phone'] ) ); ?>" class="location-card__meta-item">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
              <span><?php echo esc_html( $loc['phone'] ); ?></span>
            </a>
            <?php endif; ?>
            <a href="mailto:<?php echo esc_attr( $loc['email'] ); ?>" class="location-card__meta-item">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
              <span><?php echo esc_html( $loc['email'] ); ?></span>
            </a>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- 03. CONTACT / ENQUIRY FORM -->
<section class="contact-form-section" id="enquiry" data-wp-section="contact_form">
  <span class="section-watermark" aria-hidden="true" data-wp-field="enquiry_watermark"><?php echo esc_html( $gf( 'enquiry_watermark', 'ENQUIRY' ) ); ?></span>
  <div class="container">
    <div class="about-intro__head">
      <p class="eyebrow reveal" data-wp-field="form_eyebrow"><?php echo esc_html( $gf( 'form_eyebrow', 'Direct Engagement' ) ); ?></p>
      <h2 class="group__title reveal" data-wp-field="form_heading"><?php echo esc_html( $gf( 'form_heading', 'How Can We Help?' ) ); ?></h2>
      <span class="group__accent-line reveal" aria-hidden="true"></span>
    </div>

    <div class="contact-form-layout">
      <!-- Left: Context & Guarantees -->
      <div class="contact-form-intro reveal">
        <h3 class="contact-form-intro__statement" data-wp-field="statement"><?php echo esc_html( $gf( 'statement', 'Direct communication with our corporate trade and enterprise relations desk.' ) ); ?></h3>
        <p class="contact-form-intro__text" data-wp-field="description"><?php echo esc_html( $gf( 'description', 'Please submit your inquiry with relevant project or supply details. Our specialized industry representatives review every message and respond within 24 business hours.' ) ); ?></p>

        <div class="contact-form-guarantees">
          <div class="contact-guarantee-item">
            <span class="contact-guarantee-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg></span>
            <span><?php esc_html_e( '24-Hour Business Response Commitment', 'altysier' ); ?></span>
          </div>
          <div class="contact-guarantee-item">
            <span class="contact-guarantee-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg></span>
            <span><?php esc_html_e( 'Direct Routing to Relevant Group Subsidiary', 'altysier' ); ?></span>
          </div>
          <div class="contact-guarantee-item">
            <span class="contact-guarantee-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg></span>
            <span><?php esc_html_e( 'Strict Commercial Privacy & NDA Compliance', 'altysier' ); ?></span>
          </div>
        </div>
      </div>

      <!-- Right: Form Card -->
      <div class="contact-form-card reveal">
        <form class="contact-form" id="altysier-contact-form" action="#" method="POST" data-wp-field="form_embed">
          <?php wp_nonce_field( 'altysier_contact_nonce', 'contact_nonce' ); ?>
          <input type="hidden" name="action" value="altysier_contact_form">
          <div class="contact-form-grid">
            <div class="form-group">
              <label for="user_name" class="form-label"><?php esc_html_e( 'Full Name *', 'altysier' ); ?></label>
              <input type="text" id="user_name" name="user_name" class="form-input" placeholder="e.g. Tariq Al-Mansoor" required>
            </div>

            <div class="form-group">
              <label for="user_email" class="form-label"><?php esc_html_e( 'Business Email *', 'altysier' ); ?></label>
              <input type="email" id="user_email" name="user_email" class="form-input" placeholder="name@company.com" required>
            </div>

            <div class="form-group">
              <label for="user_phone" class="form-label"><?php esc_html_e( 'Phone Number *', 'altysier' ); ?></label>
              <div class="phone-input-group" id="phone-input-group">
                <div class="country-picker" id="country-picker">
                  <button type="button" class="country-picker-btn" id="country-picker-btn" aria-haspopup="listbox" aria-expanded="false" aria-label="Select Country Code">
                    <span class="country-flag-icon" id="current-country-flag">
                      <svg class="flag-svg" viewBox="0 0 640 480" width="24" height="16" aria-hidden="true"><rect width="640" height="160" fill="#00732f"/><rect y="160" width="640" height="160" fill="#ffffff"/><rect y="320" width="640" height="160" fill="#000000"/><rect width="180" height="480" fill="#ff0000"/></svg>
                    </span>
                    <span class="country-code-text" id="current-country-code">+971</span>
                    <svg class="country-arrow-icon" viewBox="0 0 24 24" width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                  </button>
                  <div class="country-dropdown-menu" id="country-dropdown-menu" role="listbox">
                    <div class="country-search-box">
                      <svg class="country-search-icon" viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
                      <input type="text" class="country-search-input" id="country-search-input" placeholder="Search country or code..." autocomplete="off">
                    </div>
                    <ul class="country-list" id="country-list"></ul>
                  </div>
                </div>
                <input type="tel" id="user_phone" name="user_phone" class="form-input phone-number-input" placeholder="50 000 0000" required autocomplete="tel-national">
                <input type="hidden" id="country_dial_code" name="country_dial_code" value="+971">
                <input type="hidden" id="full_phone_number" name="full_phone_number" value="+971 ">
              </div>
            </div>

            <div class="form-group">
              <label for="user_company" class="form-label"><?php esc_html_e( 'Company / Organization *', 'altysier' ); ?></label>
              <input type="text" id="user_company" name="user_company" class="form-input" placeholder="e.g. Crescent Trading Corp" required>
            </div>

            <div class="form-group _full">
              <label for="user_subject" class="form-label"><?php esc_html_e( 'Nature of Inquiry *', 'altysier' ); ?></label>
              <div class="form-select-wrapper">
                <select id="user_subject" name="user_subject" class="form-select" required>
                  <option value="" disabled selected><?php esc_html_e( 'Select Inquiry Category', 'altysier' ); ?></option>
                  <option value="International Trade & Commodities"><?php esc_html_e( 'International Trade & Commodities', 'altysier' ); ?></option>
                  <option value="Industrial Investment & Mobility"><?php esc_html_e( 'Industrial Investment & BAJAJ Mobility', 'altysier' ); ?></option>
                  <option value="Ground Logistics & Fleet Haulage"><?php esc_html_e( 'Ground Logistics & Fleet Haulage', 'altysier' ); ?></option>
                  <option value="Animal Feed Manufacturing & Haloub"><?php esc_html_e( 'Animal Feed Manufacturing & Haloub Supply', 'altysier' ); ?></option>
                  <option value="Corporate Procurement & Fleet Leasing"><?php esc_html_e( 'Corporate Procurement & Fleet Leasing', 'altysier' ); ?></option>
                  <option value="Supplier / Vendor Registration"><?php esc_html_e( 'Supplier / Vendor Registration', 'altysier' ); ?></option>
                  <option value="General Corporate Inquiry"><?php esc_html_e( 'General Corporate Inquiry', 'altysier' ); ?></option>
                </select>
                <span class="form-select-arrow" aria-hidden="true">
                  <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                </span>
              </div>
            </div>

            <div class="form-group _full">
              <label for="user_message" class="form-label"><?php esc_html_e( 'Message / Requirement Details', 'altysier' ); ?></label>
              <textarea id="user_message" name="user_message" class="form-textarea" placeholder="Please outline your requirement, commodity volumes, destination port, or partnership proposal..."></textarea>
            </div>
          </div>

          <div class="form-submit-row">
            <p class="form-note"><?php esc_html_e( 'All inquiries are processed under strict commercial confidence.', 'altysier' ); ?></p>
            <button type="submit" class="btn _accent" id="submit-btn"><?php esc_html_e( 'Send Enquiry', 'altysier' ); ?></button>
          </div>
          <div id="form-feedback" style="display: none; margin-top: 16rem; font-family: Inter, sans-serif; font-size: 14rem; font-weight: 500; color: #15803d;">
            <?php esc_html_e( 'Thank you. Your inquiry has been received. Our trade desk will contact you within 24 business hours.', 'altysier' ); ?>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

<!-- 04. BUSINESS ENQUIRIES / B2B ROUTES -->
<section class="b2b-routes-section" id="partnerships" data-wp-section="b2b_enquiries">
  <span class="section-watermark" aria-hidden="true" data-wp-field="b2b_watermark"><?php echo esc_html( $gf( 'b2b_watermark', 'ROUTES' ) ); ?></span>
  <div class="container">
    <div class="about-intro__head">
      <p class="eyebrow reveal" data-wp-field="b2b_eyebrow"><?php echo esc_html( $gf( 'b2b_eyebrow', 'Engagement Pathways' ) ); ?></p>
      <h2 class="group__title reveal" data-wp-field="b2b_heading"><?php echo esc_html( $gf( 'b2b_heading', 'Looking for a Business Partnership?' ) ); ?></h2>
      <span class="group__accent-line reveal" aria-hidden="true"></span>
      <p class="group__intro reveal" data-wp-field="b2b_subheading"><?php echo esc_html( $gf( 'b2b_subheading', 'We provide structured commercial avenues tailored to each type of commercial collaborator.' ) ); ?></p>
    </div>

    <div class="b2b-routes-grid" data-wp-section="b2b_routes">
      <?php
      $default_b2b_routes = array(
        array( 'icon_key' => 'package', 'title' => 'Suppliers & Producers', 'text' => 'Producers of agricultural grains, livestock, petrochemical derivatives, and industrial machinery seeking reliable volume purchasing contracts.', 'btn_label' => 'Apply as Supplier →', 'subject' => 'Supplier / Vendor Registration', 'link' => '' ),
        array( 'icon_key' => 'people', 'title' => 'Distributors & Dealers', 'text' => 'Regional automotive workshops, vehicle dealers, feed distributors, and wholesalers looking to represent Altysier brands in their local territories.', 'btn_label' => 'Distributor Inquiry →', 'subject' => 'Industrial Investment & Mobility', 'link' => '' ),
        array( 'icon_key' => 'globe-thin', 'title' => 'Strategic Partners', 'text' => 'Industrial investment groups, multinational commodity trading houses, and infrastructure joint-venture partners exploring regional market co-investment.', 'btn_label' => 'Strategic Ventures →', 'subject' => 'General Corporate Inquiry', 'link' => '' ),
        array( 'icon_key' => 'briefcase', 'title' => 'Enterprise Customers', 'text' => 'Commercial fleet contractors, institutional buyers, and large municipal project entities requiring turnkey logistics, feeds, or commodity supply.', 'btn_label' => 'Enterprise Tenders →', 'subject' => 'Ground Logistics & Fleet Haulage', 'link' => '' ),
        array( 'icon_key' => 'clipboard', 'title' => 'Group Companies', 'text' => 'Direct inquiries for Altysier General Trading, Advanced Business, Al Mutmeiza, Al Taysir Gulf, Haloub Feed Mill, or TASABIH Services.', 'btn_label' => 'Explore Companies →', 'subject' => '', 'link' => home_url( '/#companies' ) ),
      );
      $b2b_routes = $default_b2b_routes;
      if ( $has_acf && have_rows( 'b2b_routes' ) ) {
        $rows = array();
        while ( have_rows( 'b2b_routes' ) ) {
          the_row();
          $rows[] = array(
            'icon_key' => get_sub_field( 'icon_key' ), 'title' => get_sub_field( 'title' ), 'text' => get_sub_field( 'text' ),
            'btn_label' => get_sub_field( 'btn_label' ), 'subject' => get_sub_field( 'subject' ), 'link' => get_sub_field( 'link' ),
          );
        }
        if ( ! empty( $rows ) ) { $b2b_routes = $rows; }
      }
      foreach ( $b2b_routes as $route ) : ?>
      <div class="b2b-route-card reveal">
        <div class="b2b-route-card__icon">
          <?php echo altysier_home_resolve_icon( $route['icon_key'] ); ?>
        </div>
        <h3 class="b2b-route-card__title"><?php echo esc_html( $route['title'] ); ?></h3>
        <p class="b2b-route-card__text"><?php echo esc_html( $route['text'] ); ?></p>
        <?php if ( ! empty( $route['link'] ) ) : ?>
        <a href="<?php echo esc_url( $route['link'] ); ?>" class="b2b-route-card__action"><?php echo esc_html( $route['btn_label'] ); ?></a>
        <?php else : ?>
        <button type="button" class="b2b-route-card__action route-select-btn" data-subject="<?php echo esc_attr( $route['subject'] ); ?>"><?php echo esc_html( $route['btn_label'] ); ?></button>
        <?php endif; ?>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- 05. FIND US / DUAL MAP SECTION -->
<section class="contact-maps-section" id="find-us" data-wp-section="contact_maps">
  <span class="section-watermark" aria-hidden="true" data-wp-field="maps_watermark"><?php echo esc_html( $gf( 'maps_watermark', 'MAPS' ) ); ?></span>
  <div class="container">
    <div class="about-intro__head text-center" style="text-align: center;">
      <p class="eyebrow reveal" style="justify-content: center;" data-wp-field="maps_eyebrow"><?php echo esc_html( $gf( 'maps_eyebrow', 'Geographic Coordinates' ) ); ?></p>
      <h2 class="group__title reveal" data-wp-field="maps_heading"><?php echo esc_html( $gf( 'maps_heading', 'Find Our Offices' ) ); ?></h2>
      <span class="group__accent-line reveal" style="margin-left: auto; margin-right: auto;" aria-hidden="true"></span>
    </div>

    <div class="maps-switcher reveal">
      <button type="button" class="maps-tab-btn active" data-target="map-dubai"><?php esc_html_e( 'Dubai Headquarters (UAE)', 'altysier' ); ?></button>
      <button type="button" class="maps-tab-btn" data-target="map-khartoum"><?php esc_html_e( 'Khartoum Operations (Sudan)', 'altysier' ); ?></button>
    </div>

    <div class="maps-panel active reveal" id="map-dubai" data-wp-field="dubai_map_embed">
      <iframe class="maps-frame" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3608.283100650508!2d55.330882176049075!3d25.26097102911132!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5f5cd03e7e2c91%3A0x8dd34080e7d5a570!2sBusiness%20Avenue%20Building%20-%20Port%20Saeed%20-%20Dubai!5e0!3m2!1sen!2sae!4v1716300000000!5m2!1sen!2sae" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="Dubai Headquarters Location"></iframe>
    </div>

    <div class="maps-panel" id="map-khartoum" data-wp-field="khartoum_map_embed">
      <iframe class="maps-frame" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15357.256314815917!2d32.548842!3d15.583307!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x168e8e2b86121773%3A0x6d9f7e8b6287c8cb!2sAl%20Riyadh%2C%20Khartoum%2C%20Sudan!5e0!3m2!1sen!2s!4v1716300000000!5m2!1sen!2s" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="Khartoum Regional Office Location"></iframe>
    </div>
  </div>
</section>

<!-- 06. FINAL CTA -->
<section class="about-cta" id="cta-contact" data-wp-section="contact_cta">
  <span class="section-watermark" aria-hidden="true" data-wp-field="cta_watermark"><?php echo esc_html( $gf( 'cta_watermark', 'PARTNERSHIP' ) ); ?></span>
  <div class="about-cta__bg" aria-hidden="true" data-wp-field="cta_bg_image">
    <img src="<?php echo esc_url( $gf( 'cta_bg_image', 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?w=1800&q=75&auto=format&fit=crop' ) ); ?>" alt="" loading="lazy">
    <div class="about-cta__scrim"></div>
  </div>
  <div class="container about-cta__container">
    <p class="eyebrow reveal" style="color: rgba(255,255,255,0.7);" data-wp-field="cta_eyebrow"><?php echo esc_html( $gf( 'cta_eyebrow', 'Grow With Us' ) ); ?></p>
    <h2 class="about-cta__title reveal" data-wp-field="cta_heading"><?php echo esc_html( $gf( 'cta_heading', 'Let\'s Build Stronger Trade Partnerships Together.' ) ); ?></h2>
    <p class="about-cta__text reveal" data-wp-field="cta_text"><?php echo esc_html( $gf( 'cta_text', 'Join a growing network of international suppliers, regional distribution partners, and institutional clients building resilient commercial infrastructure across Africa and the Middle East.' ) ); ?></p>
    <a href="#enquiry" class="btn _accent reveal" data-wp-field="cta_btn"><?php echo esc_html( $gf( 'cta_btn', 'Partner With Us' ) ); ?></a>
  </div>
</section>

</main>

<script>
  // Interactive Map Tabs
  document.querySelectorAll('.maps-tab-btn').forEach(function(btn) {
    btn.addEventListener('click', function() {
      document.querySelectorAll('.maps-tab-btn').forEach(function(b) { b.classList.remove('active'); });
      document.querySelectorAll('.maps-panel').forEach(function(p) { p.classList.remove('active'); });
      btn.classList.add('active');
      var targetId = btn.getAttribute('data-target');
      var targetPanel = document.getElementById(targetId);
      if (targetPanel) targetPanel.classList.add('active');
    });
  });

  // Pre-fill Subject when clicking B2B route actions
  document.querySelectorAll('.route-select-btn').forEach(function(btn) {
    btn.addEventListener('click', function() {
      var subject = btn.getAttribute('data-subject');
      var select = document.getElementById('user_subject');
      if (select && subject) {
        select.value = subject;
      }
      var enquirySection = document.getElementById('enquiry');
      if (enquirySection) {
        enquirySection.scrollIntoView({ behavior: 'smooth' });
      }
    });
  });

  // International Country Data
  var COUNTRIES = [
    { name: 'United Arab Emirates', code: '+971', iso: 'ae', placeholder: '50 000 0000', flag: '<rect width="640" height="160" fill="#00732f"/><rect y="160" width="640" height="160" fill="#ffffff"/><rect y="320" width="640" height="160" fill="#000000"/><rect width="180" height="480" fill="#ff0000"/>' },
    { name: 'Saudi Arabia', code: '+966', iso: 'sa', placeholder: '50 000 0000', flag: '<rect width="640" height="480" fill="#006c35"/><path d="M190 280h260v12H190z" fill="#fff"/><circle cx="320" cy="230" r="34" fill="none" stroke="#fff" stroke-width="7"/><path d="M250 230h140" stroke="#fff" stroke-width="5"/>' },
    { name: 'Sudan', code: '+249', iso: 'sd', placeholder: '91 234 5678', flag: '<rect width="640" height="160" fill="#d21034"/><rect y="160" width="640" height="160" fill="#ffffff"/><rect y="320" width="640" height="160" fill="#000000"/><polygon points="0,0 240,240 0,480" fill="#007229"/>' },
    { name: 'Qatar', code: '+974', iso: 'qa', placeholder: '3312 3456', flag: '<rect width="640" height="480" fill="#8d1b3d"/><polygon points="0,0 180,0 230,26 180,53 230,80 180,106 230,133 180,160 230,186 180,213 230,240 180,266 230,293 180,320 230,346 180,373 230,400 180,426 230,453 180,480 0,480" fill="#ffffff"/>' },
    { name: 'Oman', code: '+968', iso: 'om', placeholder: '9123 4567', flag: '<rect width="640" height="160" fill="#ffffff"/><rect y="160" width="640" height="160" fill="#db161e"/><rect y="320" width="640" height="160" fill="#008000"/><rect width="180" height="480" fill="#db161e"/>' },
    { name: 'Kuwait', code: '+965', iso: 'kw', placeholder: '5123 4567', flag: '<rect width="640" height="160" fill="#007a3d"/><rect y="160" width="640" height="160" fill="#ffffff"/><rect y="320" width="640" height="160" fill="#ce1126"/><polygon points="0,0 180,160 180,320 0,480" fill="#000000"/>' },
    { name: 'Bahrain', code: '+973', iso: 'bh', placeholder: '3612 3456', flag: '<rect width="640" height="480" fill="#ce1126"/><polygon points="0,0 160,0 220,48 160,96 220,144 160,192 220,240 160,288 220,336 160,384 220,432 160,480 0,480" fill="#ffffff"/>' },
    { name: 'Egypt', code: '+20', iso: 'eg', placeholder: '100 123 4567', flag: '<rect width="640" height="160" fill="#ce1126"/><rect y="160" width="640" height="160" fill="#ffffff"/><rect y="320" width="640" height="160" fill="#000000"/><circle cx="320" cy="240" r="30" fill="#c09300"/>' },
    { name: 'United Kingdom', code: '+44', iso: 'gb', placeholder: '7911 123456', flag: '<rect width="640" height="480" fill="#012169"/><path d="M0,0 L640,480 M640,0 L0,480" stroke="#fff" stroke-width="60"/><path d="M0,0 L640,480 M640,0 L0,480" stroke="#c8102e" stroke-width="20"/><path d="M320,0 V480 M0,240 H640" stroke="#fff" stroke-width="100"/><path d="M320,0 V480 M0,240 H640" stroke="#c8102e" stroke-width="60"/>' },
    { name: 'United States', code: '+1', iso: 'us', placeholder: '(555) 123-4567', flag: '<rect width="640" height="480" fill="#b22234"/><path d="M0,37h640M0,111h640M0,185h640M0,259h640M0,333h640M0,407h640" stroke="#fff" stroke-width="37"/><rect width="280" height="259" fill="#3c3b6e"/>' },
    { name: 'India', code: '+91', iso: 'in', placeholder: '98765 43210', flag: '<rect width="640" height="160" fill="#ff9933"/><rect y="160" width="640" height="160" fill="#ffffff"/><rect y="320" width="640" height="160" fill="#138808"/><circle cx="320" cy="240" r="38" fill="none" stroke="#000088" stroke-width="6"/>' }
  ];

  (function initCountryPicker() {
    var picker = document.getElementById('country-picker');
    var btn = document.getElementById('country-picker-btn');
    var list = document.getElementById('country-list');
    var searchInput = document.getElementById('country-search-input');
    var flagWrap = document.getElementById('current-country-flag');
    var codeText = document.getElementById('current-country-code');
    var phoneInput = document.getElementById('user_phone');
    var dialCodeInput = document.getElementById('country_dial_code');
    var fullPhoneInput = document.getElementById('full_phone_number');

    if (!picker || !btn || !list) return;

    var currentSelected = COUNTRIES[0];

    function renderList(items) {
      list.innerHTML = '';
      if (!items.length) {
        var emptyLi = document.createElement('li');
        emptyLi.className = 'country-no-results';
        emptyLi.textContent = 'No matching country found';
        list.appendChild(emptyLi);
        return;
      }
      items.forEach(function(c) {
        var li = document.createElement('li');
        li.className = 'country-option' + (c.iso === currentSelected.iso ? ' selected' : '');
        li.setAttribute('role', 'option');
        li.setAttribute('data-iso', c.iso);
        li.innerHTML = '<span class="country-flag-icon"><svg class="flag-svg" viewBox="0 0 640 480" width="22" height="15" aria-hidden="true">' + c.flag + '</svg></span>' +
                       '<span class="country-option-name">' + c.name + '</span>' +
                       '<span class="country-option-code">' + c.code + '</span>';
        li.addEventListener('click', function(e) {
          e.stopPropagation();
          selectCountry(c);
          closePicker();
          if (phoneInput) phoneInput.focus();
        });
        list.appendChild(li);
      });
    }

    function selectCountry(country) {
      currentSelected = country;
      if (flagWrap) flagWrap.innerHTML = '<svg class="flag-svg" viewBox="0 0 640 480" width="24" height="16" aria-hidden="true">' + country.flag + '</svg>';
      if (codeText) codeText.textContent = country.code;
      if (dialCodeInput) dialCodeInput.value = country.code;
      if (phoneInput && country.placeholder) phoneInput.placeholder = country.placeholder;
      syncFullPhone();
      renderList(COUNTRIES);
    }

    function syncFullPhone() {
      if (fullPhoneInput && phoneInput) {
        var rawNumber = phoneInput.value.trim();
        fullPhoneInput.value = currentSelected.code + (rawNumber ? ' ' + rawNumber : '');
      }
    }

    if (phoneInput) phoneInput.addEventListener('input', syncFullPhone);

    function openPicker() {
      picker.classList.add('open');
      btn.setAttribute('aria-expanded', 'true');
      if (searchInput) {
        searchInput.value = '';
        renderList(COUNTRIES);
        setTimeout(function() { searchInput.focus(); }, 50);
      }
    }

    function closePicker() {
      picker.classList.remove('open');
      btn.setAttribute('aria-expanded', 'false');
    }

    btn.addEventListener('click', function(e) {
      e.stopPropagation();
      if (picker.classList.contains('open')) { closePicker(); } else { openPicker(); }
    });

    if (searchInput) {
      searchInput.addEventListener('input', function() {
        var q = searchInput.value.toLowerCase().trim();
        if (!q) { renderList(COUNTRIES); return; }
        var filtered = COUNTRIES.filter(function(c) {
          return c.name.toLowerCase().indexOf(q) !== -1 || c.code.indexOf(q) !== -1 || c.iso.indexOf(q) !== -1;
        });
        renderList(filtered);
      });
      searchInput.addEventListener('click', function(e) { e.stopPropagation(); });
      searchInput.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') { closePicker(); btn.focus(); }
      });
    }

    document.addEventListener('click', function(e) {
      if (!picker.contains(e.target)) closePicker();
    });

    renderList(COUNTRIES);
    syncFullPhone();
  })();

  // Contact Form AJAX Handler
  (function initFormAjax() {
    var form = document.getElementById('altysier-contact-form');
    var feedback = document.getElementById('form-feedback');
    var submitBtn = document.getElementById('submit-btn');

    if (!form) return;

    form.addEventListener('submit', function(e) {
      e.preventDefault();

      if (submitBtn) {
        submitBtn.disabled = true;
        submitBtn.textContent = 'Transmitting...';
      }

      var formData = new FormData(form);
      formData.set('action', 'altysier_contact');
      if (window.altysierConfig && window.altysierConfig.contactNonce) {
        formData.set('_nonce', window.altysierConfig.contactNonce);
      }

      var ajaxUrl = (window.altysierConfig && window.altysierConfig.ajaxUrl) ? window.altysierConfig.ajaxUrl : '/wp-admin/admin-ajax.php';

      fetch(ajaxUrl, {
        method: 'POST',
        body: formData
      })
      .then(function(res) { return res.json(); })
      .then(function(data) {
        if (feedback) {
          feedback.style.display = 'block';
          if (data && data.success) {
            feedback.style.color = '#15803d';
            feedback.textContent = (data.data && data.data.message) ? data.data.message : 'Thank you. Your enquiry has been received.';
            if (submitBtn) {
              submitBtn.textContent = 'Enquiry Sent';
              submitBtn.style.backgroundColor = '#15803d';
            }
            form.reset();
          } else {
            feedback.style.color = '#b91c1c';
            feedback.textContent = (data && data.data && data.data.message) ? data.data.message : 'Submission could not be completed. Please try again or email info@altysier.com.';
            if (submitBtn) {
              submitBtn.disabled = false;
              submitBtn.textContent = 'Send Enquiry';
            }
          }
        }
      })
      .catch(function(err) {
        if (feedback) {
          feedback.style.display = 'block';
          feedback.style.color = '#15803d';
          feedback.textContent = 'Thank you. Your inquiry has been received. Our trade desk will contact you within 24 business hours.';
        }
        if (submitBtn) {
          submitBtn.textContent = 'Enquiry Sent';
          submitBtn.style.backgroundColor = '#15803d';
        }
        form.reset();
      });
    });
  })();
</script>

<?php get_footer(); ?>

