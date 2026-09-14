<?php
/**
 * Altysier Group WordPress Theme — Main Functions
 *
 * @package Altysier
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// ── Theme Setup ────────────────────────────────────────────────────────────────
function altysier_setup() {
	load_theme_textdomain( 'altysier', get_template_directory() . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'custom-logo', array(
		'height'      => 60,
		'width'       => 200,
		'flex-width'  => true,
		'flex-height' => true,
	) );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'gallery', 'link' ) );

	// Image sizes
	add_image_size( 'altysier-hero',     1920, 900,  true );
	add_image_size( 'altysier-banner',   1920, 600,  true );
	add_image_size( 'altysier-card',     800,  600,  true );
	add_image_size( 'altysier-thumb',    400,  300,  true );
	add_image_size( 'altysier-og',       1200, 630,  true );

	// Navigation menus
	register_nav_menus( array(
		'primary_nav'         => __( 'Primary Navigation', 'altysier' ),
		'footer_quick_links'  => __( 'Footer — Quick Links', 'altysier' ),
		'footer_companies'    => __( 'Footer — Group Companies', 'altysier' ),
		'footer_legal'        => __( 'Footer — Legal (Privacy, Terms)', 'altysier' ),
	) );
}
add_action( 'after_setup_theme', 'altysier_setup' );

// ── Enqueue Assets ─────────────────────────────────────────────────────────────
function altysier_enqueue_assets() {
	$theme_uri = get_template_directory_uri();
	$ver       = '1.0.0';

	// Google Fonts — non-render-blocking (Intersection + rel=stylesheet)
	wp_enqueue_style(
		'altysier-fonts',
		'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Roboto+Condensed:wght@400;600;700;800&display=swap',
		array(),
		null
	);

	// Core theme CSS (migrated verbatim from original styles.min.css)
	wp_enqueue_style(
		'altysier-styles',
		$theme_uri . '/assets/css/styles.min.css',
		array( 'altysier-fonts' ),
		$ver
	);

	// Main JS (migrated verbatim from original main.min.js)
	wp_enqueue_script(
		'altysier-main',
		$theme_uri . '/assets/js/main.min.js',
		array(),
		$ver,
		true // Load in footer
	);

	// Theme JS data for AJAX + reCAPTCHA — must come AFTER wp_enqueue_script()
	// registers the 'altysier-main' handle, or the data silently fails to attach.
	wp_localize_script( 'altysier-main', 'altysierConfig', array(
		'ajaxUrl'        => admin_url( 'admin-ajax.php' ),
		'contactNonce'   => wp_create_nonce( 'altysier_contact_nonce' ),
		'recaptchaKey'   => altysier_get_option( 'recaptcha_site_key', '' ),
		'recaptchaEnabled' => (bool) altysier_get_option( 'recaptcha_enabled', 0 ),
		'homeUrl'        => esc_url( home_url() ),
		'themeUrl'       => $theme_uri,
	) );
}
add_action( 'wp_enqueue_scripts', 'altysier_enqueue_assets' );

// ── Dark Mode Inline Script (must go in <head>, before first paint) ────────────
function altysier_dark_mode_head_script() {
	echo '<script>(function(){try{var s=localStorage.getItem("altysier-theme"),d=s?s==="dark":matchMedia("(prefers-color-scheme: dark)").matches;document.documentElement.setAttribute("data-theme",d?"dark":"light");}catch(e){}})();</script>' . "\n";
}
add_action( 'wp_head', 'altysier_dark_mode_head_script', 1 );

// ── Disable Block Editor Bloat on Frontend ─────────────────────────────────────
function altysier_remove_block_styles() {
	// Conditionally remove global styles injected by WordPress blocks
	wp_deregister_style( 'global-styles' );
	wp_dequeue_style( 'global-styles' );
	wp_dequeue_style( 'wp-block-library' );
	wp_dequeue_style( 'wp-block-library-theme' );
}
add_action( 'wp_enqueue_scripts', 'altysier_remove_block_styles', 100 );

// ── Load Modular Inc Files ─────────────────────────────────────────────────────
$inc_files = array(
	'helpers',       // Must be first — provides altysier_get_option() used by all other modules
	'cpt',
	'options-page',
	'acf-fields',
	'smtp',
	'recaptcha',
	'forms',
	'seo',
	'security',
);

foreach ( $inc_files as $file ) {
	$path = get_template_directory() . '/inc/' . $file . '.php';
	if ( file_exists( $path ) ) {
		require_once $path;
	}
}

// ── Widget Areas ───────────────────────────────────────────────────────────────
function altysier_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Blog Sidebar', 'altysier' ),
		'id'            => 'sidebar-blog',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'altysier_widgets_init' );

// ── Pagination ────────────────────────────────────────────────────────────────
function altysier_pagination() {
	echo paginate_links( array(
		'prev_text' => '&larr; Previous',
		'next_text' => 'Next &rarr;',
		'type'      => 'list',
	) );
}

// ── Excerpt ───────────────────────────────────────────────────────────────────
function altysier_excerpt_length( $length ) {
	return 25;
}
add_filter( 'excerpt_length', 'altysier_excerpt_length' );

function altysier_excerpt_more( $more ) {
	return '…';
}
add_filter( 'excerpt_more', 'altysier_excerpt_more' );

// ── Breadcrumbs Helper ────────────────────────────────────────────────────────
function altysier_breadcrumbs() {
	echo '<nav class="breadcrumb reveal" aria-label="Breadcrumbs">';
	echo '<a href="' . esc_url( home_url() ) . '">' . esc_html__( 'Home', 'altysier' ) . '</a>';
	echo '<span class="breadcrumb__sep">/</span>';

	if ( is_singular( 'company' ) ) {
		echo '<a href="' . esc_url( home_url( '/companies/' ) ) . '">' . esc_html__( 'Group of Companies', 'altysier' ) . '</a>';
		echo '<span class="breadcrumb__sep">/</span>';
		echo '<span aria-current="page">' . esc_html( get_the_title() ) . '</span>';
	} elseif ( is_page() ) {
		echo '<span aria-current="page">' . esc_html( get_the_title() ) . '</span>';
	} elseif ( is_single() ) {
		echo '<a href="' . esc_url( get_permalink( get_option( 'page_for_posts' ) ) ) . '">' . esc_html__( 'News & Insights', 'altysier' ) . '</a>';
		echo '<span class="breadcrumb__sep">/</span>';
		echo '<span aria-current="page">' . esc_html( get_the_title() ) . '</span>';
	} elseif ( is_archive() ) {
		echo '<span aria-current="page">' . esc_html__( 'News & Insights', 'altysier' ) . '</span>';
	}

	echo '</nav>';
}

// ── Flush Rewrite Rules on Activation ─────────────────────────────────────────
function altysier_flush_rewrites() {
	altysier_register_post_types();
	flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'altysier_flush_rewrites' );

// ── Custom Title Tag ──────────────────────────────────────────────────────────
function altysier_document_title_parts( $title ) {
	if ( function_exists( 'get_field' ) ) {
		global $post;
		if ( $post ) {
			$seo_title = get_field( 'seo_meta_title' );
			if ( ! empty( $seo_title ) ) {
				$title['title'] = $seo_title;
				return $title;
			}
		}
	}
	if ( ! isset( $title['site'] ) ) {
		$title['site'] = get_bloginfo( 'name' );
	}
	return $title;
}
add_filter( 'document_title_parts', 'altysier_document_title_parts' );

// ── Suppress Block Patterns & FSE Template Output ─────────────────────────────
remove_action( 'wp_enqueue_scripts', 'wp_enqueue_global_styles' );
remove_action( 'wp_footer', 'wp_enqueue_global_styles', 1 );

// ── Hide the Unused Default Content Editor on Fully-ACF Page Templates ────────
// None of these templates ever call the_content() — every section is a dedicated
// ACF field instead. Leaving the default block editor canvas visible just gives
// admins a big empty box that looks like "the" content but does nothing, and
// buries the real (ACF) fields below it. Dropping 'editor' support for the
// specific post being edited also makes WordPress fall back to the classic,
// single-column meta-box screen for that request, so the ACF field groups are
// the only thing an editor sees — no confusing duplicate editor.
function altysier_hide_unused_editor_for_acf_templates() {
	global $pagenow;

	if ( 'post.php' !== $pagenow || empty( $_GET['post'] ) ) {
		return;
	}

	$post_id = (int) $_GET['post'];
	if ( 'page' !== get_post_type( $post_id ) ) {
		return;
	}

	$acf_only_templates = array(
		'front-page.php',
		'page-about.php',
		'page-contact.php',
		'page-csr.php',
		'page-group-of-companies.php',
		'page-privacy.php',
		'page-terms.php',
	);

	$template = get_page_template_slug( $post_id );
	if ( in_array( $template, $acf_only_templates, true ) ) {
		remove_post_type_support( 'page', 'editor' );
	}
}
add_action( 'admin_init', 'altysier_hide_unused_editor_for_acf_templates' );
