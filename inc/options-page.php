<?php
/**
 * Global Options Page & Settings Management for Altysier Group
 *
 * @package Altysier
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register ACF Options Page if ACF PRO function exists
 */
if ( function_exists( 'acf_add_options_page' ) ) {
	acf_add_options_page( array(
		'page_title' => __( 'Altysier Global Settings', 'altysier' ),
		'menu_title' => __( 'Altysier Settings', 'altysier' ),
		'menu_slug'  => 'altysier-global-settings',
		'capability' => 'manage_options',
		'redirect'   => false,
		'icon_url'   => 'dashicons-admin-generic',
		'position'   => 2,
	) );

	acf_add_options_sub_page( array(
		'page_title'  => __( 'Email & SMTP Settings', 'altysier' ),
		'menu_title'  => __( 'Email & SMTP', 'altysier' ),
		'menu_slug'   => 'altysier-smtp-settings',
		'parent_slug' => 'altysier-global-settings',
	) );

	acf_add_options_sub_page( array(
		'page_title'  => __( 'Security & reCAPTCHA', 'altysier' ),
		'menu_title'  => __( 'Security & reCAPTCHA', 'altysier' ),
		'menu_slug'   => 'altysier-recaptcha-settings',
		'parent_slug' => 'altysier-global-settings',
	) );

	acf_add_options_sub_page( array(
		'page_title'  => __( '404 Page Content', 'altysier' ),
		'menu_title'  => __( '404 Page', 'altysier' ),
		'menu_slug'   => 'altysier-404-settings',
		'parent_slug' => 'altysier-global-settings',
	) );
}

/**
 * Universal Options Getter
 * Priority: ACF Option -> WordPress Option -> Default Value
 *
 * @param string $key Option key
 * @param mixed $default Fallback value
 * @return mixed
 */
if ( ! function_exists( 'altysier_get_option' ) ) {
function altysier_get_option( $key, $default = '' ) {
	if ( function_exists( 'get_field' ) ) {
		$acf_val = get_field( $key, 'option' );
		if ( ! empty( $acf_val ) ) {
			return $acf_val;
		}
	}

	$wp_val = get_option( 'altysier_' . $key );
	if ( false !== $wp_val && '' !== $wp_val ) {
		return $wp_val;
	}

	return $default;
}
}

/**
 * Register Native WordPress Settings Page (Runs in all environments)
 */
function altysier_register_native_settings_page() {
	add_menu_page(
		__( 'Altysier Group Settings', 'altysier' ),
		__( 'Altysier Settings', 'altysier' ),
		'manage_options',
		'altysier-settings',
		'altysier_render_settings_page',
		'dashicons-admin-generic',
		2
	);
}
// If ACF Options page is not active, add native menu page
if ( ! function_exists( 'acf_add_options_page' ) ) {
	add_action( 'admin_menu', 'altysier_register_native_settings_page' );
}

/**
 * Register Settings in WordPress
 */
function altysier_register_settings() {
	$options = array(
		// Branding
		'altysier_site_logo',
		'altysier_site_logo_dark',
		'altysier_favicon',
		'altysier_primary_color',
		'altysier_accent_color',
		'altysier_enable_preloader',

		// Contact & Offices
		'altysier_dubai_address',
		'altysier_dubai_phone',
		'altysier_dubai_whatsapp',
		'altysier_dubai_email',
		'altysier_dubai_map_url',
		'altysier_saudi_address',
		'altysier_saudi_map_url',
		'altysier_khartoum_address',
		'altysier_khartoum_email',
		'altysier_khartoum_phone',
		'altysier_khartoum_map_url',

		// Social Links
		'altysier_social_linkedin',
		'altysier_social_instagram',
		'altysier_social_twitter',
		'altysier_social_facebook',

		// Email & SMTP
		'altysier_smtp_enabled',
		'altysier_smtp_host',
		'altysier_smtp_port',
		'altysier_smtp_encryption',
		'altysier_smtp_auth',
		'altysier_smtp_username',
		'altysier_smtp_password',
		'altysier_enquiry_recipient',
		'altysier_mail_from_name',
		'altysier_mail_from_email',

		// reCAPTCHA v3
		'altysier_recaptcha_enabled',
		'altysier_recaptcha_site_key',
		'altysier_recaptcha_secret_key',
		'altysier_recaptcha_threshold',

		// Footer & Global
		'altysier_footer_blurb',
		'altysier_footer_copyright',
		'altysier_cta_default_heading',
		'altysier_cta_default_text',
		'altysier_cta_default_link',

		// 404 Page
		'altysier_error_page_bg_image',
		'altysier_error_page_title',
		'altysier_error_page_text',
		'altysier_error_page_btn1_label',
		'altysier_error_page_btn1_link',
		'altysier_error_page_btn2_label',
		'altysier_error_page_btn2_link',
	);

	foreach ( $options as $opt ) {
		register_setting( 'altysier_settings_group', $opt );
	}
}
add_action( 'admin_init', 'altysier_register_settings' );

