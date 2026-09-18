<?php
/**
 * header.php — Altysier Group WordPress Theme
 * Renders the <head>, preloader, sticky header, and mobile drawer.
 * Pixel-perfect recreation of parts/header.html.
 *
 * @package Altysier
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="theme-color" content="#900909">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<?php
// ── Active Nav State ────────────────────────────────────────────────────────────
$nav_active_about     = is_page( 'about' ) ? ' is-active' : '';
$nav_active_companies = is_singular( 'company' ) ? ' is-active' : '';
$nav_active_csr       = is_page( 'csr' ) ? ' is-active' : '';
$nav_active_contact   = is_page( 'contact' ) ? ' is-active' : '';

// ── Preloader ────────────────────────────────────────────────────────────────
$preloader_enabled = altysier_get_option( 'enable_preloader', 1 );
if ( $preloader_enabled ) :
	$bg_video_desktop = get_template_directory_uri() . '/assets/img/preloader-bg.mp4';
	$bg_video_mobile  = get_template_directory_uri() . '/assets/img/preloader-bg-mobile.mp4';
?>
<div class="preloader" role="dialog" aria-modal="true" aria-label="<?php esc_attr_e( 'Loading Altysier Group', 'altysier' ); ?>">
  <video class="preloader__video" autoplay muted loop playsinline aria-hidden="true">
    <source src="<?php echo esc_url( $bg_video_desktop ); ?>" type="video/mp4">
  </video>
  <script>
    (function() {
      var v = document.querySelector('.preloader__video');
      if (v) {
        var w = window.innerWidth || document.documentElement.clientWidth || (window.screen && window.screen.width) || 0;
        var h = window.innerHeight || document.documentElement.clientHeight || (window.screen && window.screen.height) || 0;
        var isPhone = ((w > 0 && w <= 540) && (h > w)) ||
          (window.matchMedia && window.matchMedia('(max-width: 540px) and (orientation: portrait)').matches);
        if (isPhone) {
          v.src = '<?php echo esc_js( $bg_video_mobile ); ?>';
          v.load();
        } else {
          v.src = '<?php echo esc_js( $bg_video_desktop ); ?>';
        }
      }
    })();
  </script>
  <div class="container">
    <div class="preloader__container">
      <div class="preloader__text">Altysier Group</div>
      <div class="preloader__progress">
        <span class="preloader__progress-number" data-num="100">0</span>%
      </div>
      <span class="preloader__container-line"></span>
    </div>
  </div>
</div>
<?php endif; ?>

<?php
// ── Sticky Header ─────────────────────────────────────────────────────────────
$logo_url  = altysier_get_option( 'header_logo', get_template_directory_uri() . '/assets/img/logo-icon.png' );
$home_url  = esc_url( home_url( '/' ) );

// Build company links from CPT
$companies_query = new WP_Query( array(
	'post_type'      => 'company',
	'posts_per_page' => -1,
	'orderby'        => 'menu_order',
	'order'          => 'ASC',
	'post_status'    => 'publish',
) );
?>

<header class="header" role="banner">
  <div class="container header__container">
    <a href="<?php echo $home_url; ?>" class="header__logo">
      <img src="<?php echo esc_url( $logo_url ); ?>" alt="" class="header__logo-icon" width="48" height="42" loading="eager">
      ALTYSIER<span>GROUP</span>
    </a>

    <div class="header__actions">
      <nav class="header__menu" aria-label="<?php esc_attr_e( 'Primary', 'altysier' ); ?>">

        <a href="<?php echo esc_url( home_url( '/about/' ) ); ?>" class="header__menu-item text-hover<?php echo esc_attr( $nav_active_about ); ?>">
          <span class="text-hover__inner">
            <span class="text-hover__elem text-hover__elem-1"><?php esc_html_e( 'About', 'altysier' ); ?></span>
            <span class="text-hover__elem text-hover__elem-2"><?php esc_html_e( 'About', 'altysier' ); ?></span>
          </span>
        </a>

        <div class="header__menu-dropdown">
          <a href="<?php echo esc_url( home_url( '/#companies' ) ); ?>" class="header__menu-item text-hover header__dropdown-toggle<?php echo esc_attr( $nav_active_companies ); ?>">
            <span class="text-hover__inner">
              <span class="text-hover__elem text-hover__elem-1"><?php esc_html_e( 'Group of Companies', 'altysier' ); ?></span>
              <span class="text-hover__elem text-hover__elem-2"><?php esc_html_e( 'Group of Companies', 'altysier' ); ?></span>
            </span>
            <svg class="header__dropdown-arrow" viewBox="0 0 10 6" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M1 1l4 4 4-4"/></svg>
          </a>

          <div class="header__dropdown-panel" role="menu">
            <?php if ( $companies_query->have_posts() ) :
              while ( $companies_query->have_posts() ) : $companies_query->the_post();
                $sector_tag = function_exists( 'get_field' ) ? get_field( 'sector_tag' ) : '';
            ?>
              <a href="<?php the_permalink(); ?>" class="header__dropdown-link" role="menuitem">
                <span class="header__dropdown-name"><?php the_title(); ?></span>
                <?php if ( $sector_tag ) : ?>
                  <span class="header__dropdown-sector"><?php echo esc_html( $sector_tag ); ?></span>
                <?php endif; ?>
              </a>
            <?php endwhile; wp_reset_postdata();
            else : // Fallback static links ?>
              <a href="<?php echo esc_url( home_url( '/companies/altysier-general-trading/' ) ); ?>" class="header__dropdown-link" role="menuitem">
                <span class="header__dropdown-name">ALTYSIER INTERNATIONAL GENERAL TRADING LLC</span>
                <span class="header__dropdown-sector">International Trade &amp; Commodities</span>
              </a>
              <a href="<?php echo esc_url( home_url( '/companies/altysier-advanced-business/' ) ); ?>" class="header__dropdown-link" role="menuitem">
                <span class="header__dropdown-name">ALTYSIER INTERNATIONAL FOR ADVANCED BUSINESS CO LTD</span>
                <span class="header__dropdown-sector">Commodities &amp; Healthcare Essentials</span>
              </a>
              <a href="<?php echo esc_url( home_url( '/companies/al-mutmeiza-industries/' ) ); ?>" class="header__dropdown-link" role="menuitem">
                <span class="header__dropdown-name">AL MUTMEIZA FOR INDUSTRIES INVESTMENT CO LTD</span>
                <span class="header__dropdown-sector">Industrial Investment &amp; BAJAJ Mobility</span>
              </a>
              <a href="<?php echo esc_url( home_url( '/companies/al-taysir-gulf/' ) ); ?>" class="header__dropdown-link" role="menuitem">
                <span class="header__dropdown-name">AL TAYSIR AL MUTAMAYYIZA GULF CO</span>
                <span class="header__dropdown-sector">Transportation &amp; Ground Logistics</span>
              </a>
              <a href="<?php echo esc_url( home_url( '/companies/haloub-feed-mill/' ) ); ?>" class="header__dropdown-link" role="menuitem">
                <span class="header__dropdown-name">HALOUB FEED MILL FACTORY</span>
                <span class="header__dropdown-sector">Animal Feed Manufacturing &amp; Agriculture</span>
              </a>
              <a href="<?php echo esc_url( home_url( '/companies/tasabih-services/' ) ); ?>" class="header__dropdown-link" role="menuitem">
                <span class="header__dropdown-name">TASABIH FOR SERVICE AND TRANSPORTATION CO LTD.</span>
                <span class="header__dropdown-sector">Logistics, Fleet &amp; Corporate Procurement</span>
              </a>
            <?php endif; ?>
          </div>
        </div>

        <a href="<?php echo esc_url( home_url( '/csr/' ) ); ?>" class="header__menu-item text-hover<?php echo esc_attr( $nav_active_csr ); ?>">
          <span class="text-hover__inner">
            <span class="text-hover__elem text-hover__elem-1"><?php esc_html_e( 'CSR', 'altysier' ); ?></span>
            <span class="text-hover__elem text-hover__elem-2"><?php esc_html_e( 'CSR', 'altysier' ); ?></span>
          </span>
        </a>

        <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="header__menu-item text-hover<?php echo esc_attr( $nav_active_contact ); ?>">
          <span class="text-hover__inner">
            <span class="text-hover__elem text-hover__elem-1"><?php esc_html_e( 'Contact', 'altysier' ); ?></span>
            <span class="text-hover__elem text-hover__elem-2"><?php esc_html_e( 'Contact', 'altysier' ); ?></span>
          </span>
        </a>
      </nav>

      <button type="button" class="header__theme-toggle" aria-label="<?php esc_attr_e( 'Switch theme mode', 'altysier' ); ?>" data-theme-toggle>
        <svg class="theme-toggle__icon theme-toggle__icon--sun" viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="12" r="4"></circle><path d="M12 2v2M12 20v2M4.22 4.22l1.42 1.42M18.36 18.36l1.42 1.42M2 12h2M20 12h2M6.34 17.66l-1.42 1.42M19.78 4.22l-1.42 1.42"></path></svg>
        <svg class="theme-toggle__icon theme-toggle__icon--moon" viewBox="0 0 24 24" aria-hidden="true"><path d="M20.354 15.354A9 9 0 0 1 8.646 3.646 9.003 9.003 0 1 0 20.354 15.354Z"></path></svg>
      </button>

      <button type="button" class="header__hamburger-btn" aria-label="<?php esc_attr_e( 'Toggle menu', 'altysier' ); ?>" aria-expanded="false" aria-controls="mobile-menu">
        <span class="is-not-active"><?php esc_html_e( 'Menu', 'altysier' ); ?></span>
        <span class="is-active"><?php esc_html_e( 'Close', 'altysier' ); ?></span>
      </button>
    </div>
  </div>
</header>

<!-- Mobile Drawer -->
<div class="header__hamburger" id="mobile-menu" role="navigation" aria-label="<?php esc_attr_e( 'Mobile primary navigation', 'altysier' ); ?>">
  <nav class="header__hamburger-menu">
    <a href="<?php echo esc_url( home_url( '/about/' ) ); ?>"><?php esc_html_e( 'About', 'altysier' ); ?></a>

    <div class="header__hamburger-accordion">
      <button type="button" class="header__hamburger-parent" aria-expanded="false">
        <span><?php esc_html_e( 'Group of Companies', 'altysier' ); ?></span>
        <svg class="header__hamburger-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg>
      </button>
      <div class="header__hamburger-sub">
        <?php if ( $companies_query->have_posts() ) :
          $companies_query->rewind_posts();
          while ( $companies_query->have_posts() ) : $companies_query->the_post();
        ?>
          <a href="<?php the_permalink(); ?>" class="header__hamburger-subitem"><?php the_title(); ?></a>
        <?php endwhile; wp_reset_postdata();
        else : ?>
          <a href="<?php echo esc_url( home_url( '/companies/altysier-general-trading/' ) ); ?>" class="header__hamburger-subitem">ALTYSIER INTERNATIONAL GENERAL TRADING LLC</a>
          <a href="<?php echo esc_url( home_url( '/companies/altysier-advanced-business/' ) ); ?>" class="header__hamburger-subitem">ALTYSIER INTERNATIONAL FOR ADVANCED BUSINESS CO LTD</a>
          <a href="<?php echo esc_url( home_url( '/companies/al-mutmeiza-industries/' ) ); ?>" class="header__hamburger-subitem">AL MUTMEIZA FOR INDUSTRIES INVESTMENT CO LTD</a>
          <a href="<?php echo esc_url( home_url( '/companies/al-taysir-gulf/' ) ); ?>" class="header__hamburger-subitem">AL TAYSIR AL MUTAMAYYIZA GULF CO</a>
          <a href="<?php echo esc_url( home_url( '/companies/haloub-feed-mill/' ) ); ?>" class="header__hamburger-subitem">HALOUB FEED MILL FACTORY</a>
          <a href="<?php echo esc_url( home_url( '/companies/tasabih-services/' ) ); ?>" class="header__hamburger-subitem">TASABIH FOR SERVICE AND TRANSPORTATION CO LTD.</a>
        <?php endif; ?>
      </div>
    </div>

    <a href="<?php echo esc_url( home_url( '/csr/' ) ); ?>"><?php esc_html_e( 'CSR', 'altysier' ); ?></a>
    <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Contact', 'altysier' ); ?></a>
  </nav>
</div>

<div id="page" class="site">
