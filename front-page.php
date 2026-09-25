<?php
/**
 * front-page.php — Altysier Group Homepage Template
 * Pixel-perfect PHP recreation of index.html (all 7 sections).
 *
 * @package Altysier
 */

get_header();

// ── ACF helpers ────────────────────────────────────────────────────────────────
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

// Hero ACF fields
$hero_bg       = $gf( 'hero_bg_image', 'https://images.unsplash.com/photo-1494412574643-ff11b0a5c1c3?w=1400&q=80&auto=format&fit=crop' );
$hero_bg_video = $gf( 'hero_bg_video', '' );
$hero_eyebrow  = $gf( 'hero_eyebrow', 'Altysier Group' );
$hero_h1_l1    = $gf( 'hero_heading_line1', 'Building Businesses.' );
$hero_h1_l2    = $gf( 'hero_heading_line2', 'Connecting Markets.' );
$hero_h1_l3    = $gf( 'hero_heading_line3', 'Creating Long-Term Value.' );
$hero_body     = $gf( 'hero_body', 'A diversified business group operating across international trade, industrial investment, manufacturing, transportation, agriculture, food security, healthcare and mobility.' );
$hero_btn1_lbl = $gf( 'hero_btn1_label', 'Explore Our Group' );
$hero_btn1_lnk = $gf( 'hero_btn1_link', home_url( '/about/' ) );
$hero_btn2_lbl = $gf( 'hero_btn2_label', 'Partner With Us' );
$hero_btn2_lnk = $gf( 'hero_btn2_link', home_url( '/contact/' ) );

// Group section
$group_eyebrow    = $gf( 'group_eyebrow', 'About Altysier Group' );
$group_heading    = $gf( 'group_heading', 'One Group. Multiple Businesses.' );
$group_statement  = $gf( 'group_statement', 'A diversified portfolio of businesses working across essential industries and international markets to create enduring value.' );
$group_sectors_eyebrow = $gf( 'group_sectors_eyebrow', 'Our Sectors' );
$group_sec_intro  = $gf( 'group_sectors_intro', 'Seven sectors, one connected group. Explore our comprehensive capabilities.' );
$group_act_label  = $gf( 'group_actions_label', 'Learn About Our Group →' );
$group_act_link   = $gf( 'group_actions_link', '/about/' );

$default_sector_cards = array(
	array( 'photo' => 'https://images.unsplash.com/photo-1494412574643-ff11b0a5c1c3?w=500&q=65&auto=format&fit=crop', 'icon_key' => 'trade_ship', 'title' => 'International Trade', 'text' => 'Sourcing, distributing and connecting essential goods across regional and international markets, connecting suppliers with demand where it matters most.', 'tag' => 'Global Sourcing' ),
	array( 'photo' => get_template_directory_uri() . '/assets/img/companies/industrial-investment-sector.jpg', 'icon_key' => 'industry', 'title' => 'Industrial Investment', 'text' => 'Structuring investment across industrial ventures, building capability in sectors that anchor long-term regional growth.', 'tag' => 'Strategic Capital' ),
	array( 'photo' => get_template_directory_uri() . '/assets/img/companies/haloub-facility-1.jpg', 'icon_key' => 'default', 'title' => 'Manufacturing', 'text' => 'Investing in and operating manufacturing capacity that strengthens regional supply chains and industrial output.', 'tag' => 'Industrial Capacity' ),
	array( 'photo' => 'https://images.unsplash.com/photo-1601584115197-04ecc0da31d7?w=500&q=65&auto=format&fit=crop', 'icon_key' => 'transport_truck', 'title' => 'Transportation & Logistics', 'text' => 'Moving goods and people reliably across the network, from freight logistics to integrated transport services.', 'tag' => 'Supply Chain' ),
	array( 'photo' => 'https://images.unsplash.com/photo-1625246333195-78d9c38ad449?w=500&q=65&auto=format&fit=crop', 'icon_key' => 'feed', 'title' => 'Agriculture & Food Security', 'text' => 'Producing quality animal feed at scale, supporting food security and agricultural resilience across the region.', 'tag' => 'Feed & Agritech' ),
	array( 'photo' => get_template_directory_uri() . '/assets/img/companies/healthcare-medical-sector.jpg', 'icon_key' => 'medical', 'title' => 'Healthcare & Medical Supplies', 'text' => 'Supporting regional healthcare supply chains with reliable sourcing and distribution of medical supplies.', 'tag' => 'Medical Distribution' ),
	array( 'photo' => get_template_directory_uri() . '/assets/img/companies/bajaj-vehicle-sector.jpg', 'icon_key' => 'bajaj', 'title' => 'Mobility & Vehicle Distribution', 'text' => 'Connecting markets with reliable vehicle distribution and mobility solutions across the region.', 'tag' => 'Mobility Solutions' ),
);
$sector_rows = $default_sector_cards;
if ( $has_acf && have_rows( 'sector_cards' ) ) {
	$rows = array();
	while ( have_rows( 'sector_cards' ) ) {
		the_row();
		$rows[] = array(
			'photo'    => get_sub_field( 'photo' ),
			'icon_key' => get_sub_field( 'icon_key' ),
			'title'    => get_sub_field( 'title' ),
			'text'     => get_sub_field( 'text' ),
			'tag'      => get_sub_field( 'tag' ),
		);
	}
	if ( ! empty( $rows ) ) { $sector_rows = $rows; }
}

// Journey ("How We Create Value") section
$journey_eyebrow = $gf( 'journey_eyebrow', 'From Opportunity to Impact' );
$journey_heading = $gf( 'journey_heading', 'How We Create Value' );
$journey_intro   = $gf( 'journey_intro', 'A disciplined, end-to-end framework transforming high-potential opportunities into resilient enterprises and long-term economic value.' );
$journey_act_lbl = $gf( 'journey_actions_label', 'Explore Group Capabilities →' );
$journey_act_lnk = $gf( 'journey_actions_link', '/about/' );

