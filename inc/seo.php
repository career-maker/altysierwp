<?php
/**
 * SEO Meta Tags, Open Graph & Sitemap Engine for Altysier Group
 *
 * @package Altysier
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Render all SEO meta tags in <head>
 */
function altysier_render_seo_meta() {
	global $post;

	// ── Core data ──────────────────────────────────────────────────────────────
	$site_name   = get_bloginfo( 'name' );
	$site_desc   = get_bloginfo( 'description' );
	$current_url = ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	$current_url = esc_url( $current_url );

	// ── Page-specific ACF SEO fields ──────────────────────────────────────────
	$seo_title       = '';
	$seo_desc        = '';
	$seo_keywords    = '';
	$og_image        = '';
	$og_title        = '';
	$og_desc         = '';
	$tw_title        = '';
	$tw_desc         = '';
	$tw_image        = '';
	$canonical       = '';
	$robots_index    = 'index';
	$robots_follow   = 'follow';

	if ( function_exists( 'get_field' ) && $post ) {
		$seo_title     = get_field( 'seo_meta_title' );
		$seo_desc      = get_field( 'seo_meta_description' );
		$seo_keywords  = get_field( 'seo_meta_keywords' );
		$og_image_arr  = get_field( 'seo_og_image' );
		$og_image      = is_array( $og_image_arr ) ? $og_image_arr['url'] : $og_image_arr;
		$og_title      = get_field( 'seo_og_title' );
		$og_desc       = get_field( 'seo_og_description' );
		$tw_title      = get_field( 'seo_twitter_title' );
		$tw_desc       = get_field( 'seo_twitter_description' );
		$tw_img_arr    = get_field( 'seo_twitter_image' );
		$tw_image      = is_array( $tw_img_arr ) ? $tw_img_arr['url'] : $tw_img_arr;
		$canonical     = get_field( 'seo_canonical_url' );
		$noindex       = get_field( 'seo_noindex' );
		$nofollow      = get_field( 'seo_nofollow' );
		if ( $noindex )  $robots_index  = 'noindex';
		if ( $nofollow ) $robots_follow = 'nofollow';
	}

	// ── Smart Fallbacks ────────────────────────────────────────────────────────
	if ( is_front_page() ) {
		$default_title = $site_name . ' — International Group';
		$default_desc  = 'Altysier Group is a diversified international business group active across general trading, industrial investment, agribusiness, corporate services, and mobility distribution across global markets.';
	} elseif ( is_singular( 'company' ) && $post ) {
		$default_title = get_the_title() . ' — ' . $site_name;
		$default_desc  = get_the_excerpt();
	} elseif ( is_page() && $post ) {
		$default_title = get_the_title() . ' — ' . $site_name;
		$default_desc  = wp_trim_words( get_the_content(), 30, '…' );
	} elseif ( is_single() && $post ) {
		$default_title = get_the_title() . ' — ' . $site_name . ' News';
		$default_desc  = wp_trim_words( get_the_excerpt(), 30, '…' );
	} elseif ( is_archive() ) {
		$default_title = __( 'News & Insights', 'altysier' ) . ' — ' . $site_name;
		$default_desc  = 'Latest news, insights and updates from Altysier Group.';
	} else {
		$default_title = $site_name;
		$default_desc  = $site_desc;
	}

	$page_title = ! empty( $seo_title ) ? esc_html( $seo_title ) : esc_html( $default_title );
	$page_desc  = ! empty( $seo_desc )  ? esc_html( $seo_desc )  : esc_html( $default_desc );
	$page_og_image = ! empty( $og_image ) ? esc_url( $og_image ) : esc_url( get_template_directory_uri() . '/assets/img/logo-full.png' );

	// Thumbnail override
	if ( empty( $og_image ) && $post && has_post_thumbnail( $post->ID ) ) {
		$page_og_image = esc_url( get_the_post_thumbnail_url( $post->ID, 'large' ) );
	}

	$page_og_title  = ! empty( $og_title )  ? esc_html( $og_title )  : $page_title;
	$page_og_desc   = ! empty( $og_desc )   ? esc_html( $og_desc )   : $page_desc;
	$page_tw_title  = ! empty( $tw_title )  ? esc_html( $tw_title )  : $page_title;
	$page_tw_desc   = ! empty( $tw_desc )   ? esc_html( $tw_desc )   : $page_desc;
	$page_tw_image  = ! empty( $tw_image )  ? esc_url( $tw_image )   : $page_og_image;
	$page_canonical = ! empty( $canonical ) ? esc_url( $canonical )  : $current_url;

	echo "\n<!-- Altysier SEO Engine -->\n";

	// Meta Description
	echo '<meta name="description" content="' . $page_desc . '">' . "\n";

	// Keywords (optional)
	if ( ! empty( $seo_keywords ) ) {
		echo '<meta name="keywords" content="' . esc_attr( $seo_keywords ) . '">' . "\n";
	}

	// Robots
	echo '<meta name="robots" content="' . esc_attr( $robots_index . ', ' . $robots_follow ) . '">' . "\n";

	// Canonical URL (prevent duplicates)
	echo '<link rel="canonical" href="' . $page_canonical . '">' . "\n";

	// Open Graph tags
	echo '<meta property="og:type" content="' . ( is_single() ? 'article' : 'website' ) . '">' . "\n";
	echo '<meta property="og:site_name" content="' . esc_attr( $site_name ) . '">' . "\n";
	echo '<meta property="og:url" content="' . $current_url . '">' . "\n";
	echo '<meta property="og:title" content="' . esc_attr( $page_og_title ) . '">' . "\n";
	echo '<meta property="og:description" content="' . esc_attr( $page_og_desc ) . '">' . "\n";
	echo '<meta property="og:image" content="' . $page_og_image . '">' . "\n";
	echo '<meta property="og:image:width" content="1200">' . "\n";
	echo '<meta property="og:image:height" content="630">' . "\n";
	echo '<meta property="og:locale" content="en_US">' . "\n";

	// Twitter / X Cards
	echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
	echo '<meta name="twitter:title" content="' . esc_attr( $page_tw_title ) . '">' . "\n";
	echo '<meta name="twitter:description" content="' . esc_attr( $page_tw_desc ) . '">' . "\n";
	echo '<meta name="twitter:image" content="' . esc_url( $page_tw_image ) . '">' . "\n";

	// Article-specific Open Graph
	if ( is_single() && $post ) {
		echo '<meta property="article:published_time" content="' . esc_attr( get_the_date( 'c', $post ) ) . '">' . "\n";
		echo '<meta property="article:modified_time" content="' . esc_attr( get_the_modified_date( 'c', $post ) ) . '">' . "\n";
	}

	// FAQ JSON-LD Schema (Homepage only — from ACF FAQ repeater)
	if ( is_front_page() && function_exists( 'get_field' ) ) {
		$faq_items = get_field( 'faq_items' );
		if ( ! empty( $faq_items ) && is_array( $faq_items ) ) {
			$faq_entities = array();
			foreach ( $faq_items as $faq ) {
				$faq_entities[] = array(
					'@type'          => 'Question',
					'name'           => esc_html( $faq['question'] ),
					'acceptedAnswer' => array(
						'@type' => 'Answer',
						'text'  => esc_html( $faq['answer'] ),
					),
				);
			}
			echo '<script type="application/ld+json">';
			echo wp_json_encode( array(
				'@context'   => 'https://schema.org',
				'@type'      => 'FAQPage',
				'mainEntity' => $faq_entities,
			) );
			echo '</script>' . "\n";
		}
	}

	// Organization JSON-LD Schema (All pages)
	$org_schema = array(
		'@context' => 'https://schema.org',
		'@type'    => 'Organization',
		'name'     => 'Altysier Group',
		'url'      => esc_url( get_site_url() ),
		'logo'     => esc_url( get_template_directory_uri() . '/assets/img/logo-icon.png' ),
		'contactPoint' => array(
			'@type'             => 'ContactPoint',
			'telephone'         => '+97142680666',
			'contactType'       => 'customer service',
			'availableLanguage' => array( 'English', 'Arabic' ),
		),
		'sameAs' => array_filter( array(
			altysier_get_option( 'social_linkedin', '' ),
			altysier_get_option( 'social_instagram', '' ),
			altysier_get_option( 'social_twitter', '' ),
			altysier_get_option( 'social_facebook', '' ),
		) ),
	);
	echo '<script type="application/ld+json">' . wp_json_encode( $org_schema ) . '</script>' . "\n";
}
add_action( 'wp_head', 'altysier_render_seo_meta', 5 );

