<?php
/**
 * Security Hardening for Altysier Group WordPress Theme
 *
 * @package Altysier
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// ── Security Headers ───────────────────────────────────────────────────────────
function altysier_security_headers() {
	if ( headers_sent() ) {
		return;
	}
	header_remove( 'X-Powered-By' );
	if ( ! is_admin() ) {
		header( 'X-Content-Type-Options: nosniff' );
		header( 'X-Frame-Options: SAMEORIGIN' );
		header( 'X-XSS-Protection: 1; mode=block' );
		header( 'Referrer-Policy: strict-origin-when-cross-origin' );
		header( 'Permissions-Policy: camera=(), microphone=(), geolocation=()' );
		header( "Content-Security-Policy: default-src 'self' https: data:; script-src 'self' 'unsafe-inline' 'unsafe-eval' https:; style-src 'self' 'unsafe-inline' https:; font-src 'self' data: https:; img-src 'self' data: blob: https:; media-src 'self' https: blob:; connect-src 'self' https:; frame-src 'self' https:; object-src 'none'; base-uri 'self';" );
		if ( is_ssl() ) {
			header( 'Strict-Transport-Security: max-age=31536000; includeSubDomains' );
		}
	}
}
add_action( 'send_headers', 'altysier_security_headers' );
add_action( 'template_redirect', 'altysier_security_headers' );

// ── Remove WP Version from Meta ───────────────────────────────────────────────
remove_action( 'wp_head', 'wp_generator' );

// ── Disable XML-RPC ───────────────────────────────────────────────────────────
add_filter( 'xmlrpc_enabled', '__return_false' );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );

// ── Disable REST API user enumeration ─────────────────────────────────────────
function altysier_restrict_rest_endpoints( $result ) {
	if ( ! empty( $result ) || ! is_user_logged_in() ) {
		if ( isset( $_SERVER['REQUEST_URI'] ) && strpos( $_SERVER['REQUEST_URI'], '/wp-json/wp/v2/users' ) !== false ) {
			return new WP_Error( 'rest_forbidden', __( 'Access restricted.', 'altysier' ), array( 'status' => 403 ) );
		}
	}
	return $result;
}
add_filter( 'rest_authentication_errors', 'altysier_restrict_rest_endpoints' );

// ── Remove Unnecessary Head Tags ──────────────────────────────────────────────
remove_action( 'wp_head', 'wp_shortlink_wp_head' );
remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
add_filter( 'wp_resource_hints', function( $hints, $relation_type ) {
	if ( 'dns-prefetch' === $relation_type ) {
		return array_filter( $hints, function( $hint ) {
			return false === strpos( $hint, 's.w.org' );
		} );
	}
	return $hints;
}, 10, 2 );

// ── Disable File Editor in Admin ──────────────────────────────────────────────
if ( ! defined( 'DISALLOW_FILE_EDIT' ) ) {
	define( 'DISALLOW_FILE_EDIT', true );
}

// ── Protect Admin Settings Access ─────────────────────────────────────────────
function altysier_protect_settings_pages() {
	if ( is_admin() && isset( $_GET['page'] ) && strpos( $_GET['page'], 'altysier' ) === 0 ) {
		if ( ! current_user_can( 'manage_options' ) ) {
			wp_die( esc_html__( 'You do not have permission to access this page.', 'altysier' ) );
		}
	}
}
add_action( 'admin_init', 'altysier_protect_settings_pages' );

// ── Secure admin-ajax.php direct access ───────────────────────────────────────
function altysier_sanitize_ajax_input( $input ) {
	if ( is_string( $input ) ) {
		return sanitize_text_field( $input );
	}
	if ( is_array( $input ) ) {
		return array_map( 'altysier_sanitize_ajax_input', $input );
	}
	return $input;
}

// ── Prevent Login Page Enumeration ────────────────────────────────────────────
function altysier_no_author_enumeration() {
	if ( ! is_admin() && isset( $_GET['author'] ) ) {
		wp_redirect( home_url(), 301 );
		exit;
	}
}
add_action( 'init', 'altysier_no_author_enumeration' );

// ── Disable SMTP Password in Debug Output ─────────────────────────────────────
function altysier_strip_sensitive_from_error( $message ) {
	$smtp_pass = get_option( 'altysier_smtp_password', '' );
	if ( ! empty( $smtp_pass ) ) {
		$message = str_replace( $smtp_pass, '***REDACTED***', $message );
	}
	return $message;
}
