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
 * Field Validators
 *
 * Each returns the trimmed, valid value on success or false on failure.
 * Deliberately whitelist-based (allowed characters / allowed values) rather
 * than blacklisting attack signatures — a payload that doesn't fit the
 * legitimate shape of the field (name, phone, email) is rejected regardless
 * of what it contains, so XSS/SQL-injection strings fail simply because they
 * use characters a real name/phone/email never would.
 */
function altysier_validate_name( $value ) {
	$value = trim( (string) $value );
	if ( '' === $value ) {
		return false;
	}
	if ( mb_strlen( $value ) < 2 || mb_strlen( $value ) > 100 ) {
		return false;
	}
	// Letters (any script), combining marks, spaces, hyphens, apostrophes only.
	if ( ! preg_match( '/^[\p{L}][\p{L}\p{M}\s\'\-]*$/u', $value ) ) {
		return false;
	}
	return $value;
}

function altysier_validate_phone( $value ) {
	$value = trim( (string) $value );
	if ( '' === $value ) {
		return false;
	}
	// Digits, spaces, parentheses, hyphens, and a single leading '+' only.
	if ( ! preg_match( '/^[0-9()\-\s+]+$/', $value ) ) {
		return false;
	}
	if ( substr_count( $value, '+' ) > 1 || ( false !== strpos( $value, '+' ) && 0 !== strpos( $value, '+' ) ) ) {
		return false;
	}
	$digits = preg_replace( '/\D/', '', $value );
	$len    = strlen( $digits );
	if ( $len < 10 || $len > 15 ) {
		return false;
	}
	if ( preg_match( '/^0+$/', $digits ) ) {
		return false;
	}
	return $value;
}

function altysier_validate_email_field( $value ) {
	$value = trim( (string) $value );
	if ( '' === $value ) {
		return false;
	}
	if ( strlen( $value ) > 254 ) {
		return false;
	}
	// Validate the raw trimmed value directly — never sanitize first and
	// validate the sanitized result, or a malformed/injected string could be
	// silently stripped down into something that then passes as "valid".
	if ( ! is_email( $value ) ) {
		return false;
	}
	return $value;
}

