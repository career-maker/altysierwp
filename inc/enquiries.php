<?php
/**
 * Enquiries Log — Admin-Only Record of Contact Form Submissions
 *
 * Every contact form submission (homepage + Contact page) is saved here in
 * addition to being emailed, so a failed or missed email never means the
 * enquiry itself is lost.
 *
 * @package Altysier
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register the Enquiry post type — admin-only, not publicly queryable,
 * created only programmatically (no "Add New" for editors).
 */
function altysier_register_enquiry_post_type() {
	$labels = array(
		'name'               => _x( 'Enquiries', 'Post type general name', 'altysier' ),
		'singular_name'      => _x( 'Enquiry', 'Post type singular name', 'altysier' ),
		'menu_name'          => _x( 'Enquiries', 'Admin Menu text', 'altysier' ),
		'all_items'          => __( 'All Enquiries', 'altysier' ),
		'view_item'          => __( 'View Enquiry', 'altysier' ),
		'search_items'       => __( 'Search Enquiries', 'altysier' ),
		'not_found'          => __( 'No enquiries found.', 'altysier' ),
		'not_found_in_trash' => __( 'No enquiries found in Trash.', 'altysier' ),
	);

	register_post_type( 'altysier_enquiry', array(
		'labels'          => $labels,
		'public'          => false,
		'show_ui'         => true,
		'show_in_menu'    => true,
		'menu_position'   => 25,
		'menu_icon'       => 'dashicons-email-alt2',
		'capability_type' => 'post',
		'capabilities'    => array(
			'create_posts' => 'do_not_allow', // Only ever created by the form handler, never manually.
		),
		'map_meta_cap'    => true,
		'hierarchical'    => false,
		'supports'        => array( 'title' ),
		'show_in_rest'    => false,
	) );
}
add_action( 'init', 'altysier_register_enquiry_post_type' );

/**
 * Save one enquiry record. Called from the form handler regardless of
 * whether the notification email succeeds, so a mail failure never loses
 * the submission itself.
 *
 * @return int|false New post ID, or false on failure.
 */
function altysier_save_enquiry( $fields ) {
	$name = isset( $fields['name'] ) ? $fields['name'] : '';
	$title = sprintf(
		'%s — %s',
		$name ? $name : 'Unknown',
		current_time( 'Y-m-d H:i' )
	);

	$post_id = wp_insert_post( array(
		'post_type'   => 'altysier_enquiry',
		'post_title'  => $title,
		'post_status' => 'publish',
	), true );

	if ( is_wp_error( $post_id ) || ! $post_id ) {
		return false;
	}

	$meta_map = array(
		'name'        => 'enquiry_name',
		'email'       => 'enquiry_email',
		'phone'       => 'enquiry_phone',
		'company'     => 'enquiry_company',
		'sector'      => 'enquiry_subject',
		'message'     => 'enquiry_message',
		'form_source' => 'enquiry_source',
	);
	foreach ( $meta_map as $field_key => $meta_key ) {
		update_post_meta( $post_id, $meta_key, isset( $fields[ $field_key ] ) ? $fields[ $field_key ] : '' );
	}
	update_post_meta( $post_id, 'enquiry_ip', isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) : '' );
	update_post_meta( $post_id, 'enquiry_mail_sent', ! empty( $fields['mail_sent'] ) ? '1' : '0' );
	update_post_meta( $post_id, 'enquiry_mail_error', isset( $fields['mail_error'] ) ? sanitize_text_field( $fields['mail_error'] ) : '' );

	return $post_id;
}

/**
 * Admin List Table — Custom Columns
 */
function altysier_enquiry_columns( $columns ) {
	unset( $columns['date'] );
	$columns['enquiry_name']    = __( 'Name', 'altysier' );
	$columns['enquiry_email']   = __( 'Email', 'altysier' );
	$columns['enquiry_phone']   = __( 'Phone', 'altysier' );
	$columns['enquiry_subject'] = __( 'Subject', 'altysier' );
	$columns['enquiry_source']  = __( 'Source', 'altysier' );
	$columns['enquiry_status']  = __( 'Email' , 'altysier' );
	$columns['date']            = __( 'Submitted', 'altysier' );
	return $columns;
}
add_filter( 'manage_altysier_enquiry_posts_columns', 'altysier_enquiry_columns' );

