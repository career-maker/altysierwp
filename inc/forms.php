<?php
/**
 * Secure Form Processing & AJAX Handler for Altysier Group
 *
 * @package Altysier
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Rate limiting: track submissions per IP per hour
 * Returns true if rate limit exceeded
 */
function altysier_check_rate_limit( $form_id = 'contact' ) {
	$ip         = isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) : 'unknown';
	$transient  = 'altysier_rate_' . md5( $form_id . $ip );
	$count      = (int) get_transient( $transient );

	if ( $count >= 5 ) {
		return true; // Rate limit exceeded
	}

	set_transient( $transient, $count + 1, HOUR_IN_SECONDS );
	return false;
}

/**
 * Build formatted email HTML body
 */
function altysier_build_email_html( $data ) {
	$site_name = get_bloginfo( 'name' );
	$timestamp = current_time( 'D, d M Y H:i:s T' );

	$rows = array();
	foreach ( $data['fields'] as $label => $value ) {
		$rows[] = '<tr><td style="padding:10px 15px;border-bottom:1px solid #f0f0f0;font-weight:bold;color:#555;width:140px;">' .
			esc_html( $label ) . '</td><td style="padding:10px 15px;border-bottom:1px solid #f0f0f0;color:#222;">' .
			nl2br( esc_html( $value ) ) . '</td></tr>';
	}

	$body  = '<html><body style="margin:0;padding:0;font-family:Arial,sans-serif;background:#f4f4f7;">';
	$body .= '<div style="max-width:620px;margin:0 auto;background:#fff;border-radius:8px;overflow:hidden;box-shadow:0 2px 8px rgba(0,0,0,0.08);">';

	// Header
	$body .= '<div style="background:#900909;padding:25px 30px;">';
	$body .= '<div style="color:#fff;font-size:22px;font-weight:bold;letter-spacing:2px;">ALTYSIER</div>';
	$body .= '<div style="color:rgba(255,255,255,0.7);font-size:12px;letter-spacing:1px;margin-top:2px;">GROUP</div>';
	$body .= '<p style="color:rgba(255,255,255,0.85);margin:12px 0 0;font-size:14px;">New Enquiry Received â€” ' . esc_html( $data['form_source'] ) . '</p>';
	$body .= '</div>';

	// Fields table
	$body .= '<div style="padding:10px 0;">';
	$body .= '<table style="width:100%;border-collapse:collapse;">';
	$body .= implode( '', $rows );
	$body .= '</table></div>';

	// Footer
	$body .= '<div style="background:#f7f7f7;padding:20px 30px;border-top:1px solid #e0e0e0;">';
	$body .= '<p style="margin:0;color:#888;font-size:12px;">Submitted: ' . esc_html( $timestamp ) . '</p>';
	$body .= '<p style="margin:5px 0 0;color:#888;font-size:12px;">Website: ' . esc_html( get_site_url() ) . '</p>';
	$body .= '</div></div></body></html>';

	return $body;
}

/**
 * Main Contact Form AJAX Handler (homepage FAQ & Contact page)
 */
