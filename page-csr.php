<?php
/**
 * Template Name: CSR & Sustainability
 *
 * Pixel-perfect recreation of csr.html
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
$banner_bg   = $gf( 'banner_bg_image', 'https://images.unsplash.com/photo-1521737711867-e3b97375f902?w=1200&q=80&auto=format&fit=crop' );
$banner_mark = $gf( 'banner_watermark', 'RESPONSIBILITY' );
$banner_title= $gf( 'banner_title', 'Responsibility Beyond Business' );
$banner_sub  = $gf( 'banner_subtitle', 'Altysier Group conducts business with an enduring sense of stewardship — fostering ethical trade, empowering local employment, securing essential food systems, and operating with continuous responsibility across regional markets.' );
?>

<main id="main-content">

<!-- 01. INNER HERO -->
<section class="inner-hero" id="csr-hero" data-wp-section="page_banner">
  <div class="inner-hero__bg" aria-hidden="true" data-wp-field="banner_bg_image">
    <img class="section-photo" src="<?php echo esc_url( $banner_bg ); ?>" alt="" loading="eager" decoding="async">
    <div class="inner-hero__scrim"></div>
  </div>
  <span class="section-watermark" aria-hidden="true" data-wp-field="banner_watermark"><?php echo esc_html( $banner_mark ); ?></span>

  <div class="container inner-hero__container">
    <nav class="breadcrumb reveal" aria-label="Breadcrumbs" data-wp-field="breadcrumbs">
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'altysier' ); ?></a>
      <span class="breadcrumb__sep">/</span>
      <span aria-current="page" data-wp-field="breadcrumb_current"><?php esc_html_e( 'CSR & Sustainability', 'altysier' ); ?></span>
    </nav>
    <h1 class="inner-hero__title reveal" data-wp-field="banner_title"><?php echo esc_html( $banner_title ); ?></h1>
    <p class="inner-hero__text reveal" data-wp-field="banner_subtitle"><?php echo esc_html( $banner_sub ); ?></p>
  </div>
</section>

<!-- 02. ETHICAL & TRANSPARENT BUSINESS -->
<section class="about-intro" id="ethical-business" data-wp-section="csr_ethical_business">
  <span class="section-watermark" aria-hidden="true" data-wp-field="ethical_watermark"><?php echo esc_html( $gf( 'ethical_watermark', 'ETHICS' ) ); ?></span>
  <div class="container">
    <div class="about-intro__head">
      <p class="eyebrow reveal" data-wp-field="ethical_eyebrow"><?php echo esc_html( $gf( 'ethical_eyebrow', 'Pillar 01 · Corporate Governance & Trust' ) ); ?></p>
      <h2 class="group__title reveal" data-wp-field="ethical_heading"><?php echo esc_html( $gf( 'ethical_heading', 'Doing Business the Right Way' ) ); ?></h2>
      <span class="group__accent-line reveal" aria-hidden="true"></span>
    </div>

    <div class="about-intro__grid">
      <div class="about-intro__statement reveal" data-wp-field="ethical_statement">
        <?php echo esc_html( $gf( 'ethical_statement', 'We believe lasting enterprise value is impossible without rigorous transparency, audited compliance, and deep mutual respect across all commercial relationships.' ) ); ?>
      </div>
      <div class="about-intro__narrative reveal" data-wp-field="ethical_narrative">
        <?php
        $ethical_narrative_default = '<p>In complex cross-border trade, integrity is not merely a policy — it is our operational lifeline. From commodity procurement to municipal infrastructure contracts, Altysier Group holds every employee, operating subsidiary, and commercial partner to clear ethical standards.</p><p>We maintain stringent anti-corruption practices, clear contract terms, fully verifiable customs declarations, and transparent pricing structures that safeguard both our partners and the communities we serve.</p>';
        echo wp_kses_post( $gf( 'ethical_narrative', $ethical_narrative_default ) );
        ?>
      </div>
    </div>

    <div class="csr-principles-grid" data-wp-repeater="ethical_principles">
      <?php
      $default_ethical_principles = array(
        array( 'number' => '01 / INTEGRITY', 'title' => 'Fair & Transparent Trading', 'text' => 'Clear contractual terms, zero hidden intermediary commissions, and open market rate disclosures across all import-export transactions.' ),
        array( 'number' => '02 / TRACEABILITY', 'title' => 'Responsible Sourcing', 'text' => 'Audited supply chains, verified direct grower and factory agreements, and adherence to legal origin certifications across commodities.' ),
        array( 'number' => '03 / COMPLIANCE', 'title' => 'Regulatory Adherence', 'text' => 'Comprehensive customs manifest verification, international sanctions screening, and full tax and banking compliance in all jurisdictions.' ),
        array( 'number' => '04 / PARTNERSHIP', 'title' => 'Respectful Partnerships', 'text' => 'Equitable financial terms and timely settlements with smallholder suppliers, regional logistics contractors, and institutional buyers.' ),
        array( 'number' => '05 / LEADERSHIP', 'title' => 'Accountable Governance', 'text' => 'Active executive oversight, clear lines of accountability across group subsidiaries, and zero tolerance for bribery or conflicts of interest.' ),
      );
      $ethical_principles = $default_ethical_principles;
      if ( $has_acf && have_rows( 'ethical_principles' ) ) {
        $rows = array();
        while ( have_rows( 'ethical_principles' ) ) { the_row(); $rows[] = array( 'number' => get_sub_field( 'number' ), 'title' => get_sub_field( 'title' ), 'text' => get_sub_field( 'text' ) ); }
        if ( ! empty( $rows ) ) { $ethical_principles = $rows; }
      }
      foreach ( $ethical_principles as $p ) : ?>
      <div class="csr-principle-card reveal" data-wp-item="principle">
        <span class="csr-principle-card__num" data-wp-field="number"><?php echo esc_html( $p['number'] ); ?></span>
        <h3 class="csr-principle-card__title" data-wp-field="title"><?php echo esc_html( $p['title'] ); ?></h3>
        <p class="csr-principle-card__text" data-wp-field="text"><?php echo esc_html( $p['text'] ); ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- 03. ECONOMIC GROWTH & EMPLOYMENT -->
<section class="csr-feature-section" id="economic-growth" data-wp-section="csr_economic_growth">
  <span class="section-watermark" aria-hidden="true" data-wp-field="economic_watermark"><?php echo esc_html( $gf( 'economic_watermark', 'GROWTH' ) ); ?></span>
  <div class="container">
    <div class="about-intro__head">
      <p class="eyebrow reveal" data-wp-field="economic_eyebrow"><?php echo esc_html( $gf( 'economic_eyebrow', 'Pillar 02 · Economic Empowerment & Jobs' ) ); ?></p>
      <h2 class="group__title reveal" data-wp-field="economic_heading"><?php echo esc_html( $gf( 'economic_heading', 'Creating Opportunity. Supporting Growth.' ) ); ?></h2>
      <span class="group__accent-line reveal" aria-hidden="true"></span>
    </div>

    <div class="csr-feature-grid">
      <div class="csr-feature__photo-wrap reveal" data-wp-field="economic_photo">
        <img class="csr-feature__photo" src="<?php echo esc_url( $gf( 'economic_photo', get_theme_file_uri( 'assets/img/companies/economic-empowerment-livelihoods.png' ) ) ); ?>" alt="Diverse Workforce Across Agriculture, Industry, Healthcare and Logistics" loading="lazy">
        <div class="csr-feature__scrim" aria-hidden="true"></div>
        <span class="csr-feature__badge" data-wp-field="economic_badge"><?php echo esc_html( $gf( 'economic_badge', 'Empowering Livelihoods' ) ); ?></span>
      </div>

      <div class="csr-feature__content reveal">
        <h3 class="csr-feature__statement" data-wp-field="economic_statement"><?php echo esc_html( $gf( 'economic_statement', 'We build commercial pathways that create real family incomes, foster self-employed entrepreneurs, and strengthen domestic business ecosystems.' ) ); ?></h3>
        <p class="csr-feature__lead" data-wp-field="economic_lead"><?php echo esc_html( $gf( 'economic_lead', 'Sustainable economic impact isn\'t abstract charity — it is built by giving individuals and enterprises the tools, transport, and capital access they need to thrive independently.' ) ); ?></p>

        <div class="csr-feature__list" data-wp-repeater="economic_points">
          <?php
          $default_economic_points = array(
            array( 'title' => 'Supporting Small Businesses', 'desc' => 'Flexible commercial credit terms, micro-distributor arrangements, and reliable inventory supply for local shops and traders.' ),
            array( 'title' => 'Mobility Solutions', 'desc' => 'Nationwide BAJAJ rickshaw distribution providing thousands of self-employed drivers with dependable daily passenger and cargo income.' ),
            array( 'title' => 'Skilled Job Creation', 'desc' => 'Full-time careers in mechanical assembly, specialized fleet operation, industrial grain processing, and logistics management.' ),
            array( 'title' => 'Strengthening Supply Chains', 'desc' => 'Connecting regional rural producers directly with high-volume urban markets, reducing waste and ensuring fair purchase prices.' ),
          );
          $economic_points = $default_economic_points;
          if ( $has_acf && have_rows( 'economic_points' ) ) {
            $rows = array();
            while ( have_rows( 'economic_points' ) ) { the_row(); $rows[] = array( 'title' => get_sub_field( 'title' ), 'desc' => get_sub_field( 'desc' ) ); }
            if ( ! empty( $rows ) ) { $economic_points = $rows; }
          }
          foreach ( $economic_points as $pt ) : ?>
          <div class="csr-feature__item" data-wp-item="point">
            <h4 class="csr-feature__item-title" data-wp-field="title"><?php echo esc_html( $pt['title'] ); ?></h4>
            <p class="csr-feature__item-desc" data-wp-field="desc"><?php echo esc_html( $pt['desc'] ); ?></p>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- 04. SUSTAINABLE AGRICULTURE & FOOD SECURITY -->
<section class="csr-feature-section" id="food-security" data-wp-section="csr_food_security">
  <span class="section-watermark" aria-hidden="true" data-wp-field="food_watermark"><?php echo esc_html( $gf( 'food_watermark', 'SECURITY' ) ); ?></span>
  <div class="container">
    <div class="about-intro__head">
      <p class="eyebrow reveal" data-wp-field="food_eyebrow"><?php echo esc_html( $gf( 'food_eyebrow', 'Pillar 03 · Agricultural Vitality' ) ); ?></p>
      <h2 class="group__title reveal" data-wp-field="food_heading"><?php echo esc_html( $gf( 'food_heading', 'Strengthening Food Security' ) ); ?></h2>
      <span class="group__accent-line reveal" aria-hidden="true"></span>
    </div>

    <div class="csr-feature-grid _reverse">
      <div class="csr-feature__photo-wrap reveal" data-wp-field="food_photo">
        <img class="csr-feature__photo" src="<?php echo esc_url( $gf( 'food_photo', get_theme_file_uri( 'assets/img/companies/haloub-facility-4.jpg' ) ) ); ?>" alt="Haloub Feed Mill Factory Aerial View" loading="lazy">
        <div class="csr-feature__scrim" aria-hidden="true"></div>
        <span class="csr-feature__badge" data-wp-field="food_badge"><?php echo esc_html( $gf( 'food_badge', 'Haloub Feed Mill Factory' ) ); ?></span>
      </div>

      <div class="csr-feature__content reveal">
        <h3 class="csr-feature__statement" data-wp-field="food_statement"><?php echo esc_html( $gf( 'food_statement', 'Through Haloub Feed Mill Factory, we directly safeguard regional livestock populations, support crop farmers, and stabilize essential food supplies.' ) ); ?></h3>
        <p class="csr-feature__lead" data-wp-field="food_lead"><?php echo esc_html( $gf( 'food_lead', 'Food security in developing markets requires modern local manufacturing. By producing balanced animal feed locally, Altysier Group shields regional farmers from unpredictable global supply disruptions while enhancing rural nutritional security.' ) ); ?></p>

        <div class="csr-feature__list" data-wp-repeater="food_points">
          <?php
          $default_food_points = array(
            array( 'title' => 'Scientific Animal Feed Production', 'desc' => 'Computerized batching and precision nutrient formulas that significantly lower mortality rates in poultry and dairy farming.' ),
            array( 'title' => 'Livestock Health & Welfare', 'desc' => 'High-protein feed ratios that strengthen cattle immunity, accelerate healthy growth, and support sustainable livestock breeding.' ),
            array( 'title' => 'Agricultural Off-Take Support', 'desc' => 'Guaranteed bulk crop purchasing from domestic farmers for sorghum, maize, and bran, infusing capital directly into rural farms.' ),
            array( 'title' => 'Regional Food Supply Stability', 'desc' => 'Consistent local meat, egg, and dairy production, protecting families from external commodity price volatility.' ),
          );
          $food_points = $default_food_points;
          if ( $has_acf && have_rows( 'food_points' ) ) {
            $rows = array();
            while ( have_rows( 'food_points' ) ) { the_row(); $rows[] = array( 'title' => get_sub_field( 'title' ), 'desc' => get_sub_field( 'desc' ) ); }
            if ( ! empty( $rows ) ) { $food_points = $rows; }
          }
          foreach ( $food_points as $pt ) : ?>
          <div class="csr-feature__item" data-wp-item="point">
            <h4 class="csr-feature__item-title" data-wp-field="title"><?php echo esc_html( $pt['title'] ); ?></h4>
            <p class="csr-feature__item-desc" data-wp-field="desc"><?php echo esc_html( $pt['desc'] ); ?></p>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- 05. ENVIRONMENTAL RESPONSIBILITY -->
<section class="csr-feature-section" id="environmental-responsibility" data-wp-section="csr_environmental">
  <span class="section-watermark" aria-hidden="true" data-wp-field="env_watermark"><?php echo esc_html( $gf( 'env_watermark', 'OPERATIONS' ) ); ?></span>
  <div class="container">
    <div class="about-intro__head">
      <p class="eyebrow reveal" data-wp-field="env_eyebrow"><?php echo esc_html( $gf( 'env_eyebrow', 'Pillar 04 · Operational Footprint' ) ); ?></p>
      <h2 class="group__title reveal" data-wp-field="env_heading"><?php echo esc_html( $gf( 'env_heading', 'Operating With Greater Responsibility' ) ); ?></h2>
      <span class="group__accent-line reveal" aria-hidden="true"></span>
      <p class="group__intro reveal" data-wp-field="env_subheading"><?php echo esc_html( $gf( 'env_subheading', 'Practical, measurable operational stewardship embedded into our haulage fleets, factories, and facilities.' ) ); ?></p>
    </div>

    <div class="csr-env-grid" data-wp-repeater="env_initiatives">
      <?php
      $default_env_initiatives = array(
        array( 'photo' => 'https://images.unsplash.com/photo-1494412574643-ff11b0a5c1c3?w=800&q=80&auto=format&fit=crop', 'number' => '01 / LOGISTICS', 'title' => 'Optimized Logistics & Transport', 'desc' => 'Route optimization software, backhaul load matching to eliminate empty trips, and regular engine maintenance that curbs fuel consumption across Al Taysir Gulf and TASABIH fleets.' ),
        array( 'photo' => 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?w=800&q=80&auto=format&fit=crop', 'number' => '02 / MANUFACTURING', 'title' => 'Clean Plant Operations', 'desc' => 'Closed-loop cyclone filtration systems to trap fine organic dust, high-efficiency electric milling motors, and strict spill prevention protocols at our processing plants.' ),
        array( 'photo' => 'https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?w=800&q=80&auto=format&fit=crop', 'number' => '03 / RESOURCES', 'title' => 'Responsible Resource Use', 'desc' => 'Reusable wooden pallets, bulk recyclable packaging, energy audits across logistics warehouses, and minimized water use in factory cleaning cycles.' ),
        array( 'photo' => 'https://images.unsplash.com/photo-1619642751034-765dfdf7c58e?w=800&q=80&auto=format&fit=crop', 'number' => '04 / WORKSHOPS', 'title' => 'Safe Waste Handling', 'desc' => 'Certified disposal of automotive lubricants, battery recycling programs, and metal scrap recovery across our BAJAJ assembly and repair workshops.' ),
      );
      $env_initiatives = $default_env_initiatives;
      if ( $has_acf && have_rows( 'env_initiatives' ) ) {
        $rows = array();
        while ( have_rows( 'env_initiatives' ) ) { the_row(); $rows[] = array( 'photo' => get_sub_field( 'photo' ), 'number' => get_sub_field( 'number' ), 'title' => get_sub_field( 'title' ), 'desc' => get_sub_field( 'desc' ) ); }
        if ( ! empty( $rows ) ) { $env_initiatives = $rows; }
      }
      foreach ( $env_initiatives as $init ) : ?>
      <div class="csr-env-card reveal" data-wp-item="initiative">
        <div class="csr-env-card__photo-wrap" data-wp-field="photo">
          <img class="csr-env-card__photo" src="<?php echo esc_url( $init['photo'] ); ?>" alt="<?php echo esc_attr( $init['title'] ); ?>" loading="lazy">
        </div>
        <div class="csr-env-card__body">
          <span class="csr-env-card__num" data-wp-field="number"><?php echo esc_html( $init['number'] ); ?></span>
          <h3 class="csr-env-card__title" data-wp-field="title"><?php echo esc_html( $init['title'] ); ?></h3>
          <p class="csr-env-card__desc" data-wp-field="desc"><?php echo esc_html( $init['desc'] ); ?></p>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- 06. IMPACT ACROSS THE GROUP -->
<section class="csr-feature-section" id="group-impact" data-wp-section="csr_group_impact">
  <span class="section-watermark" aria-hidden="true" data-wp-field="impact_watermark"><?php echo esc_html( $gf( 'impact_watermark', 'IMPACT' ) ); ?></span>
  <div class="container">
    <div class="about-intro__head text-center" style="text-align: center;">
      <p class="eyebrow reveal" style="justify-content: center;" data-wp-field="impact_eyebrow"><?php echo esc_html( $gf( 'impact_eyebrow', 'Integrated Group Impact' ) ); ?></p>
      <h2 class="group__title reveal" data-wp-field="impact_heading"><?php echo esc_html( $gf( 'impact_heading', 'How Altysier Businesses Create Lasting Impact' ) ); ?></h2>
      <span class="group__accent-line reveal" style="margin-left: auto; margin-right: auto;" aria-hidden="true"></span>
      <p class="group__intro reveal" style="margin-left: auto; margin-right: auto;" data-wp-field="impact_subheading"><?php echo esc_html( $gf( 'impact_subheading', 'Each operating company translates our CSR commitments into everyday commercial reality.' ) ); ?></p>
    </div>

    <div class="csr-impact-grid" data-wp-repeater="group_impact_cards">
      <?php
      $default_impact_cards = array(
        array( 'source' => 'Trade', 'target' => 'Employment', 'title' => 'Altysier General Trading & Advanced Business', 'text' => 'Open cross-border supply lines provide vital commerce, pharmaceutical access, and commercial livelihoods across dynamic emerging markets.', 'link' => home_url( '/companies/altysier-general-trading/' ), 'link_label' => 'Explore Company →' ),
        array( 'source' => 'Manufacturing', 'target' => 'Agriculture', 'title' => 'Haloub Feed Mill Factory', 'text' => 'Processes domestic harvests into clinical livestock nutrition, strengthening animal yields and bolstering national food security.', 'link' => home_url( '/companies/haloub-feed-mill/' ), 'link_label' => 'Explore Company →' ),
        array( 'source' => 'Logistics', 'target' => 'Supply Chains', 'title' => 'Al Taysir Gulf & TASABIH Services', 'text' => 'Heavy vehicle fleets provide dependable logistics for municipal works, humanitarian supply transfers, and vital domestic transit lines.', 'link' => home_url( '/companies/al-taysir-gulf/' ), 'link_label' => 'Explore Company →' ),
        array( 'source' => 'Mobility', 'target' => 'Small Businesses', 'title' => 'Al Mutmeiza for Industries', 'text' => 'Authorized BAJAJ distribution equips thousands of independent drivers with sustainable livelihoods, parts access, and micro-enterprise capital.', 'link' => home_url( '/companies/al-mutmeiza-industries/' ), 'link_label' => 'Explore Company →' ),
      );
      $impact_cards = $default_impact_cards;
      if ( $has_acf && have_rows( 'group_impact_cards' ) ) {
        $rows = array();
        while ( have_rows( 'group_impact_cards' ) ) {
          the_row();
          $rows[] = array(
            'source' => get_sub_field( 'source' ), 'target' => get_sub_field( 'target' ),
            'title' => get_sub_field( 'title' ), 'text' => get_sub_field( 'text' ),
            'link' => get_sub_field( 'link' ), 'link_label' => get_sub_field( 'link_label' ) ?: 'Explore Company →',
          );
        }
        if ( ! empty( $rows ) ) { $impact_cards = $rows; }
      }
      foreach ( $impact_cards as $card ) : ?>
      <div class="csr-impact-card reveal" data-wp-item="impact_card">
        <div class="csr-impact-card__flow">
          <span class="csr-impact-card__source" data-wp-field="source"><?php echo esc_html( $card['source'] ); ?></span>
          <span class="csr-impact-card__arrow" aria-hidden="true">&rarr;</span>
          <span class="csr-impact-card__target" data-wp-field="target"><?php echo esc_html( $card['target'] ); ?></span>
        </div>
        <h3 class="csr-impact-card__title" data-wp-field="title"><?php echo esc_html( $card['title'] ); ?></h3>
        <p class="csr-impact-card__text" data-wp-field="text"><?php echo esc_html( $card['text'] ); ?></p>
        <a href="<?php echo esc_url( $card['link'] ); ?>" class="csr-impact-card__link" data-wp-field="link"><?php echo esc_html( $card['link_label'] ); ?></a>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- 07. CTA -->
<section class="about-cta" id="contact" data-wp-section="csr_cta">
  <span class="section-watermark" aria-hidden="true" data-wp-field="cta_watermark"><?php echo esc_html( $gf( 'cta_watermark', 'PARTNERSHIP' ) ); ?></span>
  <div class="about-cta__bg" aria-hidden="true" data-wp-field="cta_bg_image">
    <img src="<?php echo esc_url( $gf( 'cta_bg_image', 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?w=1800&q=75&auto=format&fit=crop' ) ); ?>" alt="" loading="lazy">
    <div class="about-cta__scrim"></div>
  </div>
  <div class="container about-cta__container">
    <p class="eyebrow reveal" style="color: rgba(255,255,255,0.7);" data-wp-field="cta_eyebrow"><?php echo esc_html( $gf( 'cta_eyebrow', 'Partner With Purpose' ) ); ?></p>
    <h2 class="about-cta__title reveal" data-wp-field="cta_heading"><?php echo esc_html( $gf( 'cta_heading', 'Building a More Responsible Future Together.' ) ); ?></h2>
    <p class="about-cta__text reveal" data-wp-field="cta_text"><?php echo esc_html( $gf( 'cta_text', 'Whether you are an agricultural producer, commercial buyer, trade partner, or community stakeholder, we welcome collaborative partnerships that create lasting economic and social value.' ) ); ?></p>
    <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn _accent reveal" data-wp-field="cta_btn"><?php echo esc_html( $gf( 'cta_btn', 'Connect With Us' ) ); ?></a>
  </div>
</section>

</main>

<?php get_footer(); ?>