function altysier_validate_freetext( $value, $min = 2, $max = 3000 ) {
	$value = trim( (string) $value );
	if ( '' === $value ) {
		return false;
	}
	if ( mb_strlen( $value ) < $min || mb_strlen( $value ) > $max ) {
		return false;
	}
	// Must contain at least one letter or digit — rejects "special characters only".
	if ( ! preg_match( '/[\p{L}\p{N}]/u', $value ) ) {
		return false;
	}
	// Reject HTML tags, javascript: URIs, template injection, and common SQL
	// injection markers. Free text otherwise allows normal punctuation.
	if ( preg_match( '/<\s*[a-z!\/]|javascript\s*:|\{\{.*\}\}|--|;\s*--|\bdrop\s+table\b|\bunion\s+select\b/i', $value ) ) {
		return false;
	}
	return $value;
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
	$body .= '<p style="color:rgba(255,255,255,0.85);margin:12px 0 0;font-size:14px;">New Enquiry Received &mdash; ' . esc_html( $data['form_source'] ) . '</p>';
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

	// 5. Validate input
	// Read raw (only wp_unslash, no sanitize_*) so validation runs against
	// the actual submitted value — sanitizing first and validating the
	// result would let an invalid/injected string quietly get stripped
	// into something that then reads as "valid".
	$raw_name    = isset( $_POST['name'] ) ? wp_unslash( $_POST['name'] ) : ( isset( $_POST['user_name'] ) ? wp_unslash( $_POST['user_name'] ) : '' );
	$raw_email   = isset( $_POST['email'] ) ? wp_unslash( $_POST['email'] ) : ( isset( $_POST['user_email'] ) ? wp_unslash( $_POST['user_email'] ) : '' );
	$raw_message = isset( $_POST['message'] ) ? wp_unslash( $_POST['message'] ) : ( isset( $_POST['user_message'] ) ? wp_unslash( $_POST['user_message'] ) : '' );
	$raw_company = isset( $_POST['company'] ) ? wp_unslash( $_POST['company'] ) : ( isset( $_POST['user_company'] ) ? wp_unslash( $_POST['user_company'] ) : '' );
	$source      = sanitize_text_field( isset( $_POST['form_source'] ) ? wp_unslash( $_POST['form_source'] ) : 'Website' );

	// Phone / Subject are only present (and only required) on the full
	// Contact page form — the homepage form doesn't collect them.
	$has_phone_field   = isset( $_POST['phone'] ) || isset( $_POST['full_phone_number'] ) || isset( $_POST['user_phone'] );
	$has_subject_field = isset( $_POST['sector'] ) || isset( $_POST['user_subject'] );
	$raw_phone   = isset( $_POST['phone'] ) ? wp_unslash( $_POST['phone'] ) : ( isset( $_POST['full_phone_number'] ) ? wp_unslash( $_POST['full_phone_number'] ) : ( isset( $_POST['user_phone'] ) ? wp_unslash( $_POST['user_phone'] ) : '' ) );
	$raw_sector  = isset( $_POST['sector'] ) ? wp_unslash( $_POST['sector'] ) : ( isset( $_POST['user_subject'] ) ? wp_unslash( $_POST['user_subject'] ) : '' );

	$name = altysier_validate_name( $raw_name );
	if ( false === $name ) {
		wp_send_json_error( array( 'message' => __( 'Please enter a valid full name (letters only, 2-100 characters).', 'altysier' ) ) );
	}

	$email = altysier_validate_email_field( $raw_email );
	if ( false === $email ) {
		wp_send_json_error( array( 'message' => __( 'Please enter a valid email address.', 'altysier' ) ) );
	}

	$message = altysier_validate_freetext( $raw_message, 2, 3000 );
	if ( false === $message ) {
		wp_send_json_error( array( 'message' => __( 'Please enter a valid message (2-3000 characters, no code or links).', 'altysier' ) ) );
	}

	$company = trim( sanitize_text_field( $raw_company ) );

	$phone = '';
	if ( $has_phone_field ) {
		$phone = altysier_validate_phone( $raw_phone );
		if ( false === $phone ) {
			wp_send_json_error( array( 'message' => __( 'Please enter a valid phone number (10-15 digits).', 'altysier' ) ) );
		}
	}

	$sector = '';
	if ( $has_subject_field ) {
		$allowed_subjects = array(
			'International Trade & Commodities',
			'Industrial Investment & Mobility',
			'Ground Logistics & Fleet Haulage',
			'Animal Feed Manufacturing & Haloub',
			'Corporate Procurement & Fleet Leasing',
			'Supplier / Vendor Registration',
			'General Corporate Inquiry',
		);
		$raw_sector = trim( (string) $raw_sector );
		if ( ! in_array( $raw_sector, $allowed_subjects, true ) ) {
			wp_send_json_error( array( 'message' => __( 'Please select a valid inquiry category.', 'altysier' ) ) );
		}
		$sector = $raw_sector;
	}

	// 6. Build and send email
	$recipient  = altysier_get_option( 'enquiry_recipient', 'manu.abhiram@gmail.com' );
	$subject    = sprintf( 'New Enquiry via Altysier Group Website - %s', $name );

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

	$from_name  = altysier_get_option( 'mail_from_name', 'Altysier Group' );
	$from_email = function_exists( 'altysier_wp_mail_from' ) ? altysier_wp_mail_from( get_option( 'admin_email' ) ) : get_option( 'admin_email' );

	$headers = array(
		'Content-Type: text/html; charset=UTF-8',
		'From: ' . sanitize_text_field( $from_name ) . ' <' . sanitize_email( $from_email ) . '>',
		'Reply-To: ' . sanitize_text_field( $name ) . ' <' . sanitize_email( $email ) . '>',
	);

	add_action( 'wp_mail_failed', 'altysier_capture_mail_error' );
	$sent = wp_mail( $recipient, $subject, $email_body, $headers );
	remove_action( 'wp_mail_failed', 'altysier_capture_mail_error' );

	// Log the enquiry regardless of email outcome, so a mail failure never
	// means the submission itself is lost — it's still visible in wp-admin.
	$enquiry_id = altysier_save_enquiry( array(
		'name'        => $name,
		'email'       => $email,
		'phone'       => $phone,
		'company'     => $company,
		'sector'      => $sector,
		'message'     => $message,
		'form_source' => $source,
		'mail_sent'   => $sent,
	) );

	// As long as the message is either successfully sent or stored in the database,
	// inform the user that their submission was received.
	if ( $sent || $enquiry_id ) {
		wp_send_json_success( array(
			'message' => __( 'Thank you for reaching out. A member of our team will respond within one business day.', 'altysier' ),
		) );
	} else {
		global $altysier_last_mail_error;
		if ( $altysier_last_mail_error ) {
			error_log( '[Altysier Contact Form] wp_mail() failed: ' . $altysier_last_mail_error );
		}
		wp_send_json_error( array(
			'message' => __( 'Your message could not be sent at this moment. Please contact us directly at info@altysier.com or call +971 4 268 0666.', 'altysier' ),
		) );
	}
}
add_action( 'wp_ajax_altysier_contact', 'altysier_handle_contact_form' );
add_action( 'wp_ajax_nopriv_altysier_contact', 'altysier_handle_contact_form' );
add_action( 'wp_ajax_altysier_contact_form', 'altysier_handle_contact_form' );
add_action( 'wp_ajax_nopriv_altysier_contact_form', 'altysier_handle_contact_form' );

