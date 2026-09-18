<?php
/**
 * Custom Post Types & Taxonomies for Altysier Group Theme
 *
 * @package Altysier
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register Custom Post Types and Taxonomies
 */
function altysier_register_post_types() {
	// 1. Company Custom Post Type
	$company_labels = array(
		'name'                  => _x( 'Companies', 'Post type general name', 'altysier' ),
		'singular_name'         => _x( 'Company', 'Post type singular name', 'altysier' ),
		'menu_name'             => _x( 'Group Companies', 'Admin Menu text', 'altysier' ),
		'name_admin_bar'        => _x( 'Company', 'Add New on Toolbar', 'altysier' ),
		'add_new'               => __( 'Add New Company', 'altysier' ),
		'add_new_item'          => __( 'Add New Company', 'altysier' ),
		'new_item'              => __( 'New Company', 'altysier' ),
		'edit_item'             => __( 'Edit Company', 'altysier' ),
		'view_item'             => __( 'View Company', 'altysier' ),
		'all_items'             => __( 'All Companies', 'altysier' ),
		'search_items'          => __( 'Search Companies', 'altysier' ),
		'parent_item_colon'     => __( 'Parent Companies:', 'altysier' ),
		'not_found'             => __( 'No companies found.', 'altysier' ),
		'not_found_in_trash'    => __( 'No companies found in Trash.', 'altysier' ),
		'featured_image'        => _x( 'Company Cover Photo / Banner', 'Overrides the “Featured Image” phrase', 'altysier' ),
		'set_featured_image'    => _x( 'Set cover photo', 'Overrides the “Set featured image” phrase', 'altysier' ),
		'remove_featured_image' => _x( 'Remove cover photo', 'Overrides the “Remove featured image” phrase', 'altysier' ),
		'use_featured_image'    => _x( 'Use as cover photo', 'Overrides the “Use as featured image” phrase', 'altysier' ),
	);

	$company_args = array(
		'labels'             => $company_labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'companies', 'with_front' => false ),
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => false,
		'menu_position'      => 20,
		'menu_icon'          => 'dashicons-building',
		'supports'           => array( 'title', 'thumbnail', 'excerpt', 'custom-fields', 'page-attributes' ),
		'show_in_rest'       => true,
	);

	register_post_type( 'company', $company_args );

	// 2. Sector Taxonomy for Companies
	$sector_labels = array(
		'name'              => _x( 'Sectors', 'taxonomy general name', 'altysier' ),
		'singular_name'     => _x( 'Sector', 'taxonomy singular name', 'altysier' ),
		'search_items'      => __( 'Search Sectors', 'altysier' ),
		'all_items'         => __( 'All Sectors', 'altysier' ),
		'parent_item'       => __( 'Parent Sector', 'altysier' ),
		'parent_item_colon' => __( 'Parent Sector:', 'altysier' ),
		'edit_item'         => __( 'Edit Sector', 'altysier' ),
		'update_item'       => __( 'Update Sector', 'altysier' ),
		'add_new_item'      => __( 'Add New Sector', 'altysier' ),
		'new_item_name'     => __( 'New Sector Name', 'altysier' ),
		'menu_name'         => __( 'Sectors', 'altysier' ),
	);

	$sector_args = array(
		'hierarchical'      => true,
		'labels'            => $sector_labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'sector' ),
		'show_in_rest'      => true,
	);

	register_taxonomy( 'company_sector', array( 'company' ), $sector_args );
}
add_action( 'init', 'altysier_register_post_types' );