$default_journey_steps = array(
	array( 'image' => 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?w=280&q=65&auto=format&fit=crop', 'title' => 'Opportunity Identification', 'text' => 'Spotting scalable supply and infrastructure gaps across regional and global markets.', 'phase_label' => 'Phase 01' ),
	array( 'image' => 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?w=280&q=65&auto=format&fit=crop', 'title' => 'Strategic Capital', 'text' => 'Deploying capital and resources where sustainable returns and market impact meet.', 'phase_label' => 'Phase 02' ),
	array( 'image' => 'https://images.unsplash.com/photo-1553413077-190dd305871c?w=280&q=65&auto=format&fit=crop', 'title' => 'Operational Excellence', 'text' => 'Executing with precision across manufacturing, fleet logistics and distribution.', 'phase_label' => 'Phase 03' ),
	array( 'image' => 'https://images.unsplash.com/photo-1578575437130-527eed3abbec?w=280&q=65&auto=format&fit=crop', 'title' => 'Market Integration', 'text' => 'Connecting producers, distributors and consumers seamlessly across borders.', 'phase_label' => 'Phase 04' ),
	array( 'image' => 'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?w=280&q=65&auto=format&fit=crop', 'title' => 'Sustainable Value', 'text' => 'Delivering enduring growth for stakeholders, global partners and communities.', 'phase_label' => 'Phase 05' ),
);

// "The Businesses Behind the Group" section header
$biz_eyebrow = $gf( 'businesses_eyebrow', 'Our Group Companies' );
$biz_heading = $gf( 'businesses_heading', 'The Businesses Behind the Group' );
$biz_intro   = $gf( 'businesses_intro', 'A diversified group serving essential industries.' );

// Reach section
$reach_eyebrow  = $gf( 'reach_eyebrow', 'Our Reach &amp; Impact' );
$reach_heading  = $gf( 'reach_heading', 'Connecting Opportunities Across Markets' );
$reach_intro    = $gf( 'reach_intro', 'Our reach is measured not only by where we operate, but by the sustainable value we create across global markets and communities.' );
$reach_act_lbl  = $gf( 'reach_action_label', 'Explore Our Impact →' );
$reach_act_lnk  = $gf( 'reach_action_link', '/csr/' );

$default_reach_stats = array(
	array( 'number' => '12+', 'label' => 'Countries' ),
	array( 'number' => '18+', 'label' => 'Markets' ),
	array( 'number' => '150+', 'label' => 'Partners' ),
	array( 'number' => '07+', 'label' => 'Sectors' ),
);
$default_reach_pillars = array(
	array( 'icon_key' => 'feed', 'title' => 'Food Security', 'text' => 'Agriculture, livestock and essential commodities.' ),
	array( 'icon_key' => 'economic-growth', 'title' => 'Economic Development', 'text' => 'Trade, employment and industry growth.' ),
	array( 'icon_key' => 'people', 'title' => 'Communities', 'text' => 'Responsible business and community contribution.' ),
	array( 'icon_key' => 'shield-check', 'title' => 'Responsible Operations', 'text' => 'Long-term and sustainable business practices.' ),
);

// "Why Trust Us" section
$why_eyebrow  = $gf( 'why_eyebrow', 'Why Trust Us' );
$why_heading  = $gf( 'why_heading', 'Built on Trust. Driven by Capability.' );
$why_intro    = $gf( 'why_intro', 'Delivering excellence through disciplined execution, deep market knowledge, and enduring strategic partnerships.' );
$why_act_lbl  = $gf( 'why_actions_label', 'Why Trust Altysier Group →' );
$why_act_lnk  = $gf( 'why_actions_link', '/about/' );

$default_why_principles = array(
	array( 'icon_key' => 'globe-alt', 'heading' => 'International Perspective', 'text' => 'Connecting opportunities across markets.' ),
	array( 'icon_key' => 'filing-cabinet', 'heading' => 'Diversified Capabilities', 'text' => 'Multiple industries and specialized businesses.' ),
	array( 'icon_key' => 'shield-check', 'heading' => 'Reliable Operations', 'text' => 'Focused on quality and execution.' ),
	array( 'icon_key' => 'handshake', 'heading' => 'Strategic Partnerships', 'text' => 'Building long-term business relationships.' ),
	array( 'icon_key' => 'economic-growth', 'heading' => 'Growth Mindset', 'text' => 'Continuously expanding capabilities and opportunities.' ),
);

$default_testimonials = array(
	array( 'quote' => 'Altysier Group has been an exceptional partner in helping us expand our presence in new markets. Their professionalism, disciplined execution, and deep market understanding are truly commendable.', 'author' => 'Sarah Johnson', 'role' => 'CEO', 'company' => 'Skyward Global', 'image' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=400&q=80&auto=format&fit=crop' ),
	array( 'quote' => 'Their diversified expertise and unwavering commitment to operational excellence ensured the smooth rollout of our regional supply chain transformation. We look forward to many more milestones together.', 'author' => 'Michael Thomas', 'role' => 'Operations Director', 'company' => 'Meditrade Solutions', 'image' => 'https://images.unsplash.com/photo-1560250097-0b93528c311a?w=400&q=80&auto=format&fit=crop' ),
	array( 'quote' => 'Working with Altysier Group has been a game changer for our cross-border logistics. Their strategic insights, execution reliability, and institutional discipline make them a partner we can always count on.', 'author' => 'Ravi Lal', 'role' => 'Managing Director', 'company' => 'Reliant Logistics', 'image' => 'https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?w=400&q=80&auto=format&fit=crop' ),
);
$testimonials = $default_testimonials;
if ( $has_acf && have_rows( 'testimonials' ) ) {
	$acf_testimonials = array();
	while ( have_rows( 'testimonials' ) ) {
		the_row();
		$acf_testimonials[] = array(
			'quote'   => get_sub_field( 'quote' ),
			'author'  => get_sub_field( 'author' ),
			'role'    => get_sub_field( 'role' ),
			'company' => get_sub_field( 'company' ),
			'image'   => get_sub_field( 'image' ),
		);
	}
	if ( ! empty( $acf_testimonials ) ) {
		$testimonials = $acf_testimonials;
	}
}
$first_testimonial = $testimonials[0];

// Hand the (possibly ACF-edited) testimonials to main.js's carousel switcher.
wp_localize_script( 'altysier-main', 'altysierTestimonials', array_values( $testimonials ) );

// FAQ & Contact section
$contact_eyebrow = $gf( 'faq_contact_eyebrow' );
if ( empty( $contact_eyebrow ) || 'Questions & Answers' === $contact_eyebrow ) {
	$contact_eyebrow = $gf( 'faq_eyebrow' );
	if ( empty( $contact_eyebrow ) || 'Questions & Answers' === $contact_eyebrow ) {
		$contact_eyebrow = 'Partnership & Inquiries';
	}
}
$faq_eyebrow   = $contact_eyebrow;
$faq_title     = $gf( 'faq_contact_heading', "Let's Build What Comes Next" );
$faq_text      = $gf( 'faq_contact_text', 'We work with businesses and organisations looking to expand into new markets, secure reliable supply chains, or explore strategic partnerships across our operating sectors.' );
$faq_r_eyebrow = $gf( 'faq_r_eyebrow', 'Insights & FAQs' );
$faq_r_title   = $gf( 'faq_heading', $gf( 'faq_r_heading', 'Frequently Asked Questions' ) );
$faq_r_intro   = $gf( 'faq_r_intro', 'Answers to common questions about our corporate structure, operations, and global partnership model.' );

// Default FAQ items if none set via ACF
$default_faq_items = array(
	array(
		'question' => 'What industries does Altysier Group operate in?',
		'answer'   => 'Altysier Group operates across international trade, industrial investment, manufacturing, transportation, agriculture, food security, healthcare and mobility, structured as a diversified portfolio of independent companies.',
		'open'     => true,
	),
	array(
		'question' => 'Which companies are part of Altysier Group?',
		'answer'   => 'The Group is made up of six companies: Altysier International General Trading, Altysier International for Advanced Business, Al Mutmeiza for Industries Investment, Al Taysir Al Mutamayyiza Gulf Co, Haloub Feed Mill Factory and TASABIH for Service and Transportation.',
		'open'     => false,
	),
	array(
		'question' => 'Where does Altysier Group operate?',
		'answer'   => 'Our companies operate across a growing number of regional and international markets, connecting supply chains and distribution networks across multiple countries.',
		'open'     => false,
	),
	array(
		'question' => 'What types of business partnerships does Altysier Group support?',
		'answer'   => 'We work with suppliers, distributors, investors and industrial partners across trade, manufacturing, logistics and healthcare, building long-term commercial relationships grounded in trust and reliable execution.',
		'open'     => false,
	),
	array(
		'question' => 'How can I contact Altysier Group?',
		'answer'   => 'Reach our team directly through the contact details in the footer below, or send a message through our contact page to start a conversation about a partnership.',
		'open'     => false,
	),
);

$faq_items = ( $has_acf && get_field( 'faq_items' ) ) ? get_field( 'faq_items' ) : $default_faq_items;

// Query Companies CPT
$companies_query = new WP_Query( array(
	'post_type'      => 'company',
	'posts_per_page' => -1,
	'orderby'        => 'menu_order',
	'order'          => 'ASC',
	'post_status'    => 'publish',
) );
$has_companies = $companies_query->have_posts();
?>

<main id="main-content">

<!-- ============================================================
     01. HERO
     ============================================================ -->
<section class="hero" id="hero">
  <div class="hero__bg" aria-hidden="true">
    <?php if ( $hero_bg_video ) : ?>
    <video class="section-photo hero__bg-video"
           poster="<?php echo esc_url( $hero_bg ); ?>"
           autoplay muted loop playsinline preload="auto">
      <source src="<?php echo esc_url( $hero_bg_video ); ?>" type="video/mp4">
    </video>
    <?php else : ?>
    <img class="section-photo"
         src="<?php echo esc_url( $hero_bg ); ?>"
         alt=""
         loading="eager"
         decoding="async"
         fetchpriority="high">
    <?php endif; ?>
    <div class="hero__scrim"></div>
  </div>
  <span class="section-watermark" aria-hidden="true">ALTYSIER GROUP</span>

  <div class="container hero__container">
    <div class="hero__marquee" style="display:none;" aria-hidden="true">
      <div class="hero__marquee__track">
        <span>ALTYSIER GROUP&nbsp;&nbsp;•&nbsp;&nbsp;ALTYSIER GROUP&nbsp;&nbsp;•&nbsp;&nbsp;ALTYSIER GROUP&nbsp;&nbsp;•&nbsp;&nbsp;</span>
        <span>ALTYSIER GROUP&nbsp;&nbsp;•&nbsp;&nbsp;ALTYSIER GROUP&nbsp;&nbsp;•&nbsp;&nbsp;ALTYSIER GROUP&nbsp;&nbsp;•&nbsp;&nbsp;</span>
      </div>
    </div>

    <p class="hero__eyebrow eyebrow"><?php echo esc_html( $hero_eyebrow ); ?></p>
    <h1 class="hero__title">
      <?php echo esc_html( $hero_h1_l1 ); ?><br>
      <?php echo esc_html( $hero_h1_l2 ); ?><br>
      <?php echo esc_html( $hero_h1_l3 ); ?>
    </h1>
    <p class="hero__text"><?php echo esc_html( $hero_body ); ?></p>
    <div class="hero__actions">
      <a href="<?php echo esc_url( $hero_btn1_lnk ); ?>" class="btn _accent"><?php echo esc_html( $hero_btn1_lbl ); ?></a>
      <a href="<?php echo esc_url( $hero_btn2_lnk ); ?>" class="btn _outline"><?php echo esc_html( $hero_btn2_lbl ); ?></a>
    </div>

    <div class="stat-grid hero__stats" data-wp-section="hero_stats">
      <?php
      $default_hero_stats = array(
        array( 'icon_key' => 'companies', 'number' => '06', 'label' => 'Group Companies' ),
        array( 'icon_key' => 'pie-chart', 'number' => '07+', 'label' => 'Business Sectors' ),
        array( 'icon_key' => 'globe-alt', 'number' => '18+', 'label' => 'Markets / Countries' ),
        array( 'icon_key' => 'badge-star', 'number' => '20+', 'label' => 'Years of Experience' ),
      );
      $hero_stats = $default_hero_stats;
      if ( $has_acf && have_rows( 'hero_stats' ) ) {
        $rows = array();
        while ( have_rows( 'hero_stats' ) ) { the_row(); $rows[] = array( 'icon_key' => get_sub_field( 'icon_key' ), 'number' => get_sub_field( 'number' ), 'label' => get_sub_field( 'label' ) ); }
        if ( ! empty( $rows ) ) { $hero_stats = $rows; }
      }
      foreach ( $hero_stats as $stat ) : ?>
      <div class="stat-card reveal">
        <div class="stat-card__content">
          <div class="stat-card__value"><?php echo esc_html( $stat['number'] ); ?></div>
          <div class="stat-card__label"><?php echo esc_html( $stat['label'] ); ?></div>
        </div>
        <?php echo str_replace( '<svg ', '<svg class="stat-card__icon" ', altysier_home_resolve_icon( $stat['icon_key'] ) ); ?>
      </div>
      <?php endforeach; ?>
    </div>

    <a href="#group" class="hero__scroll-cue" aria-label="Scroll to explore">
      <span>Scroll</span>
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5v14M5 12l7 7 7-7"/></svg>
    </a>
  </div>
</section>

<!-- ============================================================
     02. THE GROUP
     ============================================================ -->
<section class="group" id="group">
  <span class="section-watermark" aria-hidden="true">THE GROUP</span>
  <div class="container">
    <div class="group__head">
      <div class="group__head-info">
        <p class="group__eyebrow eyebrow reveal"><?php echo esc_html( $group_eyebrow ); ?></p>
        <h2 class="group__title reveal"><?php echo esc_html( $group_heading ); ?></h2>
        <span class="group__accent-line reveal" aria-hidden="true"></span>
        <p class="group__intro reveal"><?php echo esc_html( $group_statement ); ?></p>
      </div>
    </div>

    <div class="group__ticker-wrap reveal">
      <div class="ticker">
        <span class="ticker__item">06 Group Companies&nbsp;&nbsp;•&nbsp;&nbsp;07+ Business Sectors&nbsp;&nbsp;•&nbsp;&nbsp;18+ Markets&nbsp;&nbsp;•&nbsp;&nbsp;20+ Years of Experience&nbsp;&nbsp;•</span>
        <span class="ticker__item">06 Group Companies&nbsp;&nbsp;•&nbsp;&nbsp;07+ Business Sectors&nbsp;&nbsp;•&nbsp;&nbsp;18+ Markets&nbsp;&nbsp;•&nbsp;&nbsp;20+ Years of Experience&nbsp;&nbsp;•</span>
        <span class="ticker__item">06 Group Companies&nbsp;&nbsp;•&nbsp;&nbsp;07+ Business Sectors&nbsp;&nbsp;•&nbsp;&nbsp;18+ Markets&nbsp;&nbsp;•&nbsp;&nbsp;20+ Years of Experience&nbsp;&nbsp;•</span>
      </div>
    </div>

    <div class="sectors__head reveal">
      <div class="sectors__head-info">
        <?php if ( $group_sectors_eyebrow ) : ?><p class="sectors__eyebrow eyebrow reveal"><?php echo esc_html( $group_sectors_eyebrow ); ?></p><?php endif; ?>
        <h3 class="sectors__title"><?php echo esc_html( $gf( 'group_sectors_heading', 'Where We Operate' ) ); ?></h3>
        <span class="sectors__accent-line" aria-hidden="true"></span>
        <p class="sectors__intro"><?php echo esc_html( $group_sec_intro ); ?></p>
      </div>
      <div class="sectors__nav" role="group" aria-label="Sectors carousel navigation">
        <button type="button" class="strip-nav-btn" data-strip-prev="sectors" aria-label="Previous sector">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M15 18l-6-6 6-6"/></svg>
        </button>
        <button type="button" class="strip-nav-btn" data-strip-next="sectors" aria-label="Next sector">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18l6-6-6-6"/></svg>
        </button>
      </div>
    </div>

    <div class="sectors__track-wrap reveal">
      <div class="sectors__track" data-strip="sectors" data-wp-section="sector_cards">
        <?php foreach ( $sector_rows as $card ) : ?>
        <div class="sector-card">
          <div class="sector-card__photo-wrap">
            <img class="sector-card__photo" src="<?php echo esc_url( $card['photo'] ?: 'https://images.unsplash.com/photo-1494412574643-ff11b0a5c1c3?w=500&q=65&auto=format&fit=crop' ); ?>" alt="<?php echo esc_attr( $card['title'] ); ?>" loading="lazy">
            <div class="sector-card__badge"><div class="sector-card__icon"><?php echo altysier_get_sector_icon( $card['icon_key'] ); ?></div></div>
          </div>
          <div class="sector-card__body">
            <h4 class="sector-card__name"><?php echo esc_html( $card['title'] ); ?></h4>
            <p class="sector-card__text"><?php echo esc_html( $card['text'] ); ?></p>
            <div class="sector-card__footer"><span class="sector-card__tag"><?php echo esc_html( $card['tag'] ); ?></span></div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>

    <div class="group__actions" style="display:flex;justify-content:center;margin-top:40rem;opacity:1;">
      <a href="<?php echo esc_url( $group_act_link ); ?>" class="btn _accent" style="opacity:1!important;transform:none!important;"><?php echo esc_html( $group_act_label ); ?></a>
    </div>
  </div>
</section>

<!-- ============================================================
     03. HOW WE CREATE VALUE
     ============================================================ -->
<section class="journey" id="how-we-create-value">
  <span class="section-watermark" aria-hidden="true">HOW WE CREATE VALUE</span>
  <div class="container">
    <div class="journey__head">
      <div class="journey__head-info">
        <p class="journey__eyebrow eyebrow reveal"><?php echo esc_html( $journey_eyebrow ); ?></p>
        <h2 class="journey__title reveal"><?php echo esc_html( $journey_heading ); ?></h2>
        <span class="journey__accent-line reveal" aria-hidden="true"></span>
        <p class="journey__intro reveal"><?php echo esc_html( $journey_intro ); ?></p>
      </div>
    </div>

    <div class="value-pipeline reveal" data-wp-section="journey_steps">
      <?php
      $journey_rows = $default_journey_steps;
      if ( $has_acf && have_rows( 'journey_steps' ) ) {
        $rows = array();
        while ( have_rows( 'journey_steps' ) ) {
          the_row();
          $rows[] = array(
            'image'       => get_sub_field( 'image' ),
            'title'       => get_sub_field( 'title' ),
            'text'        => get_sub_field( 'text' ),
            'phase_label' => get_sub_field( 'phase_label' ),
          );
        }
        if ( ! empty( $rows ) ) { $journey_rows = $rows; }
      }
      $journey_node_icons = array(
        '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/><path d="M11 8v6M8 11h6"/></svg>',
        '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>',
        '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06A1.65 1.65 0 0 0 9 4.68V9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>',
        '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>',
        '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>',
      );
      foreach ( $journey_rows as $idx => $step ) : ?>
      <div class="value-step">
        <div class="value-step__node-wrap"><div class="value-step__node"><?php echo $journey_node_icons[ $idx % count( $journey_node_icons ) ]; ?></div></div>
        <div class="value-step__image-wrap"><img class="value-step__image" src="<?php echo esc_url( $step['image'] ?: 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?w=280&q=65&auto=format&fit=crop' ); ?>" alt="<?php echo esc_attr( $step['title'] ); ?>" loading="lazy"></div>
        <div class="value-step__body"><h3 class="value-step__title"><?php echo esc_html( $step['title'] ); ?></h3><p class="value-step__text"><?php echo esc_html( $step['text'] ); ?></p><span class="value-step__indicator"><?php echo esc_html( $step['phase_label'] ); ?></span></div>
      </div>
      <?php endforeach; ?>
    </div>

    <div class="journey__actions reveal" style="text-align:center;margin-top:48rem;">
      <a href="<?php echo esc_url( $journey_act_lnk ); ?>" class="btn _accent"><?php echo esc_html( $journey_act_lbl ); ?></a>
    </div>
  </div>
</section>

<!-- ============================================================
     04. GROUP OF COMPANIES — Business Carousel
     ============================================================ -->
<section class="businesses" id="companies">
  <span class="section-watermark" aria-hidden="true">OUR BUSINESSES</span>
  <div class="container">
    <div class="businesses__head strip-head">
      <div class="businesses__head-info">
        <p class="businesses__eyebrow eyebrow reveal"><?php echo esc_html( $biz_eyebrow ); ?></p>
        <h2 class="businesses__title reveal"><?php echo esc_html( $biz_heading ); ?></h2>
        <span class="businesses__accent-line reveal" aria-hidden="true"></span>
        <p class="businesses__intro reveal"><?php echo esc_html( $biz_intro ); ?></p>
      </div>
      <div class="strip-nav reveal">
        <button type="button" class="strip-nav-btn" data-strip-prev="businesses" aria-label="Previous company">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M15 18l-6-6 6-6"/></svg>
        </button>
        <button type="button" class="strip-nav-btn" data-strip-next="businesses" aria-label="Next company">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18l6-6-6-6"/></svg>
        </button>
      </div>
    </div>

    <div class="strip-track reveal" data-strip="businesses" tabindex="0" role="region" aria-label="The businesses behind the group">
      <?php if ( $has_companies ) :
        $card_idx = 0;
        while ( $companies_query->have_posts() ) : $companies_query->the_post();
          $card_idx++;
          $is_accent     = ( $card_idx % 2 === 0 ) ? ' _accent' : '';
          $logo_url_co   = get_the_post_thumbnail_url( get_the_ID(), 'full' ) ?: get_template_directory_uri() . '/assets/img/logo-icon.png';
          $tag           = function_exists( 'get_field' ) ? ( get_field( 'sector_tag' ) ?: '' ) : '';
          $excerpt       = get_the_excerpt();
          $bg_color      = function_exists( 'get_field' ) ? ( get_field( 'logo_bg_color' ) ?: '#ffffff' ) : '#ffffff';
      ?>
        <article class="business-card<?php echo esc_attr( $is_accent ); ?>">
          <div class="business-card__photo-wrap" style="background-color:<?php echo esc_attr( $bg_color ); ?>;">
            <img class="business-card__photo" style="object-fit:contain;padding:1.5rem;box-sizing:border-box;" src="<?php echo esc_url( $logo_url_co ); ?>" alt="<?php the_title_attribute(); ?> logo" loading="lazy" decoding="async">
          </div>
          <div class="business-card__body">
            <div class="business-card__top">
              <span class="business-card__icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="3" width="11" height="18"/><path d="M15 21V10l5 2.5V21"/></svg></span>
            </div>
            <?php if ( $tag ) : ?><span class="business-card__tag"><?php echo esc_html( $tag ); ?></span><?php endif; ?>
            <h3 class="business-card__name"><?php the_title(); ?></h3>
            <?php if ( $excerpt ) : ?><p class="business-card__text"><?php echo esc_html( $excerpt ); ?></p><?php endif; ?>
            <a href="<?php the_permalink(); ?>" class="business-card__link">Explore <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg></a>
          </div>
        </article>
      <?php endwhile; wp_reset_postdata();
      else : // Static fallback HTML from the original index.html ?>
        <article class="business-card">
          <div class="business-card__photo-wrap" style="background-color:#ffffff;">
            <img class="business-card__photo" style="object-fit:contain;padding:1.5rem;box-sizing:border-box;" src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/companies/altysier-general-trading-logo.png' ); ?>" alt="Altysier International General Trading LLC logo" loading="lazy" decoding="async">
          </div>
          <div class="business-card__body">
            <div class="business-card__top"><span class="business-card__icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M3 17h18l-2.2 3.3a2 2 0 01-1.7.9H6.9a2 2 0 01-1.7-.9L3 17Z"/><path d="M6 17v-6h5v6M13 17V7h4v10"/></svg></span></div>
            <span class="business-card__tag">International Trade</span>
            <h3 class="business-card__name">Altysier International General Trading LLC</h3>
            <p class="business-card__text">International trading of petroleum products, agricultural goods, foodstuffs, and medical supplies worldwide.</p>
            <a href="<?php echo esc_url( home_url( '/companies/altysier-general-trading/' ) ); ?>" class="business-card__link">Explore <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg></a>
          </div>
        </article>
        <article class="business-card _accent">
          <div class="business-card__photo-wrap" style="background-color:#ffffff;">
            <img class="business-card__photo" style="object-fit:contain;padding:1.5rem;box-sizing:border-box;" src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/companies/al-taysir-gulf-logo.jpg' ); ?>" alt="Al Taysir Al Mutamayyiza Gulf Co logo" loading="lazy" decoding="async">
          </div>
          <div class="business-card__body">
            <div class="business-card__top"><span class="business-card__icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><rect x="2.5" y="8" width="10.5" height="8" rx="1"/><path d="M13 11h3.8l3.2 3v3h-7"/><circle cx="6.5" cy="18.2" r="1.5"/><circle cx="16.5" cy="18.2" r="1.5"/></svg></span></div>
            <span class="business-card__tag">Logistics &amp; Transport</span>
            <h3 class="business-card__name">Al Taysir Al Mutamayyiza Gulf Co</h3>
            <p class="business-card__text">Reliable logistics and transport solutions across Saudi Arabia with efficient supply chain support.</p>
            <a href="<?php echo esc_url( home_url( '/companies/al-taysir-gulf/' ) ); ?>" class="business-card__link">Explore <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg></a>
          </div>
        </article>
        <article class="business-card">
          <div class="business-card__photo-wrap" style="background-color:#ffffff;">
            <img class="business-card__photo" style="object-fit:contain;padding:1.5rem;box-sizing:border-box;" src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/companies/haloub-feed-mill-logo.jpg' ); ?>" alt="Haloub Feed Mill Factory logo" loading="lazy" decoding="async">
          </div>
          <div class="business-card__body">
            <div class="business-card__top"><span class="business-card__icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3v11M12 3c-3 1-5 4-5 8a5 5 0 0010 0c0-4-2-7-5-8Z"/><path d="M7 21h10"/></svg></span></div>
            <span class="business-card__tag">Agriculture &amp; Food Security</span>
            <h3 class="business-card__name">Haloub Feed Mill Factory</h3>
            <p class="business-card__text">Manufacturer of premium animal feed products supporting livestock health, agricultural productivity, and food security.</p>
            <a href="<?php echo esc_url( home_url( '/companies/haloub-feed-mill/' ) ); ?>" class="business-card__link">Explore <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg></a>
          </div>
        </article>
        <article class="business-card _accent">
          <div class="business-card__photo-wrap" style="background-color:#ffffff;">
            <img class="business-card__photo" style="object-fit:contain;padding:1.5rem;box-sizing:border-box;" src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/companies/al-mutmeiza-pioneer-logo.jpg' ); ?>" alt="Al Mutmeiza for Industries Investment Co LTD logo" loading="lazy" decoding="async">
          </div>
          <div class="business-card__body">
            <div class="business-card__top"><span class="business-card__icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><rect x="3.5" y="3.5" width="7" height="7" rx="1.2"/><rect x="13.5" y="3.5" width="7" height="7" rx="1.2"/><rect x="3.5" y="13.5" width="7" height="7" rx="1.2"/><rect x="13.5" y="13.5" width="7" height="7" rx="1.2"/></svg></span></div>
            <span class="business-card__tag">Manufacturing &amp; Mobility</span>
            <h3 class="business-card__name">Al Mutmeiza for Industries Investment Co LTD</h3>
            <p class="business-card__text">Exclusive distributor &amp; authorized dealer of BAJAJ rickshaw vehicles in Sudan, supporting mobility &amp; small-business transportation.</p>
            <a href="<?php echo esc_url( home_url( '/companies/al-mutmeiza-industries/' ) ); ?>" class="business-card__link">Explore <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg></a>
          </div>
        </article>
        <article class="business-card">
          <div class="business-card__photo-wrap" style="background-color:#ffffff;">
            <img class="business-card__photo" style="object-fit:contain;padding:1.5rem;box-sizing:border-box;" src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/companies/altysier-advanced-business-logo.jpg' ); ?>" alt="Altysier International for Advanced Business Co LTD logo" loading="lazy" decoding="async">
          </div>
          <div class="business-card__body">
            <div class="business-card__top"><span class="business-card__icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M3 21V11l5 3v-3l5 3v-3l5 3v7H3Z"/><path d="M7 21v-3M12 21v-3M17 21v-3"/></svg></span></div>
            <span class="business-card__tag">Industrial Investment</span>
            <h3 class="business-card__name">Altysier International for Advanced Business Co LTD</h3>
            <p class="business-card__text">Expanding global trade opportunities through structured partnerships and advanced business solutions across essential commodity sectors.</p>
            <a href="<?php echo esc_url( home_url( '/companies/altysier-advanced-business/' ) ); ?>" class="business-card__link">Explore <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg></a>
          </div>
        </article>
        <article class="business-card _accent">
          <div class="business-card__photo-wrap" style="background-color:#ffffff;">
            <img class="business-card__photo" style="object-fit:contain;padding:1.5rem;box-sizing:border-box;" src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/companies/tasabih-services-logo.jpg' ); ?>" alt="TASABIH for Service and Transportation Co Ltd logo" loading="lazy" decoding="async">
          </div>
          <div class="business-card__body">
            <div class="business-card__top"><span class="business-card__icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="16" width="16" height="4" rx="1"/><path d="M4 16l3-8h10l3 8"/><circle cx="8" cy="18" r="1.5"/><circle cx="16" cy="18" r="1.5"/></svg></span></div>
            <span class="business-card__tag">Transportation &amp; Logistics</span>
            <h3 class="business-card__name">TASABIH for Service and Transportation Co. Ltd.</h3>
            <p class="business-card__text">Trusted transportation and trading partner, delivering efficient, cost-effective solutions across Sudan and beyond.</p>
            <a href="<?php echo esc_url( home_url( '/companies/tasabih-services/' ) ); ?>" class="business-card__link">Explore <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg></a>
          </div>
        </article>
      <?php endif; ?>
    </div>
  </div>
</section>

<!-- ============================================================
     05. GLOBAL REACH & IMPACT
     ============================================================ -->
<section class="reach" id="reach">
  <span class="section-watermark" aria-hidden="true">GLOBAL REACH</span>
  <div class="hero__bg reach__bg route-bg" aria-hidden="true">
    <img class="section-photo" src="<?php echo esc_url( $gf( 'reach_bg_image', 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?w=1600&q=75&auto=format&fit=crop' ) ); ?>" alt="" loading="lazy" decoding="async">
    <svg viewBox="0 0 1600 1200" preserveAspectRatio="xMidYMid slice">
      <path class="route-line" d="M40 980 Q420 300 820 640 T1560 260"/>
      <path class="route-line" d="M100 260 Q560 820 900 480 T1500 900"/>
      <path class="route-line" d="M200 1100 Q760 60 1400 780"/>
      <g class="route-node">
        <circle cx="40" cy="980" r="7"/><circle cx="820" cy="640" r="8"/><circle cx="1560" cy="260" r="7"/>
        <circle cx="100" cy="260" r="7"/><circle cx="900" cy="480" r="7"/><circle cx="1500" cy="900" r="7"/>
        <circle cx="200" cy="1100" r="7"/><circle cx="1400" cy="780" r="8"/>
      </g>
    </svg>
  </div>

  <div class="container reach__container">
    <div class="reach__grid">
      <div class="reach__main">
        <div class="reach__head">
          <div class="reach__head-info">
            <p class="reach__eyebrow eyebrow reveal"><?php echo esc_html( $reach_eyebrow ); ?></p>
            <h2 class="reach__title reveal"><?php echo esc_html( $reach_heading ); ?></h2>
            <span class="reach__accent-line reveal" aria-hidden="true"></span>
            <p class="reach__intro reveal"><?php echo esc_html( $reach_intro ); ?></p>
          </div>
        </div>
        <div class="reach__stats" data-wp-section="reach_stats">
          <?php
          $reach_stat_rows = $default_reach_stats;
          if ( $has_acf && have_rows( 'reach_stats' ) ) {
            $rows = array();
            while ( have_rows( 'reach_stats' ) ) { the_row(); $rows[] = array( 'number' => get_sub_field( 'number' ), 'label' => get_sub_field( 'label' ) ); }
            if ( ! empty( $rows ) ) { $reach_stat_rows = $rows; }
          }
          foreach ( $reach_stat_rows as $rs ) : ?>
          <div class="reach__stat reveal"><div class="reach__stat-value"><?php echo esc_html( $rs['number'] ); ?></div><div class="reach__stat-label"><?php echo esc_html( $rs['label'] ); ?></div></div>
          <?php endforeach; ?>
        </div>
      </div>

      <div class="reach__side">
        <div class="reach__pillars" data-wp-section="reach_pillars">
          <?php
          $reach_pillar_rows = $default_reach_pillars;
          if ( $has_acf && have_rows( 'reach_pillars' ) ) {
            $rows = array();
            while ( have_rows( 'reach_pillars' ) ) { the_row(); $rows[] = array( 'icon_key' => get_sub_field( 'icon_key' ), 'title' => get_sub_field( 'title' ), 'text' => get_sub_field( 'text' ) ); }
            if ( ! empty( $rows ) ) { $reach_pillar_rows = $rows; }
          }
          foreach ( $reach_pillar_rows as $pillar ) :
            $pillar_icon = ( 'feed' === $pillar['icon_key'] ) ? altysier_get_sector_icon( 'feed' ) : altysier_get_home_icon( $pillar['icon_key'] );
          ?>
          <div class="pillar reveal">
            <div class="pillar__top">
              <span class="pillar__icon"><?php echo $pillar_icon; ?></span>
              <h3 class="pillar__title"><?php echo esc_html( $pillar['title'] ); ?></h3>
            </div>
            <p class="pillar__text"><?php echo esc_html( $pillar['text'] ); ?></p>
          </div>
          <?php endforeach; ?>
        </div>
        <div class="reach__action reveal">
          <a href="<?php echo esc_url( $reach_act_lnk ); ?>" class="btn _accent"><?php echo esc_html( $reach_act_lbl ); ?></a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ============================================================
     06. WHY ALTYSIER + TESTIMONIALS
     ============================================================ -->
<section class="why" id="why">
  <div class="why__bg" aria-hidden="true">
    <img class="section-photo" src="https://images.unsplash.com/photo-1497366216548-37526070297c?w=1600&q=75&auto=format&fit=crop" alt="" loading="lazy" decoding="async">
  </div>
  <span class="section-watermark" aria-hidden="true">WHY TRUST US</span>
  <div class="container">
    <div class="why__head">
      <div class="why__head-info">
        <p class="why__eyebrow eyebrow reveal"><?php echo esc_html( $why_eyebrow ); ?></p>
        <h2 class="why__title reveal"><?php echo esc_html( $why_heading ); ?></h2>
        <span class="why__accent-line reveal" aria-hidden="true"></span>
        <p class="why__intro reveal"><?php echo esc_html( $why_intro ); ?></p>
      </div>
    </div>

    <div class="why__list" data-wp-section="why_principles">
      <?php
      $why_rows = $default_why_principles;
      if ( $has_acf && have_rows( 'why_principles' ) ) {
        $rows = array();
        while ( have_rows( 'why_principles' ) ) { the_row(); $rows[] = array( 'icon_key' => get_sub_field( 'icon_key' ), 'heading' => get_sub_field( 'heading' ), 'text' => get_sub_field( 'text' ) ); }
        if ( ! empty( $rows ) ) { $why_rows = $rows; }
      }
      foreach ( $why_rows as $principle ) : ?>
      <div class="principle reveal">
        <div class="principle__icon"><?php echo altysier_get_home_icon( $principle['icon_key'] ); ?></div>
        <div class="principle__content"><h3 class="principle__heading"><?php echo esc_html( $principle['heading'] ); ?></h3><p class="principle__text"><?php echo esc_html( $principle['text'] ); ?></p></div>
      </div>
      <?php endforeach; ?>
    </div>

    <!-- Testimonials carousel -->
    <div class="testimonials-editorial reveal" id="testimonials-editorial">
      <div class="editorial-watermark" aria-hidden="true">
        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/testimonials-sketch.png' ); ?>" alt="" loading="lazy">
      </div>
      <div class="editorial-body" data-wp-section="testimonials">
        <div class="editorial-index" id="editorial-index" aria-hidden="true">01</div>
        <div class="editorial-main" id="editorial-panel" role="tabpanel" aria-label="<?php esc_attr_e( 'Testimonial content', 'altysier' ); ?>">
          <blockquote class="editorial-quote" id="editorial-quote">
            &ldquo;<?php echo esc_html( $first_testimonial['quote'] ); ?>&rdquo;
          </blockquote>
          <div class="editorial-author" id="editorial-author">
            <div class="editorial-avatar-wrap">
              <img class="editorial-avatar" id="editorial-avatar" src="<?php echo esc_url( $first_testimonial['image'] ?: 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=400&q=80&auto=format&fit=crop' ); ?>" alt="<?php echo esc_attr( $first_testimonial['author'] ); ?>" loading="lazy">
            </div>
            <div class="editorial-meta">
              <p class="editorial-name" id="editorial-name"><?php echo esc_html( $first_testimonial['author'] ); ?></p>
              <p class="editorial-role"><span id="editorial-role-text"><?php echo esc_html( $first_testimonial['role'] ); ?></span><span class="editorial-sep">/</span><span class="editorial-company" id="editorial-company"><?php echo esc_html( $first_testimonial['company'] ); ?></span></p>
            </div>
          </div>
        </div>
      </div>
      <div class="editorial-nav">
        <div class="editorial-nav-left">
          <div class="editorial-lines" role="tablist" aria-label="Testimonial slides">
            <?php foreach ( $testimonials as $t_idx => $t ) : ?>
            <button type="button" role="tab" aria-controls="editorial-panel" class="editorial-line-btn<?php echo ( 0 === $t_idx ) ? ' active' : ''; ?>" data-index="<?php echo esc_attr( $t_idx ); ?>" aria-label="Testimonial <?php echo esc_attr( $t_idx + 1 ); ?>" aria-selected="<?php echo ( 0 === $t_idx ) ? 'true' : 'false'; ?>"><span class="editorial-line"></span></button>
            <?php endforeach; ?>
          </div>
          <span class="editorial-counter" id="editorial-counter">01 / <?php echo esc_html( sprintf( '%02d', count( $testimonials ) ) ); ?></span>
        </div>
        <div class="editorial-nav-right">
          <button type="button" class="editorial-arrow-btn" id="editorial-prev-btn" aria-label="Previous testimonial">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 18l-6-6 6-6"/></svg>
          </button>
          <button type="button" class="editorial-arrow-btn" id="editorial-next-btn" aria-label="Next testimonial">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18l6-6-6-6"/></svg>
          </button>
        </div>
      </div>
    </div>

    <div class="why__actions reveal" style="text-align:center;margin-top:48rem;">
      <a href="<?php echo esc_url( $why_act_lnk ); ?>" class="btn _accent"><?php echo esc_html( $why_act_lbl ); ?></a>
    </div>
  </div>
</section>

<!-- ============================================================
     07. FAQ + PARTNERSHIP CTA
     ============================================================ -->
<section class="faq" id="faq">
  <span class="section-watermark" aria-hidden="true">PARTNERSHIP &amp; FAQ</span>
  <div class="container">
    <div class="faq__grid">
      <!-- Left: Contact Form -->
      <div class="faq__col-left" id="contact">
        <p class="faq__eyebrow eyebrow reveal"><?php echo esc_html( $faq_eyebrow ); ?></p>
        <h2 class="faq__title reveal"><?php echo esc_html( $faq_title ); ?></h2>
        <span class="faq__accent-line reveal" aria-hidden="true"></span>
        <p class="faq__form-text reveal"><?php echo esc_html( $faq_text ); ?></p>

        <form class="contact-form reveal" id="homepage-contact-form" data-form-ajax="true" novalidate>
          <!-- Honeypot anti-spam field -->
          <input type="text" name="_hp" tabindex="-1" autocomplete="off" aria-hidden="true" style="position:absolute;left:-9999px;opacity:0;pointer-events:none;" value="">
          <?php wp_nonce_field( 'altysier_contact_nonce', '_nonce' ); ?>
          <input type="hidden" name="action" value="altysier_contact">
          <input type="hidden" name="form_source" value="Homepage Contact">
          <input type="hidden" name="recaptcha_token" id="homepage_recaptcha_token">

          <div class="contact-form__row">
            <label class="contact-form__field">
              <span>Full Name</span>
              <input type="text" name="name" id="hp_name" placeholder="Your name" minlength="2" maxlength="100" required autocomplete="name" aria-describedby="hp_name_error">
              <span class="field-error" id="hp_name_error" role="alert" aria-live="polite"></span>
            </label>
            <label class="contact-form__field">
              <span>Email</span>
              <input type="email" name="email" id="hp_email" placeholder="you@company.com" required autocomplete="email" aria-describedby="hp_email_error">
              <span class="field-error" id="hp_email_error" role="alert" aria-live="polite"></span>
            </label>
          </div>
          <label class="contact-form__field">
            <span>Message</span>
            <textarea name="message" id="hp_message" rows="2" placeholder="Tell us about your enquiry" minlength="2" maxlength="3000" required aria-describedby="hp_message_error"></textarea>
            <span class="field-error" id="hp_message_error" role="alert" aria-live="polite"></span>
          </label>

          <button type="submit" class="btn _accent contact-form__submit" id="hp_submit_btn">Send Message</button>
          <div class="contact-form__status" id="hp_form_status" role="alert" aria-live="polite"></div>
        </form>
      </div>

      <!-- Right: FAQ -->
      <div class="faq__col-right">
        <p class="faq__eyebrow eyebrow reveal"><?php echo esc_html( $faq_r_eyebrow ); ?></p>
        <h2 class="faq__title reveal"><?php echo esc_html( $faq_r_title ); ?></h2>
        <span class="faq__accent-line reveal" aria-hidden="true"></span>
        <p class="faq__intro reveal"><?php echo esc_html( $faq_r_intro ); ?></p>

        <div class="faq__list reveal">
          <?php foreach ( $faq_items as $idx => $faq ) :
            $is_open = ! empty( $faq['open'] ) || ( $idx === 0 && empty( $faq['open'] ) && count( $faq_items ) > 0 && $idx === 0 );
            $is_open = ( $idx === 0 );
          ?>
            <div class="faq__item" data-open="<?php echo $is_open ? 'true' : 'false'; ?>">
              <button type="button" class="faq__trigger" aria-expanded="<?php echo $is_open ? 'true' : 'false'; ?>">
                <span class="faq__question"><?php echo esc_html( $faq['question'] ); ?></span>
                <svg class="faq__icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
              </button>
              <div class="faq__panel"><div>
                <p class="faq__answer"><?php echo esc_html( $faq['answer'] ); ?></p>
              </div></div>
            </div>
          <?php endforeach; ?>
        </div>

        <div class="faq__action reveal" style="margin-top:36rem;">
          <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn _accent">Contact Our Group &rarr;</a>
        </div>
      </div>
    </div>
  </div>
</section>

</main>

<?php get_footer(); ?>