/**
 * Render the Native Settings Page with Tabs
 */
function altysier_render_settings_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	$active_tab = isset( $_GET['tab'] ) ? sanitize_text_field( $_GET['tab'] ) : 'general';
	?>
	<div class="wrap" style="max-width: 1100px;">
		<h1 style="display: flex; align-items: center; gap: 10px;">
			<span class="dashicons dashicons-admin-generic" style="font-size: 32px; width: 32px; height: 32px; color: #dc080c;"></span>
			<?php echo esc_html( get_admin_page_title() ); ?>
		</h1>

		<?php if ( isset( $_GET['settings-updated'] ) && $_GET['settings-updated'] ) : ?>
			<div class="notice notice-success is-dismissible">
				<p><strong><?php esc_html_e( 'Altysier settings saved successfully.', 'altysier' ); ?></strong></p>
			</div>
		<?php endif; ?>

		<h2 class="nav-tab-wrapper" style="margin-top: 20px;">
			<a href="?page=altysier-settings&tab=general" class="nav-tab <?php echo $active_tab === 'general' ? 'nav-tab-active' : ''; ?>"><?php esc_html_e( 'General & Branding', 'altysier' ); ?></a>
			<a href="?page=altysier-settings&tab=offices" class="nav-tab <?php echo $active_tab === 'offices' ? 'nav-tab-active' : ''; ?>"><?php esc_html_e( 'Offices & Contact', 'altysier' ); ?></a>
			<a href="?page=altysier-settings&tab=social" class="nav-tab <?php echo $active_tab === 'social' ? 'nav-tab-active' : ''; ?>"><?php esc_html_e( 'Social Links', 'altysier' ); ?></a>
			<a href="?page=altysier-settings&tab=smtp" class="nav-tab <?php echo $active_tab === 'smtp' ? 'nav-tab-active' : ''; ?>"><?php esc_html_e( 'Gmail SMTP Delivery', 'altysier' ); ?></a>
			<a href="?page=altysier-settings&tab=recaptcha" class="nav-tab <?php echo $active_tab === 'recaptcha' ? 'nav-tab-active' : ''; ?>"><?php esc_html_e( 'Google reCAPTCHA v3', 'altysier' ); ?></a>
			<a href="?page=altysier-settings&tab=footer" class="nav-tab <?php echo $active_tab === 'footer' ? 'nav-tab-active' : ''; ?>"><?php esc_html_e( 'Footer & Global CTA', 'altysier' ); ?></a>
			<a href="?page=altysier-settings&tab=error404" class="nav-tab <?php echo $active_tab === 'error404' ? 'nav-tab-active' : ''; ?>"><?php esc_html_e( '404 Page', 'altysier' ); ?></a>
		</h2>

		<form action="options.php" method="post" style="background: #fff; padding: 25px; border: 1px solid #ccd0d4; box-shadow: 0 1px 1px rgba(0,0,0,.04); margin-top: 15px; border-radius: 4px;">
			<?php
			settings_fields( 'altysier_settings_group' );

			if ( 'general' === $active_tab ) :
			?>
				<table class="form-table">
					<tr>
						<th scope="row"><label for="altysier_site_logo"><?php esc_html_e( 'Primary Logo URL', 'altysier' ); ?></label></th>
						<td>
							<input type="text" id="altysier_site_logo" name="altysier_site_logo" value="<?php echo esc_attr( get_option( 'altysier_site_logo', '' ) ); ?>" class="regular-text" placeholder="e.g. /wp-content/themes/altysier/assets/img/logo-icon.png">
							<p class="description"><?php esc_html_e( 'Leave blank to use default theme logo mark (img/logo-icon.png).', 'altysier' ); ?></p>
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="altysier_favicon"><?php esc_html_e( 'Favicon URL', 'altysier' ); ?></label></th>
						<td>
							<input type="text" id="altysier_favicon" name="altysier_favicon" value="<?php echo esc_attr( get_option( 'altysier_favicon', '' ) ); ?>" class="regular-text">
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="altysier_enable_preloader"><?php esc_html_e( 'Enable Brand Preloader', 'altysier' ); ?></label></th>
						<td>
							<label>
								<input type="checkbox" id="altysier_enable_preloader" name="altysier_enable_preloader" value="1" <?php checked( 1, get_option( 'altysier_enable_preloader', 1 ) ); ?>>
								<?php esc_html_e( 'Enable the animated split-character counter preloader on page load.', 'altysier' ); ?>
							</label>
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="altysier_primary_color"><?php esc_html_e( 'Primary Brand Ink Color', 'altysier' ); ?></label></th>
						<td>
							<input type="text" id="altysier_primary_color" name="altysier_primary_color" value="<?php echo esc_attr( get_option( 'altysier_primary_color', '#900909' ) ); ?>" class="regular-text" style="width: 120px;">
							<p class="description"><?php esc_html_e( 'Default: #900909 (Altysier Ink)', 'altysier' ); ?></p>
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="altysier_accent_color"><?php esc_html_e( 'Accent Red Color', 'altysier' ); ?></label></th>
						<td>
							<input type="text" id="altysier_accent_color" name="altysier_accent_color" value="<?php echo esc_attr( get_option( 'altysier_accent_color', '#dc080c' ) ); ?>" class="regular-text" style="width: 120px;">
							<p class="description"><?php esc_html_e( 'Default: #dc080c (Altysier Bright Red)', 'altysier' ); ?></p>
						</td>
					</tr>
				</table>

			<?php elseif ( 'offices' === $active_tab ) : ?>
				<h3><?php esc_html_e( 'Dubai HQ Office', 'altysier' ); ?></h3>
				<table class="form-table">
					<tr>
						<th scope="row"><label for="altysier_dubai_address"><?php esc_html_e( 'Dubai Address', 'altysier' ); ?></label></th>
						<td><input type="text" id="altysier_dubai_address" name="altysier_dubai_address" value="<?php echo esc_attr( get_option( 'altysier_dubai_address', 'Dubai, United Arab Emirates' ) ); ?>" class="large-text"></td>
					</tr>
					<tr>
						<th scope="row"><label for="altysier_dubai_phone"><?php esc_html_e( 'Dubai Phone', 'altysier' ); ?></label></th>
						<td><input type="text" id="altysier_dubai_phone" name="altysier_dubai_phone" value="<?php echo esc_attr( get_option( 'altysier_dubai_phone', '+971 4 268 0666' ) ); ?>" class="regular-text"></td>
					</tr>
					<tr>
						<th scope="row"><label for="altysier_dubai_whatsapp"><?php esc_html_e( 'WhatsApp Number', 'altysier' ); ?></label></th>
						<td><input type="text" id="altysier_dubai_whatsapp" name="altysier_dubai_whatsapp" value="<?php echo esc_attr( get_option( 'altysier_dubai_whatsapp', '+971 56 144 2525' ) ); ?>" class="regular-text"></td>
					</tr>
					<tr>
						<th scope="row"><label for="altysier_dubai_email"><?php esc_html_e( 'Dubai Email', 'altysier' ); ?></label></th>
						<td><input type="email" id="altysier_dubai_email" name="altysier_dubai_email" value="<?php echo esc_attr( get_option( 'altysier_dubai_email', 'info@altysier.com' ) ); ?>" class="regular-text"></td>
					</tr>
					<tr>
						<th scope="row"><label for="altysier_dubai_map_url"><?php esc_html_e( 'Dubai Map Link', 'altysier' ); ?></label></th>
						<td><input type="url" id="altysier_dubai_map_url" name="altysier_dubai_map_url" value="<?php echo esc_attr( get_option( 'altysier_dubai_map_url', 'https://maps.google.com/?q=Dubai,+United+Arab+Emirates' ) ); ?>" class="large-text"></td>
					</tr>
				</table>

				<h3><?php esc_html_e( 'Saudi Arabia Office', 'altysier' ); ?></h3>
				<table class="form-table">
					<tr>
						<th scope="row"><label for="altysier_saudi_address"><?php esc_html_e( 'Saudi Address', 'altysier' ); ?></label></th>
						<td><input type="text" id="altysier_saudi_address" name="altysier_saudi_address" value="<?php echo esc_attr( get_option( 'altysier_saudi_address', 'Riyadh, Saudi Arabia' ) ); ?>" class="large-text"></td>
					</tr>
					<tr>
						<th scope="row"><label for="altysier_saudi_map_url"><?php esc_html_e( 'Saudi Map Link', 'altysier' ); ?></label></th>
						<td><input type="url" id="altysier_saudi_map_url" name="altysier_saudi_map_url" value="<?php echo esc_attr( get_option( 'altysier_saudi_map_url', 'https://maps.google.com/?q=Riyadh,+Saudi+Arabia' ) ); ?>" class="large-text"></td>
					</tr>
				</table>

				<h3><?php esc_html_e( 'Sudan Regional Office', 'altysier' ); ?></h3>
				<table class="form-table">
					<tr>
						<th scope="row"><label for="altysier_khartoum_address"><?php esc_html_e( 'Sudan Address', 'altysier' ); ?></label></th>
						<td><input type="text" id="altysier_khartoum_address" name="altysier_khartoum_address" value="<?php echo esc_attr( get_option( 'altysier_khartoum_address', 'Khartoum, Sudan' ) ); ?>" class="large-text"></td>
					</tr>
					<tr>
						<th scope="row"><label for="altysier_khartoum_email"><?php esc_html_e( 'Sudan Email', 'altysier' ); ?></label></th>
						<td><input type="email" id="altysier_khartoum_email" name="altysier_khartoum_email" value="<?php echo esc_attr( get_option( 'altysier_khartoum_email', 'info@altysier.com' ) ); ?>" class="regular-text"></td>
					</tr>
					<tr>
						<th scope="row"><label for="altysier_khartoum_map_url"><?php esc_html_e( 'Sudan Map Link', 'altysier' ); ?></label></th>
						<td><input type="url" id="altysier_khartoum_map_url" name="altysier_khartoum_map_url" value="<?php echo esc_attr( get_option( 'altysier_khartoum_map_url', 'https://maps.google.com/?q=Khartoum,+Sudan' ) ); ?>" class="large-text"></td>
					</tr>
				</table>

			<?php elseif ( 'social' === $active_tab ) : ?>
				<table class="form-table">
					<tr>
						<th scope="row"><label for="altysier_social_linkedin"><?php esc_html_e( 'LinkedIn URL', 'altysier' ); ?></label></th>
						<td><input type="url" id="altysier_social_linkedin" name="altysier_social_linkedin" value="<?php echo esc_attr( get_option( 'altysier_social_linkedin', '#' ) ); ?>" class="large-text"></td>
					</tr>
					<tr>
						<th scope="row"><label for="altysier_social_instagram"><?php esc_html_e( 'Instagram URL', 'altysier' ); ?></label></th>
						<td><input type="url" id="altysier_social_instagram" name="altysier_social_instagram" value="<?php echo esc_attr( get_option( 'altysier_social_instagram', '#' ) ); ?>" class="large-text"></td>
					</tr>
					<tr>
						<th scope="row"><label for="altysier_social_twitter"><?php esc_html_e( 'X / Twitter URL', 'altysier' ); ?></label></th>
						<td><input type="url" id="altysier_social_twitter" name="altysier_social_twitter" value="<?php echo esc_attr( get_option( 'altysier_social_twitter', '#' ) ); ?>" class="large-text"></td>
					</tr>
					<tr>
						<th scope="row"><label for="altysier_social_facebook"><?php esc_html_e( 'Facebook URL', 'altysier' ); ?></label></th>
						<td><input type="url" id="altysier_social_facebook" name="altysier_social_facebook" value="<?php echo esc_attr( get_option( 'altysier_social_facebook', '#' ) ); ?>" class="large-text"></td>
					</tr>
				</table>

			<?php elseif ( 'smtp' === $active_tab ) : ?>
				<div class="notice notice-info inline" style="margin-left: 0;">
					<p><?php esc_html_e( 'Configure Gmail SMTP for reliable enquiry form submissions. Enquiries will be delivered directly to the configured recipient email address.', 'altysier' ); ?></p>
				</div>
				<table class="form-table">
					<tr>
						<th scope="row"><label for="altysier_smtp_enabled"><?php esc_html_e( 'Enable SMTP Delivery', 'altysier' ); ?></label></th>
						<td>
							<label>
								<input type="checkbox" id="altysier_smtp_enabled" name="altysier_smtp_enabled" value="1" <?php checked( 1, get_option( 'altysier_smtp_enabled', 1 ) ); ?>>
								<?php esc_html_e( 'Use authenticated SMTP instead of basic PHP mail().', 'altysier' ); ?>
							</label>
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="altysier_enquiry_recipient"><?php esc_html_e( 'Enquiry Recipient Email', 'altysier' ); ?></label></th>
						<td>
							<input type="email" id="altysier_enquiry_recipient" name="altysier_enquiry_recipient" value="<?php echo esc_attr( get_option( 'altysier_enquiry_recipient', 'manu.abhiram@gmail.com' ) ); ?>" class="regular-text" required>
							<p class="description"><?php esc_html_e( 'All website contact submissions will be sent to this email address.', 'altysier' ); ?></p>
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="altysier_smtp_username"><?php esc_html_e( 'Gmail / SMTP Address', 'altysier' ); ?></label></th>
						<td>
							<input type="email" id="altysier_smtp_username" name="altysier_smtp_username" value="<?php echo esc_attr( get_option( 'altysier_smtp_username', 'manu.abhiram@gmail.com' ) ); ?>" class="regular-text">
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="altysier_smtp_password"><?php esc_html_e( 'Gmail App Password', 'altysier' ); ?></label></th>
						<td>
							<input type="password" id="altysier_smtp_password" name="altysier_smtp_password" value="<?php echo esc_attr( get_option( 'altysier_smtp_password', '' ) ); ?>" class="regular-text" autocomplete="new-password">
							<p class="description"><?php esc_html_e( 'Use your 16-character Google Account App Password. It is securely saved in the database and never printed in frontend code.', 'altysier' ); ?></p>
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="altysier_smtp_host"><?php esc_html_e( 'SMTP Host', 'altysier' ); ?></label></th>
						<td><input type="text" id="altysier_smtp_host" name="altysier_smtp_host" value="<?php echo esc_attr( get_option( 'altysier_smtp_host', 'smtp.gmail.com' ) ); ?>" class="regular-text"></td>
					</tr>
					<tr>
						<th scope="row"><label for="altysier_smtp_port"><?php esc_html_e( 'SMTP Port', 'altysier' ); ?></label></th>
						<td><input type="number" id="altysier_smtp_port" name="altysier_smtp_port" value="<?php echo esc_attr( get_option( 'altysier_smtp_port', '587' ) ); ?>" class="small-text"></td>
					</tr>
					<tr>
						<th scope="row"><label for="altysier_smtp_encryption"><?php esc_html_e( 'Encryption', 'altysier' ); ?></label></th>
						<td>
							<select id="altysier_smtp_encryption" name="altysier_smtp_encryption">
								<option value="tls" <?php selected( 'tls', get_option( 'altysier_smtp_encryption', 'tls' ) ); ?>>TLS (Port 587 recommended)</option>
								<option value="ssl" <?php selected( 'ssl', get_option( 'altysier_smtp_encryption', 'tls' ) ); ?>>SSL (Port 465)</option>
								<option value="none" <?php selected( 'none', get_option( 'altysier_smtp_encryption', 'tls' ) ); ?>>None</option>
							</select>
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="altysier_mail_from_name"><?php esc_html_e( 'Sender Name', 'altysier' ); ?></label></th>
						<td><input type="text" id="altysier_mail_from_name" name="altysier_mail_from_name" value="<?php echo esc_attr( get_option( 'altysier_mail_from_name', 'Altysier Group Website' ) ); ?>" class="regular-text"></td>
					</tr>
				</table>

			<?php elseif ( 'recaptcha' === $active_tab ) : ?>
				<div class="notice notice-info inline" style="margin-left: 0;">
					<p><?php esc_html_e( 'Google reCAPTCHA v3 protects your enquiry forms from spam and bots without presenting user challenges.', 'altysier' ); ?></p>
				</div>
				<table class="form-table">
					<tr>
						<th scope="row"><label for="altysier_recaptcha_enabled"><?php esc_html_e( 'Enable reCAPTCHA v3', 'altysier' ); ?></label></th>
						<td>
							<label>
								<input type="checkbox" id="altysier_recaptcha_enabled" name="altysier_recaptcha_enabled" value="1" <?php checked( 1, get_option( 'altysier_recaptcha_enabled', 0 ) ); ?>>
								<?php esc_html_e( 'Enable Google reCAPTCHA v3 verification on enquiry forms.', 'altysier' ); ?>
							</label>
							<p class="description"><?php esc_html_e( 'When disabled, forms use server-side nonce validation, honeypot filters, and rate-limiting.', 'altysier' ); ?></p>
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="altysier_recaptcha_site_key"><?php esc_html_e( 'reCAPTCHA Site Key', 'altysier' ); ?></label></th>
						<td>
							<input type="text" id="altysier_recaptcha_site_key" name="altysier_recaptcha_site_key" value="<?php echo esc_attr( get_option( 'altysier_recaptcha_site_key', '' ) ); ?>" class="large-text">
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="altysier_recaptcha_secret_key"><?php esc_html_e( 'reCAPTCHA Secret Key', 'altysier' ); ?></label></th>
						<td>
							<input type="password" id="altysier_recaptcha_secret_key" name="altysier_recaptcha_secret_key" value="<?php echo esc_attr( get_option( 'altysier_recaptcha_secret_key', '' ) ); ?>" class="large-text" autocomplete="new-password">
							<p class="description"><?php esc_html_e( 'Never exposed in HTML or frontend scripts. Handled strictly on the server.', 'altysier' ); ?></p>
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="altysier_recaptcha_threshold"><?php esc_html_e( 'Score Threshold', 'altysier' ); ?></label></th>
						<td>
							<input type="number" step="0.1" min="0.1" max="1.0" id="altysier_recaptcha_threshold" name="altysier_recaptcha_threshold" value="<?php echo esc_attr( get_option( 'altysier_recaptcha_threshold', '0.5' ) ); ?>" class="small-text">
							<p class="description"><?php esc_html_e( 'Default is 0.5. Scores below this threshold are rejected as potential automated spam.', 'altysier' ); ?></p>
						</td>
					</tr>
				</table>

			<?php elseif ( 'footer' === $active_tab ) : ?>
				<table class="form-table">
					<tr>
						<th scope="row"><label for="altysier_footer_blurb"><?php esc_html_e( 'Footer Description', 'altysier' ); ?></label></th>
						<td>
							<textarea id="altysier_footer_blurb" name="altysier_footer_blurb" rows="3" class="large-text"><?php echo esc_textarea( get_option( 'altysier_footer_blurb', 'A diversified business group building long-term value across international trade, industry and mobility.' ) ); ?></textarea>
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="altysier_footer_copyright"><?php esc_html_e( 'Copyright Line', 'altysier' ); ?></label></th>
						<td>
							<input type="text" id="altysier_footer_copyright" name="altysier_footer_copyright" value="<?php echo esc_attr( get_option( 'altysier_footer_copyright', 'Altysier Group. All rights reserved.' ) ); ?>" class="large-text">
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="altysier_cta_default_heading"><?php esc_html_e( 'Global CTA Heading', 'altysier' ); ?></label></th>
						<td>
							<input type="text" id="altysier_cta_default_heading" name="altysier_cta_default_heading" value="<?php echo esc_attr( get_option( 'altysier_cta_default_heading', "Let's Build Stronger Partnerships Together." ) ); ?>" class="large-text">
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="altysier_cta_default_text"><?php esc_html_e( 'Global CTA Description', 'altysier' ); ?></label></th>
						<td>
							<textarea id="altysier_cta_default_text" name="altysier_cta_default_text" rows="2" class="large-text"><?php echo esc_textarea( get_option( 'altysier_cta_default_text', 'Connecting markets, creating sustainable value, and driving growth across essential sectors.' ) ); ?></textarea>
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="altysier_cta_default_link"><?php esc_html_e( 'Global CTA Button Link', 'altysier' ); ?></label></th>
						<td>
							<input type="text" id="altysier_cta_default_link" name="altysier_cta_default_link" value="<?php echo esc_attr( get_option( 'altysier_cta_default_link', '/contact/' ) ); ?>" class="regular-text">
						</td>
					</tr>
				</table>

			<?php elseif ( 'error404' === $active_tab ) : ?>
				<div class="notice notice-info inline" style="margin-left: 0;">
					<p><?php esc_html_e( 'Controls the content shown on the 404 (page not found) error page. The four "Helpful Links" cards below the buttons are managed from the ACF-powered 404 Page settings sub-page when ACF Pro is active.', 'altysier' ); ?></p>
				</div>
				<table class="form-table">
					<tr>
						<th scope="row"><label for="altysier_error_page_bg_image"><?php esc_html_e( 'Background Image URL', 'altysier' ); ?></label></th>
						<td>
							<input type="text" id="altysier_error_page_bg_image" name="altysier_error_page_bg_image" value="<?php echo esc_attr( get_option( 'altysier_error_page_bg_image', '' ) ); ?>" class="large-text" placeholder="Leave blank to use the default background photo.">
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="altysier_error_page_title"><?php esc_html_e( 'Title', 'altysier' ); ?></label></th>
						<td>
							<input type="text" id="altysier_error_page_title" name="altysier_error_page_title" value="<?php echo esc_attr( get_option( 'altysier_error_page_title', 'Destination Unavailable' ) ); ?>" class="large-text">
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="altysier_error_page_text"><?php esc_html_e( 'Description', 'altysier' ); ?></label></th>
						<td>
							<textarea id="altysier_error_page_text" name="altysier_error_page_text" rows="3" class="large-text"><?php echo esc_textarea( get_option( 'altysier_error_page_text', 'The page you are attempting to access does not exist, has been relocated, or is temporarily unavailable across our network. Please use the navigation links below to redirect your query.' ) ); ?></textarea>
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="altysier_error_page_btn1_label"><?php esc_html_e( 'Primary Button Label', 'altysier' ); ?></label></th>
						<td><input type="text" id="altysier_error_page_btn1_label" name="altysier_error_page_btn1_label" value="<?php echo esc_attr( get_option( 'altysier_error_page_btn1_label', 'Return to Home' ) ); ?>" class="regular-text"></td>
					</tr>
					<tr>
						<th scope="row"><label for="altysier_error_page_btn1_link"><?php esc_html_e( 'Primary Button Link', 'altysier' ); ?></label></th>
						<td><input type="text" id="altysier_error_page_btn1_link" name="altysier_error_page_btn1_link" value="<?php echo esc_attr( get_option( 'altysier_error_page_btn1_link', '/' ) ); ?>" class="regular-text"></td>
					</tr>
					<tr>
						<th scope="row"><label for="altysier_error_page_btn2_label"><?php esc_html_e( 'Secondary Button Label', 'altysier' ); ?></label></th>
						<td><input type="text" id="altysier_error_page_btn2_label" name="altysier_error_page_btn2_label" value="<?php echo esc_attr( get_option( 'altysier_error_page_btn2_label', 'Our Companies' ) ); ?>" class="regular-text"></td>
					</tr>
					<tr>
						<th scope="row"><label for="altysier_error_page_btn2_link"><?php esc_html_e( 'Secondary Button Link', 'altysier' ); ?></label></th>
						<td><input type="text" id="altysier_error_page_btn2_link" name="altysier_error_page_btn2_link" value="<?php echo esc_attr( get_option( 'altysier_error_page_btn2_link', '/#companies' ) ); ?>" class="regular-text"></td>
					</tr>
				</table>
			<?php endif; ?>

			<?php submit_button( __( 'Save All Changes', 'altysier' ) ); ?>
		</form>
	</div>
	<?php
}

