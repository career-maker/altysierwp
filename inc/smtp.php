<?php
/**
 * SMTP Email Delivery Module for Altysier Group
 * Uses PHPMailer with Gmail SMTP authentication and secure App Password.
 *
 * @package Altysier
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Configure PHPMailer with Gmail SMTP Credentials
 *
 * @param PHPMailer\PHPMailer\PHPMailer $phpmailer
 */
function altysier_configure_smtp( $phpmailer ) {
	$smtp_enabled = (bool) altysier_get_option( 'smtp_enabled', 1 );
	if ( ! $smtp_enabled ) {
		return;
	}

	$host       = altysier_get_option( 'smtp_host', 'smtp-relay.brevo.com' );
	$port       = (int) altysier_get_option( 'smtp_port', 587 );
	$encryption = altysier_get_option( 'smtp_encryption', 'tls' );
	$username   = altysier_get_option( 'smtp_username', 'admin@altysier.com' );
	$password   = altysier_get_option( 'smtp_password', 'Abrevo@25&' );
	$from_email = altysier_get_option( 'mail_from_email', $username ? $username : get_option( 'admin_email' ) );
	$from_name  = altysier_get_option( 'mail_from_name', 'Altysier Group' );

	if ( empty( $password ) ) {
		return; // Fallback to local mail / Mailpit until Gmail app password is saved
	}

	$phpmailer->isSMTP();
	$phpmailer->Host       = $host;
	$phpmailer->SMTPAuth   = true;
	$phpmailer->Port       = $port;
	$phpmailer->Username   = $username;
	$phpmailer->Password   = $password;
	$phpmailer->SMTPSecure = ( 'none' === $encryption ) ? '' : $encryption;

	// Removed forced From and FromName here so wp_mail headers and filters are respected.

	// SSL options for local development if needed
	$phpmailer->SMTPOptions = array(
		'ssl' => array(
			'verify_peer'       => false,
			'verify_peer_name'  => false,
			'allow_self_signed' => true,
		),
	);
}
add_action( 'phpmailer_init', 'altysier_configure_smtp' );

/**
 * Custom sender email address
 */
function altysier_wp_mail_from( $email ) {
	// If a custom from email is already set (not the default wordpress@), respect it.
	if ( strpos( $email, 'wordpress@' ) === false && strpos( $email, 'www-data@' ) === false ) {
		return $email;
	}

	$from = altysier_get_option( 'mail_from_email', 'admin@altysier.com' );
	if ( ! empty( $from ) && is_email( $from ) ) {
		return $from;
	}
	$smtp_password = altysier_get_option( 'smtp_password', '' );
	if ( ! empty( $smtp_password ) ) {
		$user = altysier_get_option( 'smtp_username', '' );
		if ( ! empty( $user ) && is_email( $user ) ) {
			return $user;
		}
	}
	// When using local mail (no SMTP credentials), use server domain sender to satisfy Exim sender verify
	$server_host = isset( $_SERVER['SERVER_NAME'] ) ? sanitize_text_field( wp_unslash( $_SERVER['SERVER_NAME'] ) ) : '';
	$server_host = preg_replace( '/^www\./', '', $server_host );
	if ( ! empty( $server_host ) && false === strpos( $server_host, 'localhost' ) ) {
		return 'noreply@' . $server_host;
	}
	return $email;
}
add_filter( 'wp_mail_from', 'altysier_wp_mail_from' );

/**
 * Custom sender display name
 */
function altysier_wp_mail_from_name( $name ) {
	$custom_name = altysier_get_option( 'mail_from_name', 'Altysier Group' );
	return ( ! empty( $custom_name ) && $name === 'WordPress' ) ? $custom_name : $name;
}
add_filter( 'wp_mail_from_name', 'altysier_wp_mail_from_name' );

/**
 * Handle Send Test Email Admin POST Request
 */
