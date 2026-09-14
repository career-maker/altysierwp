<?php
/**
 * template-parts/banner-inner.php
 * Reusable inner page hero banner — shared by About, CSR, Contact, Companies, etc.
 *
 * Usage: get_template_part( 'template-parts/banner', 'inner' );
 *
 * @package Altysier
 */

// Priority: caller-provided vars -> ACF fields -> smart defaults
$banner_bg   = $banner_bg   ?? ( function_exists( 'get_field' ) ? get_field( 'banner_bg_image' )   : '' );
$banner_mark = $banner_mark ?? ( function_exists( 'get_field' ) ? get_field( 'banner_watermark' )  : strtoupper( get_the_title() ) );
$banner_title= $banner_title?? ( function_exists( 'get_field' ) ? get_field( 'banner_title' )      : get_the_title() );
$banner_sub  = $banner_sub  ?? ( function_exists( 'get_field' ) ? get_field( 'banner_subtitle' )   : '' );

if ( empty( $banner_bg ) ) {
	$banner_bg = 'https://images.unsplash.com/photo-1497366216548-37526070297c?w=1600&q=75&auto=format&fit=crop';
}
?>
<section class="inner-hero banner-inner" id="inner-hero" aria-label="<?php echo esc_attr( $banner_title ); ?> Banner" data-wp-section="page_banner">
  <div class="inner-hero__bg banner-inner__bg" aria-hidden="true" data-wp-field="banner_bg_image">
    <img class="section-photo"
         src="<?php echo esc_url( $banner_bg ); ?>"
         alt=""
         loading="eager"
         decoding="async"
         fetchpriority="high">
    <div class="inner-hero__scrim banner-inner__overlay"></div>
  </div>

  <?php if ( $banner_mark ) : ?>
    <span class="section-watermark" aria-hidden="true" data-wp-field="banner_watermark"><?php echo esc_html( $banner_mark ); ?></span>
  <?php endif; ?>

  <div class="container inner-hero__container banner-inner__container">
    <nav class="breadcrumb reveal" aria-label="Breadcrumbs" data-wp-field="breadcrumbs">
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'altysier' ); ?></a>
      <span class="breadcrumb__sep">/</span>
      <?php if ( is_singular( 'company' ) ) : ?>
        <a href="<?php echo esc_url( home_url( '/#companies' ) ); ?>"><?php esc_html_e( 'Companies', 'altysier' ); ?></a>
        <span class="breadcrumb__sep">/</span>
      <?php endif; ?>
      <span aria-current="page" data-wp-field="breadcrumb_current"><?php echo esc_html( get_the_title() ); ?></span>
    </nav>

    <?php if ( $banner_title ) : ?>
      <h1 class="inner-hero__title banner-inner__title reveal" data-wp-field="banner_title"><?php echo esc_html( $banner_title ); ?></h1>
    <?php endif; ?>

    <?php if ( $banner_sub ) : ?>
      <p class="inner-hero__text banner-inner__subtitle reveal" data-wp-field="banner_subtitle"><?php echo esc_html( $banner_sub ); ?></p>
    <?php endif; ?>
  </div>
</section>