/**
 * Test-email panel: send a live email + show the raw SMTP error inline.
 *
 * This used to live only inside altysier_render_settings_page()'s "smtp" tab,
 * but that whole native page only registers when ACF Pro's own options pages
 * are NOT available (see the `function_exists( 'acf_add_options_page' )`
 * guard above) — so on every environment that actually has ACF active
 * (i.e. all of them, local included), that page — and this button — never
 * rendered at all. Hooked here instead so it shows up next to whichever
 * Email & SMTP screen is actually in use (native tab or ACF sub-page).
 */
function altysier_render_test_email_panel() {
	$screen = get_current_screen();
	if ( ! $screen ) {
		return;
	}
	$page = isset( $_GET['page'] ) ? sanitize_text_field( wp_unslash( $_GET['page'] ) ) : '';
	$tab  = isset( $_GET['tab'] ) ? sanitize_text_field( wp_unslash( $_GET['tab'] ) ) : '';

	$is_native_smtp_tab = ( 'altysier-settings' === $page && 'smtp' === $tab );
	$is_acf_smtp_page    = ( 'altysier-smtp-settings' === $page );
	if ( ! $is_native_smtp_tab && ! $is_acf_smtp_page ) {
		return;
	}
	?>
	<div style="background: #fff; padding: 25px; border: 1px solid #ccd0d4; box-shadow: 0 1px 1px rgba(0,0,0,.04); margin: 20px 20px 0 2px; border-radius: 4px;">
		<h2><?php esc_html_e( 'Test SMTP Email Delivery', 'altysier' ); ?></h2>
		<p><?php esc_html_e( 'Send a live test email to verify that your Gmail SMTP configuration and App Password are operating correctly.', 'altysier' ); ?></p>
		<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
			<?php wp_nonce_field( 'altysier_test_email_nonce', 'altysier_test_nonce' ); ?>
			<input type="hidden" name="action" value="altysier_send_test_email">
			<p>
				<input type="email" name="test_recipient" value="<?php echo esc_attr( altysier_get_option( 'enquiry_recipient', 'manu.abhiram@gmail.com' ) ); ?>" class="regular-text" required placeholder="recipient@example.com">
				<button type="submit" class="button button-secondary"><?php esc_html_e( 'Send Test Email Now', 'altysier' ); ?></button>
			</p>
		</form>
		<?php if ( isset( $_GET['test_email_sent'] ) ) : ?>
			<?php if ( '1' === $_GET['test_email_sent'] ) : ?>
				<div class="notice notice-success inline" style="margin-top: 15px;"><p><?php echo esc_html( sprintf( __( 'Test email sent successfully! Please check your inbox at %s', 'altysier' ), altysier_get_option( 'enquiry_recipient', 'manu.abhiram@gmail.com' ) ) ); ?></p></div>
			<?php else : ?>
				<div class="notice notice-error inline" style="margin-top: 15px;"><p><?php echo esc_html( sprintf( __( 'Test email failed to send. Error details: %s', 'altysier' ), isset( $_GET['error'] ) ? urldecode( $_GET['error'] ) : 'Unknown error' ) ); ?></p></div>
			<?php endif; ?>
		<?php endif; ?>
	</div>
	<?php
}
add_action( 'admin_notices', 'altysier_render_test_email_panel' );

