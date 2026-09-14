<?php
/**
 * inc/helpers.php â€” Shared Helper Functions for Altysier Theme
 *
 * @package Altysier
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Return an SVG icon string for a sector by key name.
 * Used in single-company.php area panels.
 */
function altysier_get_sector_icon( $key = '' ) {
	$icons = array(
		'petroleum'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2.5c3.5 4.5 6.5 8.7 6.5 12a6.5 6.5 0 1 1-13 0c0-3.3 3-7.5 6.5-12Z"/></svg>',
		'agri'       => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M4 20c8 0 14-6 16-16-10 2-16 8-16 16Z"/><path d="M4 20c2-4 5-7 9-9"/></svg>',
		'medical'    => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M12 8v8M8 12h8"/></svg>',
		'logistics'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M3 7h11v8H3z"/><path d="M14 10h4l3 3v2h-7z"/><circle cx="7" cy="18" r="1.6"/><circle cx="17.5" cy="18" r="1.6"/></svg>',
		'industry'   => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M3 21V11l5 3v-3l5 3v-3l5 3v7H3Z"/><path d="M7 21v-3M12 21v-3M17 21v-3"/></svg>',
		'bajaj'      => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M4 16l1.4-4.6A2 2 0 017.3 10h9.4a2 2 0 011.9 1.4L20 16"/><rect x="3" y="16" width="18" height="3.2" rx="1"/><circle cx="7" cy="19.6" r="1.4"/><circle cx="17" cy="19.6" r="1.4"/></svg>',
		'feed'       => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3v11M12 3c-3 1-5 4-5 8a5 5 0 0010 0c0-4-2-7-5-8Z"/><path d="M7 21h10"/></svg>',
		'fleet'      => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="16" width="16" height="4" rx="1"/><path d="M4 16l3-8h10l3 8"/><circle cx="8" cy="18" r="1.5"/><circle cx="16" cy="18" r="1.5"/></svg>',
		'trade_ship' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M3 17h18l-2.2 3.3a2 2 0 01-1.7.9H6.9a2 2 0 01-1.7-.9L3 17Z"/><path d="M6 17v-6h5v6M13 17V7h4v10"/></svg>',
		'transport_truck' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><rect x="2.5" y="8" width="10.5" height="8" rx="1"/><path d="M13 11h3.8l3.2 3v3h-7"/><circle cx="6.5" cy="18.2" r="1.5"/><circle cx="16.5" cy="18.2" r="1.5"/></svg>',
		'default'    => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><rect x="3.5" y="3.5" width="7" height="7" rx="1.2"/><rect x="13.5" y="3.5" width="7" height="7" rx="1.2"/><rect x="3.5" y="13.5" width="7" height="7" rx="1.2"/><rect x="13.5" y="13.5" width="7" height="7" rx="1.2"/></svg>',
	);
	return $icons[ $key ] ?? $icons['default'];
}

/**
 * Shared icon set for homepage stat cards, CSR/reach pillars and "Why Trust Us"
 * principle cards. Some keys intentionally match the exact SVG paths used in
 * the original static markup so swapping a card's icon_key never changes any
 * shape that already renders elsewhere on the page.
 */
function altysier_get_home_icon( $key = 'default' ) {
	$icons = array(
		'pie-chart'      => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M21.21 15.89A10 10 0 1 1 8 2.83"/><path d="M22 12A10 10 0 0 0 12 2v10z"/></svg>',
		'globe-alt'      => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><line x1="3" y1="12" x2="21" y2="12"/><path d="M12 3a15 15 0 0 1 4 9 15 15 0 0 1-4 9 15 15 0 0 1-4-9 15 15 0 0 1 4-9z"/></svg>',
		'badge-star'     => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="6"/><path d="M12 5.5l.8 1.6 1.8.3-1.3 1.3.3 1.8-1.6-.8-1.6.8.3-1.8-1.3-1.3 1.8-.3z"/><path d="M8.5 13.5 6 22l6-3 6 3-2.5-8.5"/></svg>',
		'people'         => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>',
		'shield-check'   => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="m9 12 2 2 4-4"/></svg>',
		'economic-growth'=> '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M3 3v18h18"/><path d="m19 9-5 5-4-4-3 3"/><path d="M14 9h5v5"/></svg>',
		'filing-cabinet' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="3" width="10" height="18" rx="1"/><path d="M14 9h6v12h-6"/><path d="M8 7h2M8 11h2M8 15h2M17 13h1M17 17h1"/></svg>',
		'handshake'      => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="m11 17 2 2a1 1 0 0 0 1.4 0l4.3-4.3a1 1 0 0 0 0-1.4l-2.3-2.3"/><path d="m3 14 5.3-5.3a1 1 0 0 1 1.4 0l2.3 2.3"/><path d="m7 18 3-3"/><path d="m14 11 3-3"/></svg>',
		'package'        => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/></svg>',
		'globe-thin'     => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>',
		'briefcase'      => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>',
		'clipboard'      => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/><rect x="8" y="2" width="8" height="4" rx="1" ry="1"/></svg>',
		'default'        => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/></svg>',
	);
	return $icons[ $key ] ?? $icons['default'];
}

/**
 * Resolve an icon_key to an inline SVG string for repeater cards across the
 * site (homepage stat/pillar/principle cards, About capability pills, Contact
 * B2B route cards, etc). Checks the sector-icon set first, then the shared
 * home-icon set, plus a couple of special-cased aliases.
 */
function altysier_home_resolve_icon( $key ) {
	if ( 'companies' === $key ) {
		return altysier_get_market_icon( 'building' );
	}
	$sector_keys = array( 'petroleum', 'agri', 'medical', 'logistics', 'industry', 'bajaj', 'feed', 'fleet', 'trade_ship', 'transport_truck', 'default' );
	if ( in_array( $key, $sector_keys, true ) ) {
		return altysier_get_sector_icon( $key );
	}
	return altysier_get_home_icon( $key );
}

/**
 * Return an SVG icon for a market card by key.
 */
function altysier_get_market_icon( $key = 'globe' ) {
	$icons = array(
		'globe'    => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 2a14.5 14.5 0 000 20M2 12h20"/></svg>',
		'port'     => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M3 17h18l-2.2 3.3a2 2 0 01-1.7.9H6.9a2 2 0 01-1.7-.9L3 17Z"/><path d="M6 17v-6h5v6M13 17V7h4v10"/></svg>',
		'building' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="3" width="11" height="18"/><path d="M15 21V10l5 2.5V21"/><path d="M7.5 7h1M11.5 7h1M7.5 11h1M11.5 11h1M7.5 15h1M11.5 15h1"/></svg>',
		'route'    => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>',
		'pin'      => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>',
	);
	return $icons[ $key ] ?? $icons['globe'];
}

/**
 * Safely get an ACF option.
 * Wraps get_option() with a namespace prefix.
 */
if ( ! function_exists( 'altysier_get_option' ) ) {
function altysier_get_option( $key, $default = '' ) {
	// ACF Options Page stores values as altysier_{key} in wp_options
	if ( function_exists( 'get_field' ) ) {
		$val = get_field( $key, 'option' );
		if ( $val !== null && $val !== '' && $val !== false ) {
			return $val;
		}
	}
	$wp_val = get_option( 'altysier_' . $key, null );
	if ( $wp_val !== null ) {
		return $wp_val;
	}
	return $default;
}
}