/**
 * Override wp_title for legacy compatibility
 */
function altysier_wp_title( $title, $sep ) {
	if ( function_exists( 'get_field' ) ) {
		$seo_title = get_field( 'seo_meta_title' );
		if ( ! empty( $seo_title ) ) {
			return esc_html( $seo_title );
		}
	}
	return $title;
}
add_filter( 'wp_title', 'altysier_wp_title', 20, 2 );

/**
 * XML Sitemap Index Reference (WordPress core generates sitemaps at /wp-sitemap.xml)
 */
function altysier_activate_sitemap() {
	add_filter( 'wp_sitemaps_enabled', '__return_true' );
	add_filter( 'wp_sitemaps_post_types', function( $post_types ) {
		$post_types['company'] = get_post_type_object( 'company' );
		return $post_types;
	} );
	
	// Remove users sitemap since author archives are disabled
	add_filter( 'wp_sitemaps_add_provider', function( $provider, $name ) {
		if ( 'users' === $name ) {
			return false;
		}
		return $provider;
	}, 10, 2 );
}
add_action( 'init', 'altysier_activate_sitemap' );

/**
 * Disable author archives to prevent username enumeration and 404 errors
 */
function altysier_disable_author_archives() {
	if ( is_author() ) {
		global $wp_query;
		$wp_query->set_404();
		status_header( 404 );
		nocache_headers();
		
		// Properly load the theme's 404.php template and stop execution
		if ( $template = get_query_template( '404' ) ) {
			include( $template );
		}
		exit;
	}
}
add_action( 'template_redirect', 'altysier_disable_author_archives' );

/**
 * Customize the virtual robots.txt file to hide API and image folders
 */
function altysier_custom_robots_txt( $output, $public ) {
	$output .= "Disallow: /wp-json/\n"; // Hide REST API
	$output .= "Disallow: /wp-content/uploads/\n"; // Hide image/media uploads
	return $output;
}
add_filter( 'robots_txt', 'altysier_custom_robots_txt', 10, 2 );