function altysier_handle_contact_form() {
	// 1. Nonce verification
	$nonce = isset( $_POST['_nonce'] ) ? sanitize_text_field( wp_unslash( $_POST['_nonce'] ) ) : ( isset( $_POST['contact_nonce'] ) ? sanitize_text_field( wp_unslash( $_POST['contact_nonce'] ) ) : '' );
	if ( ! wp_verify_nonce( $nonce, 'altysier_contact_nonce' ) ) {
		wp_send_json_error( array( 'message' => __( 'Security check failed. Please refresh the page and try again.', 'altysier' ) ), 403 );
	}

	// 2. Honeypot check (anti-spam)
	$honeypot = isset( $_POST['_hp'] ) ? sanitize_text_field( wp_unslash( $_POST['_hp'] ) ) : '';
	if ( ! empty( $honeypot ) ) {
		// Silent success to not confirm detection
		wp_send_json_success( array( 'message' => __( 'Thank you for your message. We will be in touch soon.', 'altysier' ) ) );
	}

	// 3. Rate limiting
	if ( altysier_check_rate_limit( 'contact' ) ) {
		wp_send_json_error( array( 'message' => __( 'Too many submissions. Please wait an hour before trying again.', 'altysier' ) ), 429 );
	}

	// 4. reCAPTCHA v3 verification
	$recaptcha_token = isset( $_POST['recaptcha_token'] ) ? sanitize_text_field( wp_unslash( $_POST['recaptcha_token'] ) ) : '';
	$recaptcha_check = altysier_verify_recaptcha( $recaptcha_token, 'contact_form' );
	if ( ! $recaptcha_check['success'] ) {
		wp_send_json_error( array( 'message' => $recaptcha_check['message'] ) );
	}

	// 5. Validate & sanitize input
	$name    = isset( $_POST['name'] ) ? sanitize_text_field( wp_unslash( $_POST['name'] ) ) : ( isset( $_POST['user_name'] ) ? sanitize_text_field( wp_unslash( $_POST['user_name'] ) ) : '' );
	$email   = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : ( isset( $_POST['user_email'] ) ? sanitize_email( wp_unslash( $_POST['user_email'] ) ) : '' );
	$phone   = isset( $_POST['phone'] ) ? sanitize_text_field( wp_unslash( $_POST['phone'] ) ) : ( isset( $_POST['full_phone_number'] ) ? sanitize_text_field( wp_unslash( $_POST['full_phone_number'] ) ) : ( isset( $_POST['user_phone'] ) ? sanitize_text_field( wp_unslash( $_POST['user_phone'] ) ) : '' ) );
	$company = isset( $_POST['company'] ) ? sanitize_text_field( wp_unslash( $_POST['company'] ) ) : ( isset( $_POST['user_company'] ) ? sanitize_text_field( wp_unslash( $_POST['user_company'] ) ) : '' );
	$sector  = isset( $_POST['sector'] ) ? sanitize_text_field( wp_unslash( $_POST['sector'] ) ) : ( isset( $_POST['user_subject'] ) ? sanitize_text_field( wp_unslash( $_POST['user_subject'] ) ) : '' );
	$message = isset( $_POST['message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['message'] ) ) : ( isset( $_POST['user_message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['user_message'] ) ) : '' );
	$source  = isset( $_POST['form_source'] ) ? sanitize_text_field( wp_unslash( $_POST['form_source'] ) ) : 'Website';

	if ( empty( $name ) || empty( $email ) || empty( $message ) ) {
		wp_send_json_error( array( 'message' => __( 'Please complete all required fields: Full Name, Email, and Message.', 'altysier' ) ) );
	}

	if ( ! is_email( $email ) ) {
		wp_send_json_error( array( 'message' => __( 'Please enter a valid email address.', 'altysier' ) ) );
	}

	// 6. Build and send email
	$recipient  = altysier_get_option( 'enquiry_recipient', 'manu.abhiram@gmail.com' );
	$subject    = sprintf( 'New Enquiry via Altysier Group Website â€” %s', $name );

	$email_data = array(
		'form_source' => $source,
		'fields'      => array(
			'Full Name'    => $name,
			'Email'        => $email,
			'Phone'        => $phone ? $phone : 'Not provided',
			'Company'      => $company ? $company : 'Not provided',
			'Sector'       => $sector ? $sector : 'Not provided',
			'Message'      => $message,
			'Enquiry From' => $source,
		),
	);

	$email_body = altysier_build_email_html( $email_data );

	$headers = array(
		'Content-Type: text/html; charset=UTF-8',
		'Reply-To: ' . sanitize_text_field( $name ) . ' <' . sanitize_email( $email ) . '>',
	);

	$sent = wp_mail( $recipient, $subject, $email_body, $headers );

	if ( $sent ) {
		wp_send_json_success( array(
			'message' => __( 'Thank you for reaching out. A member of our team will respond within one business day.', 'altysier' ),
		) );
	} else {
		wp_send_json_error( array(
			'message' => __( 'Your message could not be sent at this moment. Please contact us directly at info@altysier.com or call +971 4 268 0666.', 'altysier' ),
		) );
	}
}
add_action( 'wp_ajax_altysier_contact', 'altysier_handle_contact_form' );
add_action( 'wp_ajax_nopriv_altysier_contact', 'altysier_handle_contact_form' );
add_action( 'wp_ajax_altysier_contact_form', 'altysier_handle_contact_form' );
add_action( 'wp_ajax_nopriv_altysier_contact_form', 'altysier_handle_contact_form' );