function altysier_handle_send_test_email() {
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( esc_html__( 'Unauthorized access.', 'altysier' ) );
	}

	check_admin_referer( 'altysier_test_email_nonce', 'altysier_test_nonce' );

	$recipient = isset( $_POST['test_recipient'] ) ? sanitize_email( $_POST['test_recipient'] ) : '';
	if ( ! is_email( $recipient ) ) {
		$recipient = altysier_get_option( 'enquiry_recipient', 'admin@altysier.com' );
	}

	$subject = sprintf( __( '[Test Email] Altysier Group Website SMTP Check (%s)', 'altysier' ), wp_date( 'Y-m-d H:i:s' ) );
	
	$message  = "<html><body style='font-family: Arial, sans-serif; line-height: 1.6; color: #222;'>";
	$message .= "<div style='max-width: 600px; margin: 0 auto; border: 1px solid #e0e0e0; border-radius: 8px; overflow: hidden;'>";
	$message .= "<div style='background: #900909; padding: 20px; color: #fff; text-align: center;'><h2 style='margin: 0;'>Altysier Group</h2><p style='margin: 5px 0 0;'>SMTP Verification Successful</p></div>";
	$message .= "<div style='padding: 25px;'>";
	$message .= "<p>Hello Administrator,</p>";
	$message .= "<p>This is a confirmation that your Brevo SMTP configuration on <strong>" . esc_html( get_bloginfo( 'name' ) ) . "</strong> is functioning properly.</p>";
	$message .= "<table style='width: 100%; border-collapse: collapse; margin: 20px 0;'>";
	$message .= "<tr><td style='padding: 8px; border-bottom: 1px solid #eee; font-weight: bold;'>SMTP Host:</td><td style='padding: 8px; border-bottom: 1px solid #eee;'>" . esc_html( altysier_get_option( 'smtp_host', 'smtp-relay.brevo.com' ) ) . "</td></tr>";
	$message .= "<tr><td style='padding: 8px; border-bottom: 1px solid #eee; font-weight: bold;'>SMTP Port:</td><td style='padding: 8px; border-bottom: 1px solid #eee;'>" . esc_html( altysier_get_option( 'smtp_port', '587' ) ) . "</td></tr>";
	$message .= "<tr><td style='padding: 8px; border-bottom: 1px solid #eee; font-weight: bold;'>Sender:</td><td style='padding: 8px; border-bottom: 1px solid #eee;'>" . esc_html( altysier_get_option( 'smtp_username', 'admin@altysier.com' ) ) . "</td></tr>";
	$message .= "<tr><td style='padding: 8px; border-bottom: 1px solid #eee; font-weight: bold;'>Server Time:</td><td style='padding: 8px; border-bottom: 1px solid #eee;'>" . esc_html( current_time( 'mysql' ) ) . "</td></tr>";
	$message .= "</table>";
	$message .= "<p style='color: #666; font-size: 13px;'>You are ready to receive contact and enquiry submissions reliably in this inbox.</p>";
	$message .= "</div></div></body></html>";

	$headers = array(
		'Content-Type: text/html; charset=UTF-8',
	);

	add_action( 'phpmailer_init', function( $phpmailer ) {
		$phpmailer->SMTPDebug = 3;
		$phpmailer->Debugoutput = 'html';
	} );

	add_action( 'wp_mail_failed', 'altysier_capture_mail_error' );
	$sent = wp_mail( $recipient, $subject, $message, $headers );
	remove_action( 'wp_mail_failed', 'altysier_capture_mail_error' );

	echo '<div style="background:#fff;padding:20px;border:2px solid red;margin:20px;"><h3>SMTP Debug Log (Scroll up to see the Brevo response):</h3><a href="javascript:history.back()">Go back</a></div>';
	die();

	$redirect_url = admin_url( 'admin.php?page=altysier-smtp-settings' );
	if ( $sent ) {
		$redirect_url = add_query_arg( 'test_email_sent', '1', $redirect_url );
	} else {
		global $altysier_last_mail_error;
		$error_msg = $altysier_last_mail_error ? $altysier_last_mail_error : 'Failed to connect or authenticate with SMTP server.';
		$redirect_url = add_query_arg( array(
			'test_email_sent' => '0',
			'error'           => urlencode( $error_msg ),
		), $redirect_url );
	}

	wp_safe_redirect( $redirect_url );
	exit;
}
add_action( 'admin_post_altysier_send_test_email', 'altysier_handle_send_test_email' );

/**
 * Capture WP Mail Error for Admin Reporting
 */
function altysier_capture_mail_error( $wp_error ) {
	global $altysier_last_mail_error;
	if ( is_wp_error( $wp_error ) ) {
		$altysier_last_mail_error = $wp_error->get_error_message();
	}
}

