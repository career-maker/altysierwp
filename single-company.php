<?php
/**
 * single-company.php — Individual Company Page Template
 * Pixel-perfect PHP recreation of companies/[company-slug].html
 *
 * Sections:
 *   01. Banner (hero with banner-inner part)
 *   02. Company Intro
 *   03. Our Story (timeline steps)
 *   04. Key Areas / Services
 *   05. Markets & Operational Reach
 *   06. Visual Showcase
 *   07. Ecosystem (other companies)
 *   08. Company CTA
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

// ── Banner fields ─────────────────────────────────────────────────────────────
$banner_mark  = $gf( 'banner_watermark', strtoupper( get_the_title() ) );
$banner_title = $gf( 'banner_title', get_the_title() );
$banner_sub   = $gf( 'banner_subtitle', $gf( 'positioning_statement', '' ) );
$banner_bg    = $gf( 'banner_bg_image', 'https://images.unsplash.com/photo-1497366216548-37526070297c?w=1600&q=75&auto=format&fit=crop' );

// ── Intro fields ──────────────────────────────────────────────────────────────
$intro_eyebrow   = $gf( 'intro_eyebrow', 'Company Overview' );
$intro_heading   = $gf( 'intro_heading', get_the_title() );
$intro_statement = $gf( 'intro_statement', get_the_excerpt() );
$intro_narrative = $gf( 'intro_narrative', '' );
$intro_photo     = $gf( 'intro_photo', 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?w=800&q=75&auto=format&fit=crop' );

// ── Story / Journey fields ────────────────────────────────────────────────────
$story_eyebrow   = $gf( 'story_eyebrow', 'Our Journey' );
$story_heading   = $gf( 'story_heading', 'Built With Purpose' );
$story_watermark = $gf( 'story_watermark', 'PURPOSE' );
$story_steps     = $has_acf ? get_field( 'story_steps' ) : array();

// ── Areas / Services ──────────────────────────────────────────────────────────
$areas_eyebrow   = $gf( 'areas_eyebrow', 'Core Business' );
$areas_heading   = $gf( 'areas_heading', 'Key Areas' );
$areas_watermark = $gf( 'areas_watermark', 'TRADING' );
$area_panels     = $has_acf ? get_field( 'area_panels' ) : array();

// ── Markets ───────────────────────────────────────────────────────────────────
$markets_eyebrow   = $gf( 'markets_eyebrow', 'Geographic Footprint' );
$markets_heading   = $gf( 'markets_heading', 'Markets & Operational Reach' );
$markets_watermark = $gf( 'markets_watermark', 'REACH' );
$markets_list      = $has_acf ? get_field( 'markets_list' ) : array();

// ── Showcase ──────────────────────────────────────────────────────────────────
$showcase_eyebrow = $gf( 'showcase_eyebrow', 'Operations in Motion' );
$showcase_heading = $gf( 'showcase_heading', 'Operations Showcase' );
$showcase_lead    = $gf( 'showcase_lead_image', 'https://images.unsplash.com/photo-1553413077-190dd305871c?w=1200&q=75&auto=format&fit=crop' );
$showcase_sides   = $has_acf ? get_field( 'showcase_side_images' ) : array();

// ── CTA ───────────────────────────────────────────────────────────────────────
$cta_bg       = $gf( 'cta_bg_image', 'https://images.unsplash.com/photo-1497366216548-37526070297c?w=1600&q=75&auto=format&fit=crop' );
$cta_eyebrow  = $gf( 'cta_eyebrow', 'Work With Us' );
$cta_heading  = $gf( 'cta_heading', "Let's Build Stronger Partnerships Together." );
$cta_text     = $gf( 'cta_text', 'We welcome businesses, investors, and partners looking to explore opportunities across our operational portfolio.' );
$cta_btn_lbl  = $gf( 'cta_btn_label', 'Contact Us' );
$cta_btn_lnk  = $gf( 'cta_btn_link', home_url( '/contact/' ) );

// ── Query sibling companies for ecosystem section ─────────────────────────────
$other_companies = new WP_Query( array(
	'post_type'      => 'company',
	'posts_per_page' => -1,
	'post__not_in'   => array( get_the_ID() ),
	'orderby'        => 'menu_order',
	'order'          => 'ASC',
	'post_status'    => 'publish',
) );

while ( have_posts() ) : the_post();
?>

<main id="main-content">

<?php
// ── 01. BANNER ─────────────────────────────────────────────────────────────────
get_template_part( 'template-parts/banner', 'inner' );
?>

<!-- ============================================================
     02. COMPANY INTRO
     ============================================================ -->
<section class="about-intro" id="overview">
  <span class="section-watermark" aria-hidden="true"><?php echo esc_html( strtoupper( $gf( 'intro_watermark', 'OVERVIEW' ) ) ); ?></span>
  <div class="container">
    <div class="about-intro__grid">
      <div class="about-intro__content">
        <div class="about-intro__head">
          <p class="eyebrow reveal"><?php echo esc_html( $intro_eyebrow ); ?></p>
          <h2 class="group__title reveal"><?php echo esc_html( $intro_heading ); ?></h2>
          <span class="group__accent-line reveal" aria-hidden="true"></span>
        </div>
        <?php if ( $intro_statement ) : ?>
          <p class="about-intro__statement reveal"><?php echo esc_html( $intro_statement ); ?></p>
        <?php endif; ?>
        <?php if ( $intro_narrative ) : ?>
          <div class="about-intro__narrative reveal"><?php echo wp_kses_post( $intro_narrative ); ?></div>
        <?php endif; ?>
      </div>
      <?php if ( $intro_photo ) : ?>
        <div class="about-intro__photo-wrap reveal">
          <img src="<?php echo esc_url( $intro_photo ); ?>" alt="<?php the_title_attribute(); ?> operations" class="about-intro__photo" loading="lazy">
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>

<?php if ( ! empty( $story_steps ) ) : ?>
<!-- ============================================================
     03. OUR STORY / JOURNEY
     ============================================================ -->
<section class="company-story" id="story">
  <span class="section-watermark" aria-hidden="true"><?php echo esc_html( $story_watermark ); ?></span>
  <div class="container">
    <div class="about-intro__head">
      <p class="eyebrow reveal"><?php echo esc_html( $story_eyebrow ); ?></p>
      <h2 class="group__title reveal"><?php echo esc_html( $story_heading ); ?></h2>
      <span class="group__accent-line reveal" aria-hidden="true"></span>
    </div>
    <div class="story-steps">
      <?php foreach ( $story_steps as $step ) : ?>
        <div class="story-step reveal">
          <?php if ( ! empty( $step['step_badge'] ) ) : ?>
            <span class="story-step__badge"><?php echo esc_html( $step['step_badge'] ); ?></span>
          <?php endif; ?>
          <?php if ( ! empty( $step['step_title'] ) ) : ?>
            <h3 class="story-step__title"><?php echo esc_html( $step['step_title'] ); ?></h3>
          <?php endif; ?>
          <?php if ( ! empty( $step['step_text'] ) ) : ?>
            <p class="story-step__text"><?php echo esc_html( $step['step_text'] ); ?></p>
          <?php endif; ?>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<?php if ( ! empty( $area_panels ) ) : ?>
<!-- ============================================================
     04. KEY AREAS / SERVICES
     ============================================================ -->
<section class="company-areas" id="trading-areas">
  <span class="section-watermark" aria-hidden="true"><?php echo esc_html( $areas_watermark ); ?></span>
  <div class="container">
    <div class="about-intro__head">
      <p class="eyebrow reveal"><?php echo esc_html( $areas_eyebrow ); ?></p>
      <h2 class="group__title reveal"><?php echo esc_html( $areas_heading ); ?></h2>
      <span class="group__accent-line reveal" aria-hidden="true"></span>
    </div>
    <div class="areas-grid">
      <?php foreach ( $area_panels as $panel ) :
        $icon_svg = altysier_get_sector_icon( $panel['panel_icon'] ?? '' );
      ?>
        <div class="area-panel reveal">
          <div class="area-panel__icon-wrap">
            <span class="area-panel__icon" aria-hidden="true"><?php echo $icon_svg; ?></span>
          </div>
          <div class="area-panel__body">
            <?php if ( ! empty( $panel['panel_title'] ) ) : ?>
              <h3 class="area-panel__title"><?php echo esc_html( $panel['panel_title'] ); ?></h3>
            <?php endif; ?>
            <?php if ( ! empty( $panel['panel_description'] ) ) : ?>
              <p class="area-panel__desc"><?php echo esc_html( $panel['panel_description'] ); ?></p>
            <?php endif; ?>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<?php if ( ! empty( $markets_list ) ) : ?>
<!-- ============================================================
     05. MARKETS & OPERATIONAL REACH
     ============================================================ -->
<section class="company-markets" id="markets">
  <span class="section-watermark" aria-hidden="true"><?php echo esc_html( $markets_watermark ); ?></span>
  <div class="container">
    <div class="about-intro__head">
      <p class="eyebrow reveal"><?php echo esc_html( $markets_eyebrow ); ?></p>
      <h2 class="group__title reveal"><?php echo esc_html( $markets_heading ); ?></h2>
      <span class="group__accent-line reveal" aria-hidden="true"></span>
    </div>
    <div class="markets-grid">
      <?php foreach ( $markets_list as $market ) :
        $m_icon = altysier_get_market_icon( $market['market_icon'] ?? 'globe' );
      ?>
        <div class="market-card reveal">
          <div class="market-card__icon"><?php echo $m_icon; ?></div>
          <?php if ( ! empty( $market['market_title'] ) ) : ?>
            <h3 class="market-card__title"><?php echo esc_html( $market['market_title'] ); ?></h3>
          <?php endif; ?>
          <?php if ( ! empty( $market['market_text'] ) ) : ?>
            <p class="market-card__text"><?php echo esc_html( $market['market_text'] ); ?></p>
          <?php endif; ?>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<?php if ( $showcase_lead || ! empty( $showcase_sides ) ) : ?>
<!-- ============================================================
     06. VISUAL SHOWCASE
     ============================================================ -->
<section class="company-showcase" id="showcase">
  <span class="section-watermark" aria-hidden="true"><?php echo esc_html( $gf( 'showcase_watermark', 'OPERATIONS' ) ); ?></span>
  <div class="container">
    <div class="about-intro__head">
      <p class="eyebrow reveal"><?php echo esc_html( $showcase_eyebrow ); ?></p>
      <h2 class="group__title reveal"><?php echo esc_html( $showcase_heading ); ?></h2>
      <span class="group__accent-line reveal" aria-hidden="true"></span>
    </div>
    <div class="showcase-grid reveal">
      <?php if ( $showcase_lead ) : ?>
        <div class="showcase-lead">
          <img src="<?php echo esc_url( $showcase_lead ); ?>" alt="<?php the_title_attribute(); ?> operations" loading="lazy">
        </div>
      <?php endif; ?>
      <?php if ( ! empty( $showcase_sides ) ) : ?>
        <div class="showcase-side" style="grid-template-rows: repeat(<?php echo count( $showcase_sides ); ?>, 1fr);">
          <?php foreach ( $showcase_sides as $side_img ) :
            $side_url = is_array( $side_img ) ? $side_img['url'] : $side_img;
            $side_alt = is_array( $side_img ) ? $side_img['alt'] : '';
          ?>
            <div class="showcase-side-item">
              <img src="<?php echo esc_url( $side_url ); ?>" alt="<?php echo esc_attr( $side_alt ); ?>" loading="lazy">
            </div>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- ============================================================
     07. ECOSYSTEM — Other Group Companies
     ============================================================ -->
<section class="company-ecosystem" id="ecosystem">
  <span class="section-watermark" aria-hidden="true"><?php echo esc_html( $gf( 'ecosystem_watermark', 'ECOSYSTEM' ) ); ?></span>
  <div class="container">
    <div class="about-intro__head" style="text-align:center;">
      <p class="eyebrow reveal" style="justify-content:center;"><?php echo esc_html( $gf( 'ecosystem_eyebrow', 'Group Integration' ) ); ?></p>
      <h2 class="group__title reveal"><?php echo esc_html( $gf( 'ecosystem_heading', 'Part of a Bigger Business Ecosystem' ) ); ?></h2>
      <span class="group__accent-line reveal" style="margin-left:auto;margin-right:auto;" aria-hidden="true"></span>
      <p class="group__intro reveal" style="margin-left:auto;margin-right:auto;"><?php echo esc_html( $gf( 'ecosystem_intro', "Connecting sector-leading capabilities under Altysier Group's global umbrella." ) ); ?></p>
    </div>

    <div class="ecosystem-chain reveal">
      <div class="ecosystem-node"><?php the_title(); ?></div>
      <span class="ecosystem-arrow">&rarr;</span>
      <div class="ecosystem-node"><?php echo esc_html( $gf( 'sector_tag', 'Operating Sector' ) ); ?></div>
      <span class="ecosystem-arrow">&rarr;</span>
      <div class="ecosystem-node" style="color:var(--accent);">Altysier Group</div>
    </div>

    <?php if ( $other_companies->have_posts() ) : ?>
      <div class="about-intro__head" style="margin-top:50rem;">
        <p class="eyebrow reveal">Explore Other Companies</p>
      </div>
      <div class="other-companies-strip reveal">
        <?php while ( $other_companies->have_posts() ) : $other_companies->the_post();
          $co_logo = get_the_post_thumbnail_url( get_the_ID(), 'altysier-thumb' ) ?: get_template_directory_uri() . '/assets/img/logo-icon.png';
          $co_tag  = function_exists( 'get_field' ) ? get_field( 'sector_tag' ) : '';
        ?>
          <a href="<?php the_permalink(); ?>" class="other-co-card">
              <img src="<?php echo esc_url( $co_logo ); ?>" alt="<?php the_title_attribute(); ?>" class="other-co-card__logo" loading="lazy">
            <div class="other-co-card__info">
              <span class="other-co-card__name"><?php the_title(); ?></span>
              <?php if ( $co_tag ) : ?>
                <span class="other-co-card__sector"><?php echo esc_html( $co_tag ); ?></span>
              <?php endif; ?>
            </div>
          </a>
        <?php endwhile; wp_reset_postdata(); ?>
      </div>
    <?php endif; ?>
  </div>
</section>

<!-- ============================================================
     08. COMPANY CTA
     ============================================================ -->
<section class="company-cta" id="cta">
  <div class="company-cta__bg" aria-hidden="true">
    <img class="section-photo" src="<?php echo esc_url( $cta_bg ); ?>" alt="" loading="lazy">
    <div class="company-cta__overlay"></div>
  </div>
  <div class="container company-cta__container reveal">
    <p class="eyebrow" style="color:rgba(255,255,255,0.7);"><?php echo esc_html( $cta_eyebrow ); ?></p>
    <h2 class="company-cta__title"><?php echo esc_html( $cta_heading ); ?></h2>
    <?php if ( $cta_text ) : ?>
      <p class="company-cta__text"><?php echo esc_html( $cta_text ); ?></p>
    <?php endif; ?>
    <a href="<?php echo esc_url( $cta_btn_lnk ); ?>" class="btn _outline-white"><?php echo esc_html( $cta_btn_lbl ); ?></a>
  </div>
</section>

</main>

<?php endwhile; ?>

<?php get_footer(); ?>
