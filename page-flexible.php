<?php
/**
 * Template Name: Flexible Page (Page Builder)
 *
 * Generic page template for any brand-new page: content comes entirely from
 * the "Page Sections" flexible-content field (group_flexible_builder, see
 * inc/acf-fields.php) — an admin builds the page by adding/reordering
 * section blocks, each reusing the exact same CSS as the rest of the site.
 * No new template file or field group is needed to add another page.
 *
 * @package Altysier
 */

get_header();

$has_acf = function_exists( 'have_rows' );
?>

<main id="main-content">

<?php if ( $has_acf && have_rows( 'page_sections' ) ) : while ( have_rows( 'page_sections' ) ) : the_row();

	$layout = get_row_layout();

	switch ( $layout ) :

	// ── Hero Banner ──────────────────────────────────────────────────────────
	case 'hero_banner' :
		$bg = get_sub_field( 'bg_image' );
		?>
		<section class="inner-hero" id="hero">
		  <div class="inner-hero__bg" aria-hidden="true">
		    <?php if ( $bg ) : ?><img class="section-photo" src="<?php echo esc_url( $bg ); ?>" alt="" loading="eager" decoding="async"><?php endif; ?>
		    <div class="inner-hero__scrim"></div>
		  </div>
		  <?php if ( get_sub_field( 'watermark' ) ) : ?><span class="section-watermark" aria-hidden="true"><?php echo esc_html( get_sub_field( 'watermark' ) ); ?></span><?php endif; ?>
		  <div class="container inner-hero__container">
		    <nav class="breadcrumb reveal" aria-label="Breadcrumbs">
		      <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
		      <span class="breadcrumb__sep">/</span>
		      <span aria-current="page"><?php the_title(); ?></span>
		    </nav>
		    <?php if ( get_sub_field( 'title' ) ) : ?><h1 class="inner-hero__title reveal"><?php echo esc_html( get_sub_field( 'title' ) ); ?></h1><?php endif; ?>
		    <?php if ( get_sub_field( 'subtitle' ) ) : ?><p class="inner-hero__text reveal"><?php echo esc_html( get_sub_field( 'subtitle' ) ); ?></p><?php endif; ?>
		  </div>
		</section>
		<?php
		break;

	// ── Text Intro ───────────────────────────────────────────────────────────
	case 'text_intro' :
		?>
		<section class="about-intro">
		  <?php if ( get_sub_field( 'watermark' ) ) : ?><span class="section-watermark" aria-hidden="true"><?php echo esc_html( get_sub_field( 'watermark' ) ); ?></span><?php endif; ?>
		  <div class="container">
		    <div class="about-intro__head">
		      <?php if ( get_sub_field( 'eyebrow' ) ) : ?><p class="eyebrow reveal"><?php echo esc_html( get_sub_field( 'eyebrow' ) ); ?></p><?php endif; ?>
		      <?php if ( get_sub_field( 'heading' ) ) : ?><h2 class="group__title reveal"><?php echo esc_html( get_sub_field( 'heading' ) ); ?></h2><?php endif; ?>
		      <span class="group__accent-line reveal" aria-hidden="true"></span>
		    </div>
		    <div class="about-intro__grid">
		      <?php if ( get_sub_field( 'statement' ) ) : ?><div class="about-intro__statement reveal"><?php echo esc_html( get_sub_field( 'statement' ) ); ?></div><?php endif; ?>
		      <?php if ( get_sub_field( 'narrative' ) ) : ?><div class="about-intro__narrative reveal"><?php echo wp_kses_post( get_sub_field( 'narrative' ) ); ?></div><?php endif; ?>
		    </div>
		    <?php if ( get_sub_field( 'photo' ) ) : ?>
		    <div class="about-intro__photo-wrap reveal">
		      <img class="about-intro__photo" src="<?php echo esc_url( get_sub_field( 'photo' ) ); ?>" alt="" loading="lazy" decoding="async">
		    </div>
		    <?php endif; ?>
		  </div>
		</section>
		<?php
		break;

	// ── Feature Section (photo + text + points) ─────────────────────────────
	case 'feature_section' :
		$reverse = get_sub_field( 'reverse_layout' );
		?>
		<section class="csr-feature-section">
		  <?php if ( get_sub_field( 'watermark' ) ) : ?><span class="section-watermark" aria-hidden="true"><?php echo esc_html( get_sub_field( 'watermark' ) ); ?></span><?php endif; ?>
		  <div class="container">
		    <div class="about-intro__head">
		      <?php if ( get_sub_field( 'eyebrow' ) ) : ?><p class="eyebrow reveal"><?php echo esc_html( get_sub_field( 'eyebrow' ) ); ?></p><?php endif; ?>
		      <?php if ( get_sub_field( 'heading' ) ) : ?><h2 class="group__title reveal"><?php echo esc_html( get_sub_field( 'heading' ) ); ?></h2><?php endif; ?>
		      <span class="group__accent-line reveal" aria-hidden="true"></span>
		    </div>
		    <div class="csr-feature-grid<?php echo $reverse ? ' _reverse' : ''; ?>">
		      <?php if ( get_sub_field( 'photo' ) ) : ?>
		      <div class="csr-feature__photo-wrap reveal">
		        <img class="csr-feature__photo" src="<?php echo esc_url( get_sub_field( 'photo' ) ); ?>" alt="" loading="lazy">
		        <div class="csr-feature__scrim" aria-hidden="true"></div>
		        <?php if ( get_sub_field( 'badge' ) ) : ?><span class="csr-feature__badge"><?php echo esc_html( get_sub_field( 'badge' ) ); ?></span><?php endif; ?>
		      </div>
		      <?php endif; ?>
		      <div class="csr-feature__content reveal">
		        <?php if ( get_sub_field( 'statement' ) ) : ?><h3 class="csr-feature__statement"><?php echo esc_html( get_sub_field( 'statement' ) ); ?></h3><?php endif; ?>
		        <?php if ( get_sub_field( 'lead' ) ) : ?><p class="csr-feature__lead"><?php echo esc_html( get_sub_field( 'lead' ) ); ?></p><?php endif; ?>
		        <?php if ( have_rows( 'points' ) ) : ?>
		        <div class="csr-feature__list">
		          <?php while ( have_rows( 'points' ) ) : the_row(); ?>
		          <div class="csr-feature__item">
		            <h4 class="csr-feature__item-title"><?php echo esc_html( get_sub_field( 'title' ) ); ?></h4>
		            <p class="csr-feature__item-desc"><?php echo esc_html( get_sub_field( 'desc' ) ); ?></p>
		          </div>
		          <?php endwhile; ?>
		        </div>
		        <?php endif; ?>
		      </div>
		    </div>
		  </div>
		</section>
		<?php
		break;

	// ── Card Grid ────────────────────────────────────────────────────────────
	case 'card_grid' :
		?>
		<section class="about-intro">
		  <div class="container">
		    <div class="about-intro__head">
		      <?php if ( get_sub_field( 'eyebrow' ) ) : ?><p class="eyebrow reveal"><?php echo esc_html( get_sub_field( 'eyebrow' ) ); ?></p><?php endif; ?>
		      <?php if ( get_sub_field( 'heading' ) ) : ?><h2 class="group__title reveal"><?php echo esc_html( get_sub_field( 'heading' ) ); ?></h2><?php endif; ?>
		      <span class="group__accent-line reveal" aria-hidden="true"></span>
		    </div>
		    <?php if ( have_rows( 'cards' ) ) : ?>
		    <div class="csr-principles-grid">
		      <?php while ( have_rows( 'cards' ) ) : the_row(); ?>
		      <div class="csr-principle-card reveal">
		        <?php if ( get_sub_field( 'number' ) ) : ?><span class="csr-principle-card__num"><?php echo esc_html( get_sub_field( 'number' ) ); ?></span><?php endif; ?>
		        <h3 class="csr-principle-card__title"><?php echo esc_html( get_sub_field( 'title' ) ); ?></h3>
		        <p class="csr-principle-card__text"><?php echo esc_html( get_sub_field( 'text' ) ); ?></p>
		      </div>
		      <?php endwhile; ?>
		    </div>
		    <?php endif; ?>
		  </div>
		</section>
		<?php
		break;

	// ── Stats Row ────────────────────────────────────────────────────────────
	case 'stats_row' :
		if ( have_rows( 'stats' ) ) : ?>
		<section class="reach" style="min-height:0;padding:60rem 0;">
		  <div class="container">
		    <div class="reach__stats">
		      <?php while ( have_rows( 'stats' ) ) : the_row(); ?>
		      <div class="reach__stat reveal"><div class="reach__stat-value"><?php echo esc_html( get_sub_field( 'number' ) ); ?></div><div class="reach__stat-label"><?php echo esc_html( get_sub_field( 'label' ) ); ?></div></div>
		      <?php endwhile; ?>
		    </div>
		  </div>
		</section>
		<?php endif;
		break;

	// ── FAQ Accordion ────────────────────────────────────────────────────────
	case 'faq_accordion' :
		?>
		<section class="faq" style="min-height:0;">
		  <div class="container">
		    <div class="faq__col-right" style="max-width:820rem;margin:0 auto;">
		      <?php if ( get_sub_field( 'eyebrow' ) ) : ?><p class="faq__eyebrow eyebrow reveal"><?php echo esc_html( get_sub_field( 'eyebrow' ) ); ?></p><?php endif; ?>
		      <?php if ( get_sub_field( 'heading' ) ) : ?><h2 class="faq__title reveal"><?php echo esc_html( get_sub_field( 'heading' ) ); ?></h2><?php endif; ?>
		      <span class="faq__accent-line reveal" aria-hidden="true"></span>
		      <?php if ( have_rows( 'faq_items' ) ) : $fi = 0; ?>
		      <div class="faq__list reveal">
		        <?php while ( have_rows( 'faq_items' ) ) : the_row(); $fi++; ?>
		        <div class="faq__item" data-open="<?php echo ( 1 === $fi ) ? 'true' : 'false'; ?>">
		          <button type="button" class="faq__trigger" aria-expanded="<?php echo ( 1 === $fi ) ? 'true' : 'false'; ?>">
		            <span class="faq__question"><?php echo esc_html( get_sub_field( 'question' ) ); ?></span>
		            <svg class="faq__icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
		          </button>
		          <div class="faq__panel"><div><p class="faq__answer"><?php echo esc_html( get_sub_field( 'answer' ) ); ?></p></div></div>
		        </div>
		        <?php endwhile; ?>
		      </div>
		      <?php endif; ?>
		    </div>
		  </div>
		</section>
		<?php
		break;

	// ── CTA Band ─────────────────────────────────────────────────────────────
	case 'cta_band' :
		$bg = get_sub_field( 'bg_image' );
		?>
		<section class="about-cta">
		  <?php if ( get_sub_field( 'watermark' ) ) : ?><span class="section-watermark" aria-hidden="true"><?php echo esc_html( get_sub_field( 'watermark' ) ); ?></span><?php endif; ?>
		  <div class="about-cta__bg" aria-hidden="true">
		    <?php if ( $bg ) : ?><img src="<?php echo esc_url( $bg ); ?>" alt="" loading="lazy"><?php endif; ?>
		    <div class="about-cta__scrim"></div>
		  </div>
		  <div class="container about-cta__container">
		    <?php if ( get_sub_field( 'eyebrow' ) ) : ?><p class="eyebrow reveal" style="color: rgba(255,255,255,0.7);"><?php echo esc_html( get_sub_field( 'eyebrow' ) ); ?></p><?php endif; ?>
		    <?php if ( get_sub_field( 'heading' ) ) : ?><h2 class="about-cta__title reveal"><?php echo esc_html( get_sub_field( 'heading' ) ); ?></h2><?php endif; ?>
		    <?php if ( get_sub_field( 'text' ) ) : ?><p class="about-cta__text reveal"><?php echo esc_html( get_sub_field( 'text' ) ); ?></p><?php endif; ?>
		    <?php if ( get_sub_field( 'btn_label' ) ) : ?><a href="<?php echo esc_url( get_sub_field( 'btn_link' ) ?: '/contact/' ); ?>" class="btn _accent reveal"><?php echo esc_html( get_sub_field( 'btn_label' ) ); ?></a><?php endif; ?>
		  </div>
		</section>
		<?php
		break;

	// ── Rich Text Content ────────────────────────────────────────────────────
	case 'rich_content' :
		?>
		<section class="page-content">
		  <div class="container page-content__container">
		    <?php echo wp_kses_post( get_sub_field( 'body' ) ); ?>
		  </div>
		</section>
		<?php
		break;

	endswitch;

endwhile; else :
	// No sections added yet — tell the admin what to do instead of a blank page.
	if ( current_user_can( 'edit_pages' ) ) : ?>
	<div class="container" style="padding:80rem 0;text-align:center;">
	  <p style="font-family:Inter,sans-serif;">This page has no sections yet. Edit it in wp-admin and use <strong>Page Sections</strong> to add a Hero Banner, Text Intro, Feature Section, Card Grid, Stats Row, FAQ Accordion, CTA Band, or Rich Text block.</p>
	</div>
	<?php endif;
endif; ?>

</main>

<?php get_footer(); ?>