function altysier_enquiry_column_content( $column, $post_id ) {
	switch ( $column ) {
		case 'enquiry_name':
			echo esc_html( get_post_meta( $post_id, 'enquiry_name', true ) );
			break;
		case 'enquiry_email':
			$email = get_post_meta( $post_id, 'enquiry_email', true );
			echo $email ? '<a href="mailto:' . esc_attr( $email ) . '">' . esc_html( $email ) . '</a>' : '—';
			break;
		case 'enquiry_phone':
			echo esc_html( get_post_meta( $post_id, 'enquiry_phone', true ) ?: '—' );
			break;
		case 'enquiry_subject':
			echo esc_html( get_post_meta( $post_id, 'enquiry_subject', true ) ?: '—' );
			break;
		case 'enquiry_source':
			echo esc_html( get_post_meta( $post_id, 'enquiry_source', true ) ?: '—' );
			break;
		case 'enquiry_status':
			$sent = '1' === get_post_meta( $post_id, 'enquiry_mail_sent', true );
			echo $sent
				? '<span style="color:#15803d;">' . esc_html__( 'Sent', 'altysier' ) . '</span>'
				: '<span style="color:#b91c1c;">' . esc_html__( 'Failed', 'altysier' ) . '</span>';
			break;
	}
}
add_action( 'manage_altysier_enquiry_posts_custom_column', 'altysier_enquiry_column_content', 10, 2 );

/**
 * Detail Meta Box — full submission on the single-enquiry screen.
 */
function altysier_enquiry_register_meta_box() {
	add_meta_box(
		'altysier_enquiry_details',
		__( 'Enquiry Details', 'altysier' ),
		'altysier_enquiry_render_meta_box',
		'altysier_enquiry',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'altysier_enquiry_register_meta_box' );

function altysier_enquiry_render_meta_box( $post ) {
	$fields = array(
		__( 'Name', 'altysier' )    => get_post_meta( $post->ID, 'enquiry_name', true ),
		__( 'Email', 'altysier' )   => get_post_meta( $post->ID, 'enquiry_email', true ),
		__( 'Phone', 'altysier' )   => get_post_meta( $post->ID, 'enquiry_phone', true ),
		__( 'Company', 'altysier' ) => get_post_meta( $post->ID, 'enquiry_company', true ),
		__( 'Subject', 'altysier' ) => get_post_meta( $post->ID, 'enquiry_subject', true ),
		__( 'Source', 'altysier' )  => get_post_meta( $post->ID, 'enquiry_source', true ),
		__( 'IP Address', 'altysier' ) => get_post_meta( $post->ID, 'enquiry_ip', true ),
	);
	$message    = get_post_meta( $post->ID, 'enquiry_message', true );
	$sent       = '1' === get_post_meta( $post->ID, 'enquiry_mail_sent', true );
	$mail_error = get_post_meta( $post->ID, 'enquiry_mail_error', true );
	?>
	<table class="form-table" style="margin-top:0;">
		<?php foreach ( $fields as $label => $value ) : ?>
			<tr>
				<th scope="row" style="width:160px;"><?php echo esc_html( $label ); ?></th>
				<td><?php echo esc_html( $value ?: '—' ); ?></td>
			</tr>
		<?php endforeach; ?>
		<tr>
			<th scope="row"><?php esc_html_e( 'Notification Email', 'altysier' ); ?></th>
			<td>
				<?php if ( $sent ) : ?>
					<span style="color:#15803d;"><?php esc_html_e( 'Sent successfully', 'altysier' ); ?></span>
				<?php else : ?>
					<span style="color:#b91c1c;"><?php esc_html_e( 'Failed to send', 'altysier' ); ?></span>
					<?php if ( $mail_error ) : ?>
						<br><code style="white-space:pre-wrap;display:inline-block;margin-top:6px;"><?php echo esc_html( $mail_error ); ?></code>
					<?php else : ?>
						<br><em><?php esc_html_e( 'No error detail captured — check the server PHP error log for the wp_mail() failure at this timestamp.', 'altysier' ); ?></em>
					<?php endif; ?>
				<?php endif; ?>
			</td>
		</tr>
	</table>
	<h3><?php esc_html_e( 'Message', 'altysier' ); ?></h3>
	<p style="white-space:pre-wrap;background:#f6f7f7;padding:12px 16px;border-radius:4px;border:1px solid #dcdcde;"><?php echo esc_html( $message ); ?></p>
	<?php
}

/**
 * Make the title read-only-looking and hide the standard publish/editor
 * chrome that doesn't apply to a log entry.
 */
function altysier_enquiry_admin_styles() {
	$screen = get_current_screen();
	if ( ! $screen || 'altysier_enquiry' !== $screen->post_type ) {
		return;
	}
	echo '<style>
		#titlediv #title { background: #f0f0f1; }
		#minor-publishing-actions, #misc-publishing-actions .misc-pub-post-status,
		#misc-publishing-actions .misc-pub-visibility { display: none; }
	</style>';
}
add_action( 'admin_head', 'altysier_enquiry_admin_styles' );

/**
 * Remove the "Add New Enquiry" submenu / page-title button.
 */
function altysier_remove_enquiry_add_new_submenu() {
	remove_submenu_page( 'edit.php?post_type=altysier_enquiry', 'post-new.php?post_type=altysier_enquiry' );
}
add_action( 'admin_menu', 'altysier_remove_enquiry_add_new_submenu', 999 );
