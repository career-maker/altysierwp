<?php
/**
 * ACF Field Group Definitions — Programmatic Registration
 * Registered via acf_add_local_field_group() so ACF reads them as code.
 * Works on both ACF Free and ACF PRO.
 *
 * @package Altysier
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'acf_add_local_field_group' ) ) {
	return;
}

// ══════════════════════════════════════════════════════════════
// 1. GLOBAL SEO FIELDS (All Pages & Posts)
// ══════════════════════════════════════════════════════════════
acf_add_local_field_group( array(
	'key'    => 'group_seo_meta',
	'title'  => '🔍 SEO Meta Settings',
	'fields' => array(
		array(
			'key'           => 'field_seo_meta_title',
			'label'         => 'SEO Title',
			'name'          => 'seo_meta_title',
			'type'          => 'text',
			'instructions'  => 'Recommended: 50–60 characters. Leave blank to use the page title.',
			'default_value' => '',
		),
		array(
			'key'           => 'field_seo_meta_description',
			'label'         => 'SEO Meta Description',
			'name'          => 'seo_meta_description',
			'type'          => 'textarea',
			'rows'          => 3,
			'instructions'  => 'Recommended: 150–160 characters. Leave blank for auto-generated description.',
		),
		array(
			'key'   => 'field_seo_meta_keywords',
			'label' => 'SEO Keywords',
			'name'  => 'seo_meta_keywords',
			'type'  => 'text',
		),
		array(
			'key'          => 'field_seo_og_image',
			'label'        => 'Open Graph Image',
			'name'         => 'seo_og_image',
			'type'         => 'image',
			'return_format'=> 'array',
			'instructions' => 'Recommended: 1200 × 630 px',
		),
		array(
			'key'   => 'field_seo_og_title',
			'label' => 'OG Title Override',
			'name'  => 'seo_og_title',
			'type'  => 'text',
		),
		array(
			'key'   => 'field_seo_og_description',
			'label' => 'OG Description Override',
			'name'  => 'seo_og_description',
			'type'  => 'textarea',
			'rows'  => 2,
		),
		array(
			'key'   => 'field_seo_twitter_title',
			'label' => 'Twitter/X Card Title',
			'name'  => 'seo_twitter_title',
			'type'  => 'text',
		),
		array(
			'key'   => 'field_seo_twitter_description',
			'label' => 'Twitter/X Card Description',
			'name'  => 'seo_twitter_description',
			'type'  => 'textarea',
			'rows'  => 2,
		),
		array(
			'key'          => 'field_seo_twitter_image',
			'label'        => 'Twitter/X Card Image',
			'name'         => 'seo_twitter_image',
			'type'         => 'image',
			'return_format'=> 'array',
		),
		array(
			'key'   => 'field_seo_canonical_url',
			'label' => 'Canonical URL',
			'name'  => 'seo_canonical_url',
			'type'  => 'url',
		),
		array(
			'key'   => 'field_seo_noindex',
			'label' => 'No Index',
			'name'  => 'seo_noindex',
			'type'  => 'true_false',
			'message' => 'Mark this page as noindex (exclude from search engines)',
		),
		array(
			'key'   => 'field_seo_nofollow',
			'label' => 'No Follow',
			'name'  => 'seo_nofollow',
			'type'  => 'true_false',
			'message' => 'Mark this page as nofollow',
		),
	),
	'location' => array(
		array( array( 'param' => 'post_type', 'operator' => '==', 'value' => 'post' ) ),
		array( array( 'param' => 'post_type', 'operator' => '==', 'value' => 'page' ) ),
		array( array( 'param' => 'post_type', 'operator' => '==', 'value' => 'company' ) ),
	),
	'menu_order'            => 100,
	'position'              => 'normal',
	'style'                 => 'default',
	'label_placement'       => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen'        => '',
) );

// ══════════════════════════════════════════════════════════════
// 2. INNER PAGE BANNER FIELDS
// ══════════════════════════════════════════════════════════════
acf_add_local_field_group( array(
	'key'    => 'group_page_banner',
	'title'  => '🏔️ Page Banner / Inner Hero',
	'fields' => array(
		array(
			'key'          => 'field_banner_bg_image',
			'label'        => 'Banner Background Image',
			'name'         => 'banner_bg_image',
			'type'         => 'image',
			'return_format'=> 'url',
			'instructions' => 'High-resolution widescreen photo (min 1920px wide). Leave blank for default.',
		),
		array(
			'key'           => 'field_banner_watermark',
			'label'         => 'Banner Watermark Text',
			'name'          => 'banner_watermark',
			'type'          => 'text',
			'instructions'  => 'e.g. ABOUT US, CSR, CONTACT (shows as large faded background text)',
			'default_value' => 'PAGE',
		),
		array(
			'key'           => 'field_banner_title',
			'label'         => 'Banner Heading (H1)',
			'name'          => 'banner_title',
			'type'          => 'text',
			'instructions'  => 'Main page title displayed on the banner.',
		),
		array(
			'key'  => 'field_banner_subtitle',
			'label'=> 'Banner Subtitle / Lead Text',
			'name' => 'banner_subtitle',
			'type' => 'textarea',
			'rows' => 3,
		),
	),
	'location' => array(
		array(
			array(
				'param'    => 'page_template',
				'operator' => '!=',
				'value'    => 'default',
			),
			array( 'param' => 'page_type', 'operator' => '!=', 'value' => 'front_page' ),
		),
		array(
			array( 'param' => 'post_type', 'operator' => '==', 'value' => 'page' ),
			array( 'param' => 'page_type', 'operator' => '!=', 'value' => 'front_page' ),
		),
	),
	'menu_order' => 10,
	'position'   => 'normal',
	'style'      => 'default',
) );

// ══════════════════════════════════════════════════════════════
// 3. HOMEPAGE HERO SECTION
// ══════════════════════════════════════════════════════════════
acf_add_local_field_group( array(
	'key'    => 'group_homepage_hero',
	'title'  => '🦸 Homepage — Hero Section',
	'fields' => array(
		array(
			'key'          => 'field_hero_bg_image',
			'label'        => 'Hero Background Photo',
			'name'         => 'hero_bg_image',
			'type'         => 'image',
			'return_format'=> 'url',
			'instructions' => 'Full-bleed hero photo displayed at 94% opacity. Min 1920px wide. Also used as the video poster/fallback below.',
		),
		array(
			'key'           => 'field_hero_bg_video',
			'label'         => 'Hero Background Video',
			'name'          => 'hero_bg_video',
			'type'          => 'file',
			'return_format' => 'url',
			'mime_types'    => 'mp4,webm,mov',
			'instructions'  => 'Optional — autoplay, muted, looping background video. Overrides the photo above when set (the photo still shows as the poster frame while it loads, and as a fallback). Keep it short and under ~10MB; no audio track needed since it plays muted.',
		),
		array(
			'key'           => 'field_hero_eyebrow',
			'label'         => 'Hero Eyebrow Tag',
			'name'          => 'hero_eyebrow',
			'type'          => 'text',
			'default_value' => 'A Global Business Group',
		),
		array(
			'key'           => 'field_hero_heading_line1',
			'label'         => 'Hero Heading — Line 1',
			'name'          => 'hero_heading_line1',
			'type'          => 'text',
			'default_value' => 'Connecting Markets.',
		),
		array(
			'key'           => 'field_hero_heading_line2',
			'label'         => 'Hero Heading — Line 2',
			'name'          => 'hero_heading_line2',
			'type'          => 'text',
			'default_value' => 'Creating Value.',
		),
		array(
			'key'           => 'field_hero_heading_line3',
			'label'         => 'Hero Heading — Line 3 (Accent)',
			'name'          => 'hero_heading_line3',
			'type'          => 'text',
			'default_value' => 'Driving Growth.',
		),
		array(
			'key'           => 'field_hero_body',
			'label'         => 'Hero Body Text',
			'name'          => 'hero_body',
			'type'          => 'textarea',
			'rows'          => 3,
			'default_value' => 'Altysier Group brings together specialized businesses across international trade, industrial investment, agribusiness and corporate services — creating lasting value across global markets.',
		),
		array(
			'key'           => 'field_hero_btn1_label',
			'label'         => 'Primary Button Label',
			'name'          => 'hero_btn1_label',
			'type'          => 'text',
			'default_value' => 'Explore Our Group',
		),
		array(
			'key'           => 'field_hero_btn1_link',
			'label'         => 'Primary Button Link',
			'name'          => 'hero_btn1_link',
			'type'          => 'text',
			'default_value' => '#companies',
		),
		array(
			'key'           => 'field_hero_btn2_label',
			'label'         => 'Secondary Button Label',
			'name'          => 'hero_btn2_label',
			'type'          => 'text',
			'default_value' => 'Get in Touch',
		),
		array(
			'key'           => 'field_hero_btn2_link',
			'label'         => 'Secondary Button Link',
			'name'          => 'hero_btn2_link',
			'type'          => 'text',
			'default_value' => '#contact',
		),
		array(
			'key'          => 'field_hero_stats',
			'label'        => 'Stat Cards',
			'name'         => 'hero_stats',
			'type'         => 'repeater',
			'button_label' => 'Add Stat',
			'instructions' => 'Icon Key options: companies, pie-chart, globe-alt, badge-star (falls back to a plain circle for an unrecognised key).',
			'sub_fields'   => array(
				array( 'key' => 'field_hero_stat_icon', 'label' => 'Icon Key', 'name' => 'icon_key', 'type' => 'text' ),
				array( 'key' => 'field_hero_stat_number', 'label' => 'Number', 'name' => 'number', 'type' => 'text' ),
				array( 'key' => 'field_hero_stat_label', 'label' => 'Label', 'name' => 'label', 'type' => 'text' ),
			),
		),
	),
	'location' => array(
		array( array( 'param' => 'page_type', 'operator' => '==', 'value' => 'front_page' ) ),
	),
	'menu_order' => 20,
	'position'   => 'normal',
) );

// ══════════════════════════════════════════════════════════════
// 4. HOMEPAGE GROUP & SECTOR EXPLORER
// ══════════════════════════════════════════════════════════════
acf_add_local_field_group( array(
	'key'    => 'group_homepage_group_section',
	'title'  => '🏢 Homepage — The Group & Sector Explorer',
	'fields' => array(
		array(
			'key'           => 'field_group_eyebrow',
			'label'         => 'Section Eyebrow',
			'name'          => 'group_eyebrow',
			'type'          => 'text',
			'default_value' => 'Who We Are',
		),
		array(
			'key'           => 'field_group_heading',
			'label'         => 'Section Heading',
			'name'          => 'group_heading',
			'type'          => 'text',
			'default_value' => 'The Altysier Group',
		),
		array(
			'key'           => 'field_group_statement',
			'label'         => 'Editorial Statement',
			'name'          => 'group_statement',
			'type'          => 'textarea',
			'rows'          => 3,
			'default_value' => 'A diversified business group building long-term value across international trade, industrial investment, agribusiness and corporate services.',
		),
		array(
			'key'           => 'field_group_sectors_eyebrow',
			'label'         => 'Sectors Eyebrow',
			'name'          => 'group_sectors_eyebrow',
			'type'          => 'text',
			'default_value' => 'Our Sectors',
		),
		array(
			'key'           => 'field_group_sectors_heading',
			'label'         => 'Sectors Heading',
			'name'          => 'group_sectors_heading',
			'type'          => 'text',
			'default_value' => 'Where We Operate',
		),
		array(
			'key'           => 'field_group_sectors_intro',
			'label'         => 'Sectors Intro',
			'name'          => 'group_sectors_intro',
			'type'          => 'text',
			'default_value' => 'Seven sectors, one connected group. Explore our comprehensive capabilities.',
		),
		array(
			'key'          => 'field_sector_cards',
			'label'        => 'Sector Cards',
			'name'         => 'sector_cards',
			'type'         => 'repeater',
			'button_label' => 'Add Sector',
			'instructions' => 'Icon Key options: trade_ship, industry, default, transport_truck, feed, medical, bajaj (any key from the company Area Panel icon set also works).',
			'sub_fields'   => array(
				array( 'key' => 'field_sector_photo', 'label' => 'Photo', 'name' => 'photo', 'type' => 'image', 'return_format' => 'url' ),
				array( 'key' => 'field_sector_icon', 'label' => 'Icon Key', 'name' => 'icon_key', 'type' => 'text' ),
				array( 'key' => 'field_sector_title', 'label' => 'Title', 'name' => 'title', 'type' => 'text' ),
				array( 'key' => 'field_sector_text', 'label' => 'Description', 'name' => 'text', 'type' => 'textarea', 'rows' => 2 ),
				array( 'key' => 'field_sector_tag', 'label' => 'Tag', 'name' => 'tag', 'type' => 'text' ),
			),
		),
		array(
			'key'           => 'field_group_actions_label',
			'label'         => 'Section Button Label',
			'name'          => 'group_actions_label',
			'type'          => 'text',
			'default_value' => 'Learn About Our Group →',
		),
		array(
			'key'           => 'field_group_actions_link',
			'label'         => 'Section Button Link',
			'name'          => 'group_actions_link',
			'type'          => 'text',
			'default_value' => '/about/',
		),
	),
	'location' => array(
		array( array( 'param' => 'page_type', 'operator' => '==', 'value' => 'front_page' ) ),
	),
	'menu_order' => 30,
) );

// ══════════════════════════════════════════════════════════════
// 4b. HOMEPAGE — HOW WE CREATE VALUE (JOURNEY)
// ══════════════════════════════════════════════════════════════
acf_add_local_field_group( array(
	'key'    => 'group_homepage_journey',
	'title'  => '🛤️ Homepage — How We Create Value',
	'fields' => array(
		array( 'key' => 'field_journey_eyebrow', 'label' => 'Eyebrow', 'name' => 'journey_eyebrow', 'type' => 'text', 'default_value' => 'From Opportunity to Impact' ),
		array( 'key' => 'field_journey_heading', 'label' => 'Heading', 'name' => 'journey_heading', 'type' => 'text', 'default_value' => 'How We Create Value' ),
		array( 'key' => 'field_journey_intro', 'label' => 'Intro', 'name' => 'journey_intro', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'A disciplined, end-to-end framework transforming high-potential opportunities into resilient enterprises and long-term economic value.' ),
		array(
			'key'          => 'field_journey_steps',
			'label'        => 'Value Pipeline Steps',
			'name'         => 'journey_steps',
			'type'         => 'repeater',
			'button_label' => 'Add Step',
			'sub_fields'   => array(
				array( 'key' => 'field_journey_step_image', 'label' => 'Photo', 'name' => 'image', 'type' => 'image', 'return_format' => 'url' ),
				array( 'key' => 'field_journey_step_title', 'label' => 'Title', 'name' => 'title', 'type' => 'text' ),
				array( 'key' => 'field_journey_step_text', 'label' => 'Description', 'name' => 'text', 'type' => 'textarea', 'rows' => 2 ),
				array( 'key' => 'field_journey_step_phase', 'label' => 'Phase Label', 'name' => 'phase_label', 'type' => 'text', 'instructions' => 'e.g. Phase 01' ),
			),
		),
		array( 'key' => 'field_journey_actions_label', 'label' => 'Section Button Label', 'name' => 'journey_actions_label', 'type' => 'text', 'default_value' => 'Explore Group Capabilities →' ),
		array( 'key' => 'field_journey_actions_link', 'label' => 'Section Button Link', 'name' => 'journey_actions_link', 'type' => 'text', 'default_value' => '/about/' ),
	),
	'location' => array(
		array( array( 'param' => 'page_type', 'operator' => '==', 'value' => 'front_page' ) ),
	),
	'menu_order' => 32,
) );

// ══════════════════════════════════════════════════════════════
// 4c. HOMEPAGE — BUSINESSES SECTION HEADER
// ══════════════════════════════════════════════════════════════
acf_add_local_field_group( array(
	'key'    => 'group_homepage_businesses',
	'title'  => '🏭 Homepage — Businesses Section Header',
	'fields' => array(
		array( 'key' => 'field_businesses_eyebrow', 'label' => 'Eyebrow', 'name' => 'businesses_eyebrow', 'type' => 'text', 'default_value' => 'Our Group Companies' ),
		array( 'key' => 'field_businesses_heading', 'label' => 'Heading', 'name' => 'businesses_heading', 'type' => 'text', 'default_value' => 'The Businesses Behind the Group' ),
		array( 'key' => 'field_businesses_intro', 'label' => 'Intro', 'name' => 'businesses_intro', 'type' => 'text', 'default_value' => 'A diversified group serving essential industries.' ),
	),
	'location' => array(
		array( array( 'param' => 'page_type', 'operator' => '==', 'value' => 'front_page' ) ),
	),
	'menu_order' => 34,
) );

// ══════════════════════════════════════════════════════════════
// 5. HOMEPAGE REACH & IMPACT
// ══════════════════════════════════════════════════════════════
acf_add_local_field_group( array(
	'key'    => 'group_homepage_reach',
	'title'  => '🌍 Homepage — Global Reach & Impact',
	'fields' => array(
		array(
			'key'           => 'field_reach_eyebrow',
			'label'         => 'Section Eyebrow',
			'name'          => 'reach_eyebrow',
			'type'          => 'text',
			'default_value' => 'Global Reach & Impact',
		),
		array(
			'key'           => 'field_reach_heading',
			'label'         => 'Section Heading',
			'name'          => 'reach_heading',
			'type'          => 'text',
			'default_value' => 'Active Across Global Markets',
		),
		array(
			'key'          => 'field_reach_bg_image',
			'label'        => 'Background Photo',
			'name'         => 'reach_bg_image',
			'type'         => 'image',
			'return_format'=> 'url',
		),
		array( 'key' => 'field_reach_intro', 'label' => 'Section Intro', 'name' => 'reach_intro', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Our reach is measured not only by where we operate, but by the sustainable value we create across global markets and communities.' ),
		array(
			'key'          => 'field_reach_stats',
			'label'        => 'Reach Stats',
			'name'         => 'reach_stats',
			'type'         => 'repeater',
			'button_label' => 'Add Stat',
			'sub_fields'   => array(
				array( 'key' => 'field_reach_stat_number', 'label' => 'Number', 'name' => 'number', 'type' => 'text' ),
				array( 'key' => 'field_reach_stat_label', 'label' => 'Label', 'name' => 'label', 'type' => 'text' ),
			),
		),
		array(
			'key'          => 'field_reach_pillars',
			'label'        => 'Pillars',
			'name'         => 'reach_pillars',
			'type'         => 'repeater',
			'button_label' => 'Add Pillar',
			'instructions' => 'Icon Key options: feed, people, economic-growth, shield-check.',
			'sub_fields'   => array(
				array( 'key' => 'field_reach_pillar_icon', 'label' => 'Icon Key', 'name' => 'icon_key', 'type' => 'text' ),
				array( 'key' => 'field_reach_pillar_title', 'label' => 'Title', 'name' => 'title', 'type' => 'text' ),
				array( 'key' => 'field_reach_pillar_text', 'label' => 'Text', 'name' => 'text', 'type' => 'text' ),
			),
		),
		array( 'key' => 'field_reach_action_label', 'label' => 'Section Button Label', 'name' => 'reach_action_label', 'type' => 'text', 'default_value' => 'Explore Our Impact →' ),
		array( 'key' => 'field_reach_action_link', 'label' => 'Section Button Link', 'name' => 'reach_action_link', 'type' => 'text', 'default_value' => '/csr/' ),
	),
	'location' => array(
		array( array( 'param' => 'page_type', 'operator' => '==', 'value' => 'front_page' ) ),
	),
	'menu_order' => 40,
) );

// ══════════════════════════════════════════════════════════════
// 5b. HOMEPAGE — WHY TRUST US + TESTIMONIALS
// ══════════════════════════════════════════════════════════════
acf_add_local_field_group( array(
	'key'    => 'group_homepage_why',
	'title'  => '🤝 Homepage — Why Trust Us & Testimonials',
	'fields' => array(
		array( 'key' => 'field_why_eyebrow', 'label' => 'Eyebrow', 'name' => 'why_eyebrow', 'type' => 'text', 'default_value' => 'Why Trust Us' ),
		array( 'key' => 'field_why_heading', 'label' => 'Heading', 'name' => 'why_heading', 'type' => 'text', 'default_value' => 'Built on Trust. Driven by Capability.' ),
		array( 'key' => 'field_why_intro', 'label' => 'Intro', 'name' => 'why_intro', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Delivering excellence through disciplined execution, deep market knowledge, and enduring strategic partnerships.' ),
		array(
			'key'          => 'field_why_principles',
			'label'        => 'Principle Cards',
			'name'         => 'why_principles',
			'type'         => 'repeater',
			'button_label' => 'Add Principle',
			'instructions' => 'Icon Key options: globe-alt, filing-cabinet, shield-check, handshake, economic-growth.',
			'sub_fields'   => array(
				array( 'key' => 'field_why_principle_icon', 'label' => 'Icon Key', 'name' => 'icon_key', 'type' => 'text' ),
				array( 'key' => 'field_why_principle_heading', 'label' => 'Heading', 'name' => 'heading', 'type' => 'text' ),
				array( 'key' => 'field_why_principle_text', 'label' => 'Text', 'name' => 'text', 'type' => 'text' ),
			),
		),
		array(
			'key'          => 'field_testimonials',
			'label'        => 'Testimonials',
			'name'         => 'testimonials',
			'type'         => 'repeater',
			'button_label' => 'Add Testimonial',
			'sub_fields'   => array(
				array( 'key' => 'field_testimonial_quote', 'label' => 'Quote', 'name' => 'quote', 'type' => 'textarea', 'rows' => 3 ),
				array( 'key' => 'field_testimonial_author', 'label' => 'Author Name', 'name' => 'author', 'type' => 'text' ),
				array( 'key' => 'field_testimonial_role', 'label' => 'Role', 'name' => 'role', 'type' => 'text' ),
				array( 'key' => 'field_testimonial_company', 'label' => 'Company', 'name' => 'company', 'type' => 'text' ),
				array( 'key' => 'field_testimonial_image', 'label' => 'Photo', 'name' => 'image', 'type' => 'image', 'return_format' => 'url' ),
			),
		),
		array( 'key' => 'field_why_actions_label', 'label' => 'Section Button Label', 'name' => 'why_actions_label', 'type' => 'text', 'default_value' => 'Why Trust Altysier Group →' ),
		array( 'key' => 'field_why_actions_link', 'label' => 'Section Button Link', 'name' => 'why_actions_link', 'type' => 'text', 'default_value' => '/about/' ),
	),
	'location' => array(
		array( array( 'param' => 'page_type', 'operator' => '==', 'value' => 'front_page' ) ),
	),
	'menu_order' => 42,
) );

// ══════════════════════════════════════════════════════════════
// 6. HOMEPAGE FAQ SECTION
// ══════════════════════════════════════════════════════════════
acf_add_local_field_group( array(
	'key'    => 'group_homepage_faq',
	'title'  => '❓ Homepage — FAQ & Contact Section',
	'fields' => array(
		array(
			'key'           => 'field_faq_section_eyebrow',
			'label'         => 'Section Eyebrow',
			'name'          => 'faq_eyebrow',
			'type'          => 'text',
			'instructions'  => 'Fallback eyebrow shown above the Contact column if its own eyebrow is left blank.',
			'default_value' => 'Partnership & Inquiries',
		),
		// ── Left Column: Contact Form ─────────────────────────────
		array(
			'key'           => 'field_faq_contact_eyebrow',
			'label'         => 'Contact Column Eyebrow',
			'name'          => 'faq_contact_eyebrow',
			'type'          => 'text',
			'default_value' => 'Partnership & Inquiries',
		),
		array(
			'key'           => 'field_faq_contact_heading',
			'label'         => 'Contact Column Heading',
			'name'          => 'faq_contact_heading',
			'type'          => 'text',
			'default_value' => "Let's Build What Comes Next",
		),
		array(
			'key'           => 'field_faq_contact_text',
			'label'         => 'Contact Column Text',
			'name'          => 'faq_contact_text',
			'type'          => 'textarea',
			'rows'          => 3,
			'default_value' => 'We work with businesses and organisations looking to expand into new markets, secure reliable supply chains, or explore strategic partnerships across our operating sectors.',
		),

		// ── Right Column: FAQ Accordion ───────────────────────────
		array(
			'key'           => 'field_faq_r_eyebrow',
			'label'         => 'FAQ Column Eyebrow',
			'name'          => 'faq_r_eyebrow',
			'type'          => 'text',
			'default_value' => 'Insights & FAQs',
		),
		array(
			'key'           => 'field_faq_heading',
			'label'         => 'FAQ Column Heading',
			'name'          => 'faq_heading',
			'type'          => 'text',
			'default_value' => 'Frequently Asked Questions',
		),
		array(
			'key'           => 'field_faq_r_intro',
			'label'         => 'FAQ Column Intro Text',
			'name'          => 'faq_r_intro',
			'type'          => 'textarea',
			'rows'          => 3,
			'default_value' => 'Answers to common questions about our corporate structure, operations, and global partnership model.',
		),
		array(
			'key'    => 'field_faq_items',
			'label'  => 'FAQ Items',
			'name'   => 'faq_items',
			'type'   => 'repeater',
			'button_label' => 'Add FAQ Item',
			'sub_fields'   => array(
				array(
					'key'   => 'field_faq_question',
					'label' => 'Question',
					'name'  => 'question',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_faq_answer',
					'label' => 'Answer',
					'name'  => 'answer',
					'type'  => 'textarea',
					'rows'  => 3,
				),
			),
		),
	),
	'location' => array(
		array( array( 'param' => 'page_type', 'operator' => '==', 'value' => 'front_page' ) ),
	),
	'menu_order' => 50,
) );

// ══════════════════════════════════════════════════════════════
// 7. COMPANY CPT FIELDS (for single-company.php)
// ══════════════════════════════════════════════════════════════
acf_add_local_field_group( array(
	'key'    => 'group_company_fields',
	'title'  => '🏭 Company — All Sections',
	'fields' => array(
		// Banner
		array( 'key' => 'field_co_banner_bg', 'label' => 'Banner Background Image', 'name' => 'banner_bg_image', 'type' => 'image', 'return_format' => 'url' ),
		array( 'key' => 'field_co_watermark', 'label' => 'Banner Watermark', 'name' => 'banner_watermark', 'type' => 'text' ),
		array( 'key' => 'field_co_banner_title', 'label' => 'Banner Heading (H1)', 'name' => 'banner_title', 'type' => 'text', 'instructions' => 'Leave blank to use the company name.' ),
		array( 'key' => 'field_co_banner_subtitle', 'label' => 'Banner Subtitle / Lead Text', 'name' => 'banner_subtitle', 'type' => 'textarea', 'rows' => 3 ),
		array( 'key' => 'field_co_sector_tag', 'label' => 'Sector Tag', 'name' => 'sector_tag', 'type' => 'text' ),

		// Intro Section
		array( 'key' => 'field_co_intro_watermark', 'label' => 'Intro Watermark', 'name' => 'intro_watermark', 'type' => 'text', 'default_value' => 'OVERVIEW' ),
		array( 'key' => 'field_co_intro_eyebrow', 'label' => 'Intro Eyebrow', 'name' => 'intro_eyebrow', 'type' => 'text', 'default_value' => 'Company Overview' ),
		array( 'key' => 'field_co_intro_heading', 'label' => 'Intro Heading', 'name' => 'intro_heading', 'type' => 'text' ),
		array( 'key' => 'field_co_intro_statement', 'label' => 'Intro Lead Statement', 'name' => 'intro_statement', 'type' => 'textarea', 'rows' => 3 ),
		array( 'key' => 'field_co_intro_narrative', 'label' => 'Intro Narrative', 'name' => 'intro_narrative', 'type' => 'wysiwyg' ),
		array( 'key' => 'field_co_intro_photo', 'label' => 'Operational Photo', 'name' => 'intro_photo', 'type' => 'image', 'return_format' => 'url' ),

		// Story / Journey
		array( 'key' => 'field_co_story_eyebrow', 'label' => 'Story Eyebrow', 'name' => 'story_eyebrow', 'type' => 'text', 'default_value' => 'Our Journey' ),
		array( 'key' => 'field_co_story_heading', 'label' => 'Story Heading', 'name' => 'story_heading', 'type' => 'text', 'default_value' => 'Built With Purpose' ),
		array( 'key' => 'field_co_story_watermark', 'label' => 'Story Watermark', 'name' => 'story_watermark', 'type' => 'text', 'default_value' => 'PURPOSE' ),
		array(
			'key'    => 'field_co_story_steps',
			'label'  => 'Timeline Steps',
			'name'   => 'story_steps',
			'type'   => 'repeater',
			'button_label' => 'Add Step',
			'sub_fields' => array(
				array( 'key' => 'field_co_step_badge', 'label' => 'Phase Badge', 'name' => 'step_badge', 'type' => 'text' ),
				array( 'key' => 'field_co_step_title', 'label' => 'Step Title', 'name' => 'step_title', 'type' => 'text' ),
				array( 'key' => 'field_co_step_text', 'label' => 'Step Description', 'name' => 'step_text', 'type' => 'textarea', 'rows' => 2 ),
			),
		),

		// Business/Service Areas
		array( 'key' => 'field_co_areas_eyebrow', 'label' => 'Areas Eyebrow', 'name' => 'areas_eyebrow', 'type' => 'text', 'default_value' => 'Core Business' ),
		array( 'key' => 'field_co_areas_heading', 'label' => 'Areas Heading', 'name' => 'areas_heading', 'type' => 'text' ),
		array( 'key' => 'field_co_areas_watermark', 'label' => 'Areas Watermark', 'name' => 'areas_watermark', 'type' => 'text' ),
		array(
			'key'    => 'field_co_area_panels',
			'label'  => 'Business / Service Panels',
			'name'   => 'area_panels',
			'type'   => 'repeater',
			'button_label' => 'Add Panel',
			'sub_fields' => array(
				array( 'key' => 'field_co_panel_photo', 'label' => 'Photo (unused by current design — panels render as an icon card)', 'name' => 'panel_photo', 'type' => 'image', 'return_format' => 'url' ),
				array( 'key' => 'field_co_panel_icon', 'label' => 'Icon Key', 'name' => 'panel_icon', 'type' => 'text', 'instructions' => 'Icon Key options: petroleum, agri, medical, logistics, industry, bajaj, feed, fleet, trade_ship, transport_truck, default.' ),
				array( 'key' => 'field_co_panel_number', 'label' => 'Number', 'name' => 'panel_number', 'type' => 'text' ),
				array( 'key' => 'field_co_panel_title', 'label' => 'Title', 'name' => 'panel_title', 'type' => 'text' ),
				array( 'key' => 'field_co_panel_desc', 'label' => 'Description', 'name' => 'panel_description', 'type' => 'textarea', 'rows' => 2 ),
			),
		),

		// Markets
		array( 'key' => 'field_co_markets_eyebrow', 'label' => 'Markets Eyebrow', 'name' => 'markets_eyebrow', 'type' => 'text', 'default_value' => 'Geographic Footprint' ),
		array( 'key' => 'field_co_markets_heading', 'label' => 'Markets Heading', 'name' => 'markets_heading', 'type' => 'text', 'default_value' => 'Markets & Operational Reach' ),
		array( 'key' => 'field_co_markets_watermark', 'label' => 'Markets Watermark', 'name' => 'markets_watermark', 'type' => 'text', 'default_value' => 'REACH' ),
		array(
			'key'    => 'field_co_markets_list',
			'label'  => 'Market Cards',
			'name'   => 'markets_list',
			'type'   => 'repeater',
			'button_label' => 'Add Market',
			'sub_fields' => array(
				array( 'key' => 'field_co_market_icon', 'label' => 'Icon Key', 'name' => 'market_icon', 'type' => 'text', 'instructions' => 'globe / port / building / route' ),
				array( 'key' => 'field_co_market_title', 'label' => 'Location / Corridor Title', 'name' => 'market_title', 'type' => 'text' ),
				array( 'key' => 'field_co_market_text', 'label' => 'Description', 'name' => 'market_text', 'type' => 'textarea', 'rows' => 2 ),
			),
		),

		// Showcase
		array( 'key' => 'field_co_showcase_watermark', 'label' => 'Showcase Watermark', 'name' => 'showcase_watermark', 'type' => 'text', 'default_value' => 'OPERATIONS' ),
		array( 'key' => 'field_co_showcase_eyebrow', 'label' => 'Showcase Eyebrow', 'name' => 'showcase_eyebrow', 'type' => 'text', 'default_value' => 'Operations in Motion' ),
		array( 'key' => 'field_co_showcase_heading', 'label' => 'Showcase Heading', 'name' => 'showcase_heading', 'type' => 'text' ),
		array( 'key' => 'field_co_showcase_lead', 'label' => 'Lead Image', 'name' => 'showcase_lead_image', 'type' => 'image', 'return_format' => 'url' ),
		array( 'key' => 'field_co_showcase_side', 'label' => 'Side Images (Gallery)', 'name' => 'showcase_side_images', 'type' => 'gallery', 'return_format' => 'url' ),

		// CTA
		array( 'key' => 'field_co_cta_bg', 'label' => 'CTA Background Image', 'name' => 'cta_bg_image', 'type' => 'image', 'return_format' => 'url' ),
		array( 'key' => 'field_co_cta_eyebrow', 'label' => 'CTA Eyebrow', 'name' => 'cta_eyebrow', 'type' => 'text', 'default_value' => 'Work With Us' ),
		array( 'key' => 'field_co_cta_heading', 'label' => 'CTA Heading', 'name' => 'cta_heading', 'type' => 'text', 'default_value' => "Let's Build Stronger Partnerships Together." ),
		array( 'key' => 'field_co_cta_text', 'label' => 'CTA Text', 'name' => 'cta_text', 'type' => 'textarea', 'rows' => 2 ),
		array( 'key' => 'field_co_cta_btn_label', 'label' => 'CTA Button Label', 'name' => 'cta_btn_label', 'type' => 'text', 'default_value' => 'Contact Us' ),
		array( 'key' => 'field_co_cta_btn_link', 'label' => 'CTA Button Link', 'name' => 'cta_btn_link', 'type' => 'text', 'default_value' => '/contact/' ),

		// Ecosystem section header
		array( 'key' => 'field_co_ecosystem_watermark', 'label' => 'Ecosystem Watermark', 'name' => 'ecosystem_watermark', 'type' => 'text', 'default_value' => 'ECOSYSTEM' ),
		array( 'key' => 'field_co_ecosystem_eyebrow', 'label' => 'Ecosystem Eyebrow', 'name' => 'ecosystem_eyebrow', 'type' => 'text', 'default_value' => 'Group Integration' ),
		array( 'key' => 'field_co_ecosystem_heading', 'label' => 'Ecosystem Heading', 'name' => 'ecosystem_heading', 'type' => 'text', 'default_value' => 'Part of a Bigger Business Ecosystem' ),
		array( 'key' => 'field_co_ecosystem_intro', 'label' => 'Ecosystem Intro', 'name' => 'ecosystem_intro', 'type' => 'text', 'default_value' => "Connecting sector-leading capabilities under Altysier Group's global umbrella." ),
	),
	'location' => array(
		array( array( 'param' => 'post_type', 'operator' => '==', 'value' => 'company' ) ),
	),
	'menu_order' => 10,
	'position'   => 'normal',
) );

// ══════════════════════════════════════════════════════════════
// 8. CONTACT PAGE FIELDS
// ══════════════════════════════════════════════════════════════
acf_add_local_field_group( array(
	'key'    => 'group_contact_page',
	'title'  => '📞 Contact Page — All Sections',
	'fields' => array(
		// Locations
		array( 'key' => 'field_contact_locations_watermark', 'label' => 'Locations Watermark', 'name' => 'locations_watermark', 'type' => 'text', 'default_value' => 'PRESENCE' ),
		array( 'key' => 'field_contact_locations_eyebrow', 'label' => 'Locations Eyebrow', 'name' => 'locations_eyebrow', 'type' => 'text', 'default_value' => 'Operating Hubs' ),
		array( 'key' => 'field_contact_locations_heading', 'label' => 'Locations Heading', 'name' => 'locations_heading', 'type' => 'text', 'default_value' => 'Our Strategic Locations' ),
		array( 'key' => 'field_contact_locations_subheading', 'label' => 'Locations Subheading', 'name' => 'locations_subheading', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Connecting international commerce from our UAE headquarters to our East African operating footprint.' ),
		array(
			'key' => 'field_contact_locations', 'label' => 'Location Cards', 'name' => 'locations', 'type' => 'repeater', 'button_label' => 'Add Location',
			'instructions' => 'Leave Phone blank to hide the phone line for that location (e.g. the Khartoum card originally has no phone number).',
			'sub_fields' => array(
				array( 'key' => 'field_contact_loc_bg', 'label' => 'Background Photo', 'name' => 'bg_image', 'type' => 'image', 'return_format' => 'url' ),
				array( 'key' => 'field_contact_loc_badge', 'label' => 'Badge Text', 'name' => 'badge', 'type' => 'text' ),
				array( 'key' => 'field_contact_loc_city', 'label' => 'City', 'name' => 'city', 'type' => 'text' ),
				array( 'key' => 'field_contact_loc_role', 'label' => 'Role / Description', 'name' => 'role', 'type' => 'text' ),
				array( 'key' => 'field_contact_loc_address', 'label' => 'Address', 'name' => 'address', 'type' => 'textarea', 'rows' => 3 ),
				array( 'key' => 'field_contact_loc_phone', 'label' => 'Phone (optional)', 'name' => 'phone', 'type' => 'text' ),
				array( 'key' => 'field_contact_loc_email', 'label' => 'Email', 'name' => 'email', 'type' => 'text' ),
			),
		),

		// Enquiry Form
		array( 'key' => 'field_contact_enquiry_watermark', 'label' => 'Enquiry Watermark', 'name' => 'enquiry_watermark', 'type' => 'text', 'default_value' => 'ENQUIRY' ),
		array( 'key' => 'field_contact_form_eyebrow', 'label' => 'Form Eyebrow', 'name' => 'form_eyebrow', 'type' => 'text', 'default_value' => 'Direct Engagement' ),
		array( 'key' => 'field_contact_form_heading', 'label' => 'Form Heading', 'name' => 'form_heading', 'type' => 'text', 'default_value' => 'How Can We Help?' ),
		array( 'key' => 'field_contact_statement', 'label' => 'Form Intro Statement', 'name' => 'statement', 'type' => 'text', 'default_value' => 'Direct communication with our corporate trade and enterprise relations desk.' ),
		array( 'key' => 'field_contact_description', 'label' => 'Form Intro Description', 'name' => 'description', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Please submit your inquiry with relevant project or supply details. Our specialized industry representatives review every message and respond within 24 business hours.' ),

		// B2B Routes
		array( 'key' => 'field_contact_b2b_watermark', 'label' => 'B2B Watermark', 'name' => 'b2b_watermark', 'type' => 'text', 'default_value' => 'ROUTES' ),
		array( 'key' => 'field_contact_b2b_eyebrow', 'label' => 'B2B Eyebrow', 'name' => 'b2b_eyebrow', 'type' => 'text', 'default_value' => 'Engagement Pathways' ),
		array( 'key' => 'field_contact_b2b_heading', 'label' => 'B2B Heading', 'name' => 'b2b_heading', 'type' => 'text', 'default_value' => 'Looking for a Business Partnership?' ),
		array( 'key' => 'field_contact_b2b_subheading', 'label' => 'B2B Subheading', 'name' => 'b2b_subheading', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'We provide structured commercial avenues tailored to each type of commercial collaborator.' ),
		array(
			'key' => 'field_contact_b2b_routes', 'label' => 'B2B Route Cards', 'name' => 'b2b_routes', 'type' => 'repeater', 'button_label' => 'Add Route',
			'instructions' => 'Icon Key options: trade_ship, people, globe-alt, filing-cabinet, handshake (falls back to a plain circle). Leave Link URL blank + fill "Inquiry Subject" to scroll to and pre-fill the enquiry form instead of navigating away.',
			'sub_fields' => array(
				array( 'key' => 'field_contact_route_icon', 'label' => 'Icon Key', 'name' => 'icon_key', 'type' => 'text' ),
				array( 'key' => 'field_contact_route_title', 'label' => 'Title', 'name' => 'title', 'type' => 'text' ),
				array( 'key' => 'field_contact_route_text', 'label' => 'Text', 'name' => 'text', 'type' => 'textarea', 'rows' => 2 ),
				array( 'key' => 'field_contact_route_btn_label', 'label' => 'Button Label', 'name' => 'btn_label', 'type' => 'text' ),
				array( 'key' => 'field_contact_route_subject', 'label' => 'Inquiry Subject (optional)', 'name' => 'subject', 'type' => 'text' ),
				array( 'key' => 'field_contact_route_link', 'label' => 'Link URL (optional)', 'name' => 'link', 'type' => 'text' ),
			),
		),

		// Maps
		array( 'key' => 'field_contact_maps_watermark', 'label' => 'Maps Watermark', 'name' => 'maps_watermark', 'type' => 'text', 'default_value' => 'MAPS' ),
		array( 'key' => 'field_contact_maps_eyebrow', 'label' => 'Maps Eyebrow', 'name' => 'maps_eyebrow', 'type' => 'text', 'default_value' => 'Geographic Coordinates' ),
		array( 'key' => 'field_contact_maps_heading', 'label' => 'Maps Heading', 'name' => 'maps_heading', 'type' => 'text', 'default_value' => 'Find Our Offices' ),
		array( 'key' => 'field_contact_dubai_map', 'label' => 'Dubai Map Embed URL / iframe', 'name' => 'dubai_map_embed', 'type' => 'textarea', 'rows' => 3, 'instructions' => 'Paste full Google Maps iframe code or embed URL.' ),
		array( 'key' => 'field_contact_sudan_map', 'label' => 'Sudan Map Embed URL / iframe', 'name' => 'khartoum_map_embed', 'type' => 'textarea', 'rows' => 3 ),

		// CTA
		array( 'key' => 'field_contact_cta_watermark', 'label' => 'CTA Watermark', 'name' => 'cta_watermark', 'type' => 'text', 'default_value' => 'PARTNERSHIP' ),
		array( 'key' => 'field_contact_cta_bg', 'label' => 'CTA Background Photo', 'name' => 'cta_bg_image', 'type' => 'image', 'return_format' => 'url' ),
		array( 'key' => 'field_contact_cta_eyebrow', 'label' => 'CTA Eyebrow', 'name' => 'cta_eyebrow', 'type' => 'text', 'default_value' => 'Grow With Us' ),
		array( 'key' => 'field_contact_cta_heading', 'label' => 'CTA Heading', 'name' => 'cta_heading', 'type' => 'text', 'default_value' => "Let's Build Stronger Trade Partnerships Together." ),
		array( 'key' => 'field_contact_cta_text', 'label' => 'CTA Text', 'name' => 'cta_text', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Join a growing network of international suppliers, regional distribution partners, and institutional clients building resilient commercial infrastructure across Africa and the Middle East.' ),
		array( 'key' => 'field_contact_cta_btn', 'label' => 'CTA Button Label', 'name' => 'cta_btn', 'type' => 'text', 'default_value' => 'Partner With Us' ),
	),
	'location' => array(
		array( array( 'param' => 'page_template', 'operator' => '==', 'value' => 'page-contact.php' ) ),
		array( array( 'param' => 'page_title', 'operator' => '==', 'value' => 'Contact Us' ) ),
	),
	'menu_order' => 20,
) );

// ══════════════════════════════════════════════════════════════
// 9. LEGAL PAGES (PRIVACY POLICY & TERMS OF USE)
// ══════════════════════════════════════════════════════════════
acf_add_local_field_group( array(
	'key'    => 'group_legal_pages',
	'title'  => '⚖️ Legal Page — Meta & Sections',
	'fields' => array(
		array( 'key' => 'field_legal_effective_date', 'label' => 'Effective Date', 'name' => 'effective_date', 'type' => 'text', 'default_value' => 'January 1, 2026' ),
		array( 'key' => 'field_legal_last_updated', 'label' => 'Last Updated', 'name' => 'last_updated', 'type' => 'text', 'default_value' => 'September 2026' ),
		array(
			'key'          => 'field_legal_sections',
			'label'        => 'Legal Sections',
			'name'         => 'legal_sections',
			'type'         => 'repeater',
			'button_label' => 'Add Section',
			'instructions' => 'Each section is auto-numbered (01., 02., …) on the frontend. "Highlight Box" renders as a bordered callout — use it for the same kind of emphasized notice as the original page (e.g. "Strict Prohibition on Sale of Data"). "Body (after box)" is optional extra copy that renders below the callout.',
			'sub_fields'   => array(
				array( 'key' => 'field_legal_section_heading', 'label' => 'Section Heading', 'name' => 'heading', 'type' => 'text' ),
				array( 'key' => 'field_legal_section_body', 'label' => 'Body', 'name' => 'body', 'type' => 'wysiwyg', 'tabs' => 'visual', 'media_upload' => 0, 'toolbar' => 'basic' ),
				array( 'key' => 'field_legal_section_box', 'label' => 'Highlight Box (optional)', 'name' => 'highlight_box', 'type' => 'wysiwyg', 'tabs' => 'visual', 'media_upload' => 0, 'toolbar' => 'basic' ),
				array( 'key' => 'field_legal_section_body_after', 'label' => 'Body — After Box (optional)', 'name' => 'body_after', 'type' => 'wysiwyg', 'tabs' => 'visual', 'media_upload' => 0, 'toolbar' => 'basic' ),
			),
		),
	),
	'location' => array(
		array( array( 'param' => 'page_template', 'operator' => '==', 'value' => 'page-privacy.php' ) ),
		array( array( 'param' => 'page_template', 'operator' => '==', 'value' => 'page-terms.php' ) ),
		array( array( 'param' => 'page_title', 'operator' => '==', 'value' => 'Privacy Policy' ) ),
		array( array( 'param' => 'page_title', 'operator' => '==', 'value' => 'Terms of Use' ) ),
	),
	'menu_order' => 30,
) );

// ══════════════════════════════════════════════════════════════
// 10. ABOUT US PAGE — ALL SECTIONS
// ══════════════════════════════════════════════════════════════
acf_add_local_field_group( array(
	'key'    => 'group_about_page',
	'title'  => '👥 About Page — All Sections',
	'fields' => array(
		// Who We Are
		array( 'key' => 'field_about_intro_watermark', 'label' => 'Intro Watermark', 'name' => 'intro_watermark', 'type' => 'text', 'default_value' => 'WHO WE ARE' ),
		array( 'key' => 'field_about_intro_eyebrow', 'label' => 'Intro Eyebrow', 'name' => 'intro_eyebrow', 'type' => 'text', 'default_value' => 'Who We Are' ),
		array( 'key' => 'field_about_intro_heading', 'label' => 'Intro Heading', 'name' => 'intro_heading', 'type' => 'text', 'default_value' => 'A Trusted International Business Group' ),
		array( 'key' => 'field_about_intro_statement', 'label' => 'Intro Statement', 'name' => 'intro_statement', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'A diversified group connecting specialized businesses across international trade, industrial investment, manufacturing and distribution.' ),
		array( 'key' => 'field_about_intro_narrative', 'label' => 'Intro Narrative', 'name' => 'intro_narrative', 'type' => 'textarea', 'rows' => 4, 'default_value' => 'Altysier Group brings together specialized companies operating across international trade, industrial investment, manufacturing, and distribution. Our businesses support essential sectors including energy products, agriculture, food security, healthcare supplies, transportation, and industrial development. With strong market knowledge and reliable partnerships, we connect suppliers and buyers through transparent operations and consistent delivery standards.' ),
		array( 'key' => 'field_about_intro_photo', 'label' => 'Intro Photo', 'name' => 'intro_photo', 'type' => 'image', 'return_format' => 'url' ),

		// What Defines Altysier
		array( 'key' => 'field_about_statement_watermark', 'label' => 'Statement Watermark', 'name' => 'statement_watermark', 'type' => 'text', 'default_value' => 'WHAT DEFINES US' ),
		array( 'key' => 'field_about_statement_bg', 'label' => 'Statement Background Photo', 'name' => 'statement_bg_image', 'type' => 'image', 'return_format' => 'url' ),
		array( 'key' => 'field_about_statement_eyebrow', 'label' => 'Statement Eyebrow', 'name' => 'statement_eyebrow', 'type' => 'text', 'default_value' => 'Our Foundation' ),
		array( 'key' => 'field_about_statement_heading', 'label' => 'Statement Heading', 'name' => 'statement_heading', 'type' => 'text', 'default_value' => 'Established for Long-Term Growth' ),
		array( 'key' => 'field_about_statement_text', 'label' => 'Statement Text', 'name' => 'statement_text', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Building sustainable trade relationships through integrity, consistency and operational excellence across global markets.' ),

		// Our Culture
		array( 'key' => 'field_about_culture_watermark', 'label' => 'Culture Watermark', 'name' => 'culture_watermark', 'type' => 'text', 'default_value' => 'OUR CULTURE' ),
		array( 'key' => 'field_about_culture_eyebrow', 'label' => 'Culture Eyebrow', 'name' => 'culture_eyebrow', 'type' => 'text', 'default_value' => 'Our Culture & Values' ),
		array( 'key' => 'field_about_culture_heading', 'label' => 'Culture Heading', 'name' => 'culture_heading', 'type' => 'text', 'default_value' => 'Built on Trust. Driven by Excellence.' ),
		array( 'key' => 'field_about_culture_intro', 'label' => 'Culture Intro', 'name' => 'culture_intro', 'type' => 'text', 'default_value' => 'Our values define how we operate, govern our companies, and forge enduring partnerships worldwide.' ),
		array(
			'key' => 'field_about_culture_values', 'label' => 'Culture Value Cards', 'name' => 'culture_values', 'type' => 'repeater', 'button_label' => 'Add Value',
			'sub_fields' => array(
				array( 'key' => 'field_about_culture_num', 'label' => 'Number', 'name' => 'num', 'type' => 'text' ),
				array( 'key' => 'field_about_culture_title', 'label' => 'Title', 'name' => 'title', 'type' => 'text' ),
				array( 'key' => 'field_about_culture_text', 'label' => 'Text', 'name' => 'text', 'type' => 'textarea', 'rows' => 2 ),
			),
		),

		// Vision / Mission / Motto
		array( 'key' => 'field_about_vmm_watermark', 'label' => 'VMM Watermark', 'name' => 'vmm_watermark', 'type' => 'text', 'default_value' => 'VISION & MISSION' ),
		array( 'key' => 'field_about_vmm_eyebrow', 'label' => 'VMM Eyebrow', 'name' => 'vmm_eyebrow', 'type' => 'text', 'default_value' => 'Our Purpose' ),
		array( 'key' => 'field_about_vmm_heading', 'label' => 'VMM Heading', 'name' => 'vmm_heading', 'type' => 'text', 'default_value' => 'Guiding Principles for Enduring Impact' ),
		array( 'key' => 'field_about_vmm_intro', 'label' => 'VMM Intro', 'name' => 'vmm_intro', 'type' => 'textarea', 'rows' => 2, 'default_value' => "The foundational pillars that steer Altysier Group's long-term commercial direction and institutional vision." ),
		array( 'key' => 'field_about_vision_title', 'label' => 'Vision — Title', 'name' => 'vision_title', 'type' => 'text', 'default_value' => 'Vision' ),
		array( 'key' => 'field_about_vision_statement', 'label' => 'Vision — Statement', 'name' => 'vision_statement', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'To be a trusted global business group delivering essential products and industrial value through reliable partnerships and responsible trade.' ),
		array( 'key' => 'field_about_mission_title', 'label' => 'Mission — Title', 'name' => 'mission_title', 'type' => 'text', 'default_value' => 'Mission' ),
		array( 'key' => 'field_about_mission_statement', 'label' => 'Mission — Statement', 'name' => 'mission_statement', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'To create long-term value by connecting markets, optimizing supply chains, and investing in industries that support economic stability and growth across regions.' ),
		array( 'key' => 'field_about_motto_title', 'label' => 'Motto — Title', 'name' => 'motto_title', 'type' => 'text', 'default_value' => 'Motto' ),
		array( 'key' => 'field_about_motto_statement', 'label' => 'Motto — Statement', 'name' => 'motto_statement', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'We bridge industries and markets through smart trading and industrial investments.' ),

		// Leadership
		array( 'key' => 'field_about_leadership_watermark', 'label' => 'Leadership Watermark', 'name' => 'leadership_watermark', 'type' => 'text', 'default_value' => 'OUR LEADERSHIP' ),
		array( 'key' => 'field_about_leadership_eyebrow', 'label' => 'Leadership Eyebrow', 'name' => 'leadership_eyebrow', 'type' => 'text', 'default_value' => 'Executive Leadership' ),
		array( 'key' => 'field_about_leadership_heading', 'label' => 'Leadership Heading', 'name' => 'leadership_heading', 'type' => 'text', 'default_value' => 'A Word From Our Leadership' ),
		array( 'key' => 'field_about_leadership_intro', 'label' => 'Leadership Intro', 'name' => 'leadership_intro', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Guiding our diversified business portfolio with strategic focus, integrity, and long-term vision.' ),
		array( 'key' => 'field_about_leader_name', 'label' => 'Leader Name', 'name' => 'leader_name', 'type' => 'text', 'default_value' => 'Omer Mahmoud Yousif Ali' ),
		array( 'key' => 'field_about_leader_role', 'label' => 'Leader Role', 'name' => 'leader_role', 'type' => 'text', 'default_value' => 'Chief Executive Officer, Altysier Group' ),
		array(
			'key' => 'field_about_leader_quote', 'label' => 'Leader Quote', 'name' => 'leader_quote', 'type' => 'wysiwyg', 'tabs' => 'visual', 'media_upload' => 0, 'toolbar' => 'basic',
			'default_value' => '<p>&#8220;At Altysier Group, we believe that strong businesses are built on trust, consistency, and responsibility. From our earliest operations, our focus has been on creating reliable trade channels that support essential industries and contribute to economic stability.</p><p>Global markets are constantly evolving, and our role is to adapt with integrity while maintaining the highest standards of quality and professionalism. Whether we are trading strategic commodities, investing in industrial growth, supporting transportation solutions, or manufacturing agricultural products, our objective remains the same: to deliver value that lasts.</p><p>We place great importance on long-term partnerships, transparent business practices, and operational excellence. Through our group companies, we continue to expand responsibly while supporting communities, industries, and supply chains across international markets.</p><p>We look forward to building meaningful collaborations and growing together.&#8221;</p>',
		),

		// Business Ecosystem
		array( 'key' => 'field_about_ecosystem_watermark', 'label' => 'Ecosystem Watermark', 'name' => 'ecosystem_watermark', 'type' => 'text', 'default_value' => 'OUR ECOSYSTEM' ),
		array( 'key' => 'field_about_ecosystem_eyebrow', 'label' => 'Ecosystem Eyebrow', 'name' => 'ecosystem_eyebrow', 'type' => 'text', 'default_value' => 'Group Capabilities' ),
		array( 'key' => 'field_about_ecosystem_heading', 'label' => 'Ecosystem Heading', 'name' => 'ecosystem_heading', 'type' => 'text', 'default_value' => 'One Group. Multiple Capabilities.' ),
		array( 'key' => 'field_about_ecosystem_intro', 'label' => 'Ecosystem Intro', 'name' => 'ecosystem_intro', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Connecting specialized industry leaders under a shared institutional framework across essential sectors.' ),
		array(
			'key' => 'field_about_capabilities_list', 'label' => 'Capability Pills', 'name' => 'capabilities_list', 'type' => 'repeater', 'button_label' => 'Add Capability',
			'instructions' => 'Icon Key options: trade_ship, industry, default, transport_truck, feed, medical, bajaj.',
			'sub_fields' => array(
				array( 'key' => 'field_about_capability_icon', 'label' => 'Icon Key', 'name' => 'icon_key', 'type' => 'text' ),
				array( 'key' => 'field_about_capability_title', 'label' => 'Title', 'name' => 'title', 'type' => 'text' ),
			),
		),
		array( 'key' => 'field_about_ecosystem_action_label', 'label' => 'Ecosystem Button Label', 'name' => 'ecosystem_action_label', 'type' => 'text', 'default_value' => 'Explore Our Companies' ),

		// CTA
		array( 'key' => 'field_about_cta_watermark', 'label' => 'CTA Watermark', 'name' => 'cta_watermark', 'type' => 'text', 'default_value' => 'PARTNERSHIP' ),
		array( 'key' => 'field_about_cta_bg', 'label' => 'CTA Background Photo', 'name' => 'cta_bg_image', 'type' => 'image', 'return_format' => 'url' ),
		array( 'key' => 'field_about_cta_eyebrow', 'label' => 'CTA Eyebrow', 'name' => 'cta_eyebrow', 'type' => 'text', 'default_value' => 'Work With Us' ),
		array( 'key' => 'field_about_cta_heading', 'label' => 'CTA Heading', 'name' => 'cta_heading', 'type' => 'text', 'default_value' => "Let's Build Strong Trade Partnerships Together." ),
		array( 'key' => 'field_about_cta_text', 'label' => 'CTA Text', 'name' => 'cta_text', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Whether you are seeking supply chain resilience, market expansion, or strategic co-investment, our leadership team is ready to connect.' ),
		array( 'key' => 'field_about_cta_btn', 'label' => 'CTA Button Label', 'name' => 'cta_btn', 'type' => 'text', 'default_value' => 'Partner With Us' ),
	),
	'location' => array(
		array( array( 'param' => 'page_template', 'operator' => '==', 'value' => 'page-about.php' ) ),
		array( array( 'param' => 'page_title', 'operator' => '==', 'value' => 'About Us' ) ),
	),
	'menu_order' => 50,
) );

// ══════════════════════════════════════════════════════════════
// 11. CSR & SUSTAINABILITY PAGE — ALL SECTIONS
// ══════════════════════════════════════════════════════════════
acf_add_local_field_group( array(
	'key'    => 'group_csr_page',
	'title'  => '🌱 CSR Page — All Sections',
	'fields' => array(
		// Ethical Business
		array( 'key' => 'field_csr_ethical_watermark', 'label' => 'Ethics Watermark', 'name' => 'ethical_watermark', 'type' => 'text', 'default_value' => 'ETHICS' ),
		array( 'key' => 'field_csr_ethical_eyebrow', 'label' => 'Ethics Eyebrow', 'name' => 'ethical_eyebrow', 'type' => 'text', 'default_value' => 'Pillar 01 · Corporate Governance & Trust' ),
		array( 'key' => 'field_csr_ethical_heading', 'label' => 'Ethics Heading', 'name' => 'ethical_heading', 'type' => 'text', 'default_value' => 'Doing Business the Right Way' ),
		array( 'key' => 'field_csr_ethical_statement', 'label' => 'Ethics Statement', 'name' => 'ethical_statement', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'We believe lasting enterprise value is impossible without rigorous transparency, audited compliance, and deep mutual respect across all commercial relationships.' ),
		array(
			'key' => 'field_csr_ethical_narrative', 'label' => 'Ethics Narrative', 'name' => 'ethical_narrative', 'type' => 'wysiwyg', 'tabs' => 'visual', 'media_upload' => 0, 'toolbar' => 'basic',
			'default_value' => '<p>In complex cross-border trade, integrity is not merely a policy — it is our operational lifeline. From commodity procurement to municipal infrastructure contracts, Altysier Group holds every employee, operating subsidiary, and commercial partner to clear ethical standards.</p><p>We maintain stringent anti-corruption practices, clear contract terms, fully verifiable customs declarations, and transparent pricing structures that safeguard both our partners and the communities we serve.</p>',
		),
		array(
			'key' => 'field_csr_ethical_principles', 'label' => 'Ethics Principle Cards', 'name' => 'ethical_principles', 'type' => 'repeater', 'button_label' => 'Add Principle',
			'sub_fields' => array(
				array( 'key' => 'field_csr_ep_number', 'label' => 'Number / Tag', 'name' => 'number', 'type' => 'text', 'instructions' => 'e.g. 01 / INTEGRITY' ),
				array( 'key' => 'field_csr_ep_title', 'label' => 'Title', 'name' => 'title', 'type' => 'text' ),
				array( 'key' => 'field_csr_ep_text', 'label' => 'Text', 'name' => 'text', 'type' => 'textarea', 'rows' => 2 ),
			),
		),

		// Economic Growth
		array( 'key' => 'field_csr_economic_watermark', 'label' => 'Growth Watermark', 'name' => 'economic_watermark', 'type' => 'text', 'default_value' => 'GROWTH' ),
		array( 'key' => 'field_csr_economic_eyebrow', 'label' => 'Growth Eyebrow', 'name' => 'economic_eyebrow', 'type' => 'text', 'default_value' => 'Pillar 02 · Economic Empowerment & Jobs' ),
		array( 'key' => 'field_csr_economic_heading', 'label' => 'Growth Heading', 'name' => 'economic_heading', 'type' => 'text', 'default_value' => 'Creating Opportunity. Supporting Growth.' ),
		array( 'key' => 'field_csr_economic_photo', 'label' => 'Photo', 'name' => 'economic_photo', 'type' => 'image', 'return_format' => 'url' ),
		array( 'key' => 'field_csr_economic_badge', 'label' => 'Photo Badge', 'name' => 'economic_badge', 'type' => 'text', 'default_value' => 'Empowering Livelihoods' ),
		array( 'key' => 'field_csr_economic_statement', 'label' => 'Statement', 'name' => 'economic_statement', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'We build commercial pathways that create real family incomes, foster self-employed entrepreneurs, and strengthen domestic business ecosystems.' ),
		array( 'key' => 'field_csr_economic_lead', 'label' => 'Lead Text', 'name' => 'economic_lead', 'type' => 'textarea', 'rows' => 2, 'default_value' => "Sustainable economic impact isn't abstract charity — it is built by giving individuals and enterprises the tools, transport, and capital access they need to thrive independently." ),
		array(
			'key' => 'field_csr_economic_points', 'label' => 'Economic Points', 'name' => 'economic_points', 'type' => 'repeater', 'button_label' => 'Add Point',
			'sub_fields' => array(
				array( 'key' => 'field_csr_ecp_title', 'label' => 'Title', 'name' => 'title', 'type' => 'text' ),
				array( 'key' => 'field_csr_ecp_desc', 'label' => 'Description', 'name' => 'desc', 'type' => 'textarea', 'rows' => 2 ),
			),
		),

		// Food Security
		array( 'key' => 'field_csr_food_watermark', 'label' => 'Security Watermark', 'name' => 'food_watermark', 'type' => 'text', 'default_value' => 'SECURITY' ),
		array( 'key' => 'field_csr_food_eyebrow', 'label' => 'Security Eyebrow', 'name' => 'food_eyebrow', 'type' => 'text', 'default_value' => 'Pillar 03 · Agricultural Vitality' ),
		array( 'key' => 'field_csr_food_heading', 'label' => 'Security Heading', 'name' => 'food_heading', 'type' => 'text', 'default_value' => 'Strengthening Food Security' ),
		array( 'key' => 'field_csr_food_photo', 'label' => 'Photo', 'name' => 'food_photo', 'type' => 'image', 'return_format' => 'url' ),
		array( 'key' => 'field_csr_food_badge', 'label' => 'Photo Badge', 'name' => 'food_badge', 'type' => 'text', 'default_value' => 'Haloub Feed Mill Factory' ),
		array( 'key' => 'field_csr_food_statement', 'label' => 'Statement', 'name' => 'food_statement', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Through Haloub Feed Mill Factory, we directly safeguard regional livestock populations, support crop farmers, and stabilize essential food supplies.' ),
		array( 'key' => 'field_csr_food_lead', 'label' => 'Lead Text', 'name' => 'food_lead', 'type' => 'textarea', 'rows' => 3, 'default_value' => 'Food security in developing markets requires modern local manufacturing. By producing balanced animal feed locally, Altysier Group shields regional farmers from unpredictable global supply disruptions while enhancing rural nutritional security.' ),
		array(
			'key' => 'field_csr_food_points', 'label' => 'Food Security Points', 'name' => 'food_points', 'type' => 'repeater', 'button_label' => 'Add Point',
			'sub_fields' => array(
				array( 'key' => 'field_csr_fp_title', 'label' => 'Title', 'name' => 'title', 'type' => 'text' ),
				array( 'key' => 'field_csr_fp_desc', 'label' => 'Description', 'name' => 'desc', 'type' => 'textarea', 'rows' => 2 ),
			),
		),

		// Environmental Responsibility
		array( 'key' => 'field_csr_env_watermark', 'label' => 'Operations Watermark', 'name' => 'env_watermark', 'type' => 'text', 'default_value' => 'OPERATIONS' ),
		array( 'key' => 'field_csr_env_eyebrow', 'label' => 'Operations Eyebrow', 'name' => 'env_eyebrow', 'type' => 'text', 'default_value' => 'Pillar 04 · Operational Footprint' ),
		array( 'key' => 'field_csr_env_heading', 'label' => 'Operations Heading', 'name' => 'env_heading', 'type' => 'text', 'default_value' => 'Operating With Greater Responsibility' ),
		array( 'key' => 'field_csr_env_subheading', 'label' => 'Operations Subheading', 'name' => 'env_subheading', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Practical, measurable operational stewardship embedded into our haulage fleets, factories, and facilities.' ),
		array(
			'key' => 'field_csr_env_initiatives', 'label' => 'Environmental Initiatives', 'name' => 'env_initiatives', 'type' => 'repeater', 'button_label' => 'Add Initiative',
			'sub_fields' => array(
				array( 'key' => 'field_csr_env_photo', 'label' => 'Photo', 'name' => 'photo', 'type' => 'image', 'return_format' => 'url' ),
				array( 'key' => 'field_csr_env_number', 'label' => 'Number / Tag', 'name' => 'number', 'type' => 'text', 'instructions' => 'e.g. 01 / LOGISTICS' ),
				array( 'key' => 'field_csr_env_title', 'label' => 'Title', 'name' => 'title', 'type' => 'text' ),
				array( 'key' => 'field_csr_env_desc', 'label' => 'Description', 'name' => 'desc', 'type' => 'textarea', 'rows' => 3 ),
			),
		),

		// Group Impact
		array( 'key' => 'field_csr_impact_watermark', 'label' => 'Impact Watermark', 'name' => 'impact_watermark', 'type' => 'text', 'default_value' => 'IMPACT' ),
		array( 'key' => 'field_csr_impact_eyebrow', 'label' => 'Impact Eyebrow', 'name' => 'impact_eyebrow', 'type' => 'text', 'default_value' => 'Integrated Group Impact' ),
		array( 'key' => 'field_csr_impact_heading', 'label' => 'Impact Heading', 'name' => 'impact_heading', 'type' => 'text', 'default_value' => 'How Altysier Businesses Create Lasting Impact' ),
		array( 'key' => 'field_csr_impact_subheading', 'label' => 'Impact Subheading', 'name' => 'impact_subheading', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Each operating company translates our CSR commitments into everyday commercial reality.' ),
		array(
			'key' => 'field_csr_impact_cards', 'label' => 'Group Impact Cards', 'name' => 'group_impact_cards', 'type' => 'repeater', 'button_label' => 'Add Card',
			'sub_fields' => array(
				array( 'key' => 'field_csr_ic_source', 'label' => 'Flow — Source', 'name' => 'source', 'type' => 'text' ),
				array( 'key' => 'field_csr_ic_target', 'label' => 'Flow — Target', 'name' => 'target', 'type' => 'text' ),
				array( 'key' => 'field_csr_ic_title', 'label' => 'Title', 'name' => 'title', 'type' => 'text' ),
				array( 'key' => 'field_csr_ic_text', 'label' => 'Text', 'name' => 'text', 'type' => 'textarea', 'rows' => 2 ),
				array( 'key' => 'field_csr_ic_link', 'label' => 'Link URL', 'name' => 'link', 'type' => 'text' ),
				array( 'key' => 'field_csr_ic_link_label', 'label' => 'Link Label', 'name' => 'link_label', 'type' => 'text', 'default_value' => 'Explore Company →' ),
			),
		),

		// CTA
		array( 'key' => 'field_csr_cta_watermark', 'label' => 'CTA Watermark', 'name' => 'cta_watermark', 'type' => 'text', 'default_value' => 'PARTNERSHIP' ),
		array( 'key' => 'field_csr_cta_bg', 'label' => 'CTA Background Photo', 'name' => 'cta_bg_image', 'type' => 'image', 'return_format' => 'url' ),
		array( 'key' => 'field_csr_cta_eyebrow', 'label' => 'CTA Eyebrow', 'name' => 'cta_eyebrow', 'type' => 'text', 'default_value' => 'Partner With Purpose' ),
		array( 'key' => 'field_csr_cta_heading', 'label' => 'CTA Heading', 'name' => 'cta_heading', 'type' => 'text', 'default_value' => 'Building a More Responsible Future Together.' ),
		array( 'key' => 'field_csr_cta_text', 'label' => 'CTA Text', 'name' => 'cta_text', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Whether you are an agricultural producer, commercial buyer, trade partner, or community stakeholder, we welcome collaborative partnerships that create lasting economic and social value.' ),
		array( 'key' => 'field_csr_cta_btn', 'label' => 'CTA Button Label', 'name' => 'cta_btn', 'type' => 'text', 'default_value' => 'Connect With Us' ),
	),
	'location' => array(
		array( array( 'param' => 'page_template', 'operator' => '==', 'value' => 'page-csr.php' ) ),
		array( array( 'param' => 'page_title', 'operator' => '==', 'value' => 'CSR & Sustainability' ) ),
	),
	'menu_order' => 51,
) );

// ══════════════════════════════════════════════════════════════
// 12. GLOBAL SETTINGS — Header, Footer, Social, Locations
// ══════════════════════════════════════════════════════════════
acf_add_local_field_group( array(
	'key'    => 'group_global_settings',
	'title'  => 'Header, Footer & Contact Details',
	'fields' => array(
		array( 'key' => 'field_gs_tab_header', 'label' => 'Header', 'type' => 'tab', 'placement' => 'top' ),
		array( 'key' => 'field_gs_enable_preloader', 'label' => 'Enable Loading Preloader', 'name' => 'enable_preloader', 'type' => 'true_false', 'default_value' => 1, 'ui' => 1 ),
		array( 'key' => 'field_gs_header_logo', 'label' => 'Header Logo', 'name' => 'header_logo', 'type' => 'image', 'return_format' => 'url', 'instructions' => 'Leave blank to use the theme default logo.' ),
		array( 'key' => 'field_gs_favicon', 'label' => 'Favicon', 'name' => 'favicon', 'type' => 'image', 'return_format' => 'url', 'instructions' => 'Shown in the browser tab. Square image recommended (e.g. 256×256px PNG). Leave blank to use the theme default. Overridden by Settings → General → Site Icon if that is set.' ),

		array( 'key' => 'field_gs_tab_footer', 'label' => 'Footer', 'type' => 'tab', 'placement' => 'top' ),
		array( 'key' => 'field_gs_footer_logo', 'label' => 'Footer Logo', 'name' => 'footer_logo', 'type' => 'image', 'return_format' => 'url', 'instructions' => 'Leave blank to use the theme default logo.' ),
		array( 'key' => 'field_gs_footer_blurb', 'label' => 'Footer Blurb', 'name' => 'footer_blurb', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'A diversified business group building long-term value across international trade, industry and mobility.' ),
		array( 'key' => 'field_gs_footer_copyright', 'label' => 'Footer Copyright Text', 'name' => 'footer_copyright', 'type' => 'text', 'default_value' => 'Altysier Group. All rights reserved.', 'instructions' => 'Shown after "© 2026" in the footer.' ),

		array( 'key' => 'field_gs_tab_social', 'label' => 'Social Links', 'type' => 'tab', 'placement' => 'top' ),
		array( 'key' => 'field_gs_social_linkedin', 'label' => 'LinkedIn URL', 'name' => 'social_linkedin', 'type' => 'text', 'default_value' => '#' ),
		array( 'key' => 'field_gs_social_instagram', 'label' => 'Instagram URL', 'name' => 'social_instagram', 'type' => 'text', 'default_value' => '#' ),
		array( 'key' => 'field_gs_social_twitter', 'label' => 'X / Twitter URL', 'name' => 'social_twitter', 'type' => 'text', 'default_value' => '#' ),
		array( 'key' => 'field_gs_social_facebook', 'label' => 'Facebook URL', 'name' => 'social_facebook', 'type' => 'text', 'default_value' => '#' ),

		array( 'key' => 'field_gs_tab_locations', 'label' => 'Locations & Contact', 'type' => 'tab', 'placement' => 'top' ),
		array( 'key' => 'field_gs_dubai_address', 'label' => 'Dubai Office — Address', 'name' => 'dubai_address', 'type' => 'text', 'default_value' => 'Dubai, United Arab Emirates' ),
		array( 'key' => 'field_gs_dubai_map_url', 'label' => 'Dubai Office — Google Maps Link', 'name' => 'dubai_map_url', 'type' => 'text', 'default_value' => 'https://maps.google.com/?q=Dubai,+United+Arab+Emirates' ),
		array( 'key' => 'field_gs_dubai_phone', 'label' => 'Phone', 'name' => 'dubai_phone', 'type' => 'text', 'default_value' => '+971 4 268 0666' ),
		array( 'key' => 'field_gs_dubai_whatsapp', 'label' => 'WhatsApp Number', 'name' => 'dubai_whatsapp', 'type' => 'text', 'default_value' => '+971 56 144 2525' ),
		array( 'key' => 'field_gs_dubai_email', 'label' => 'Contact Email', 'name' => 'dubai_email', 'type' => 'text', 'default_value' => 'info@altysier.com' ),
		array( 'key' => 'field_gs_saudi_address', 'label' => 'Saudi Office — Address', 'name' => 'saudi_address', 'type' => 'text', 'default_value' => 'Riyadh, Saudi Arabia' ),
		array( 'key' => 'field_gs_saudi_map_url', 'label' => 'Saudi Office — Google Maps Link', 'name' => 'saudi_map_url', 'type' => 'text', 'default_value' => 'https://maps.google.com/?q=Riyadh,+Saudi+Arabia' ),
		array( 'key' => 'field_gs_khartoum_address', 'label' => 'Khartoum Office — Address', 'name' => 'khartoum_address', 'type' => 'text', 'default_value' => 'Khartoum, Sudan' ),
		array( 'key' => 'field_gs_khartoum_map_url', 'label' => 'Khartoum Office — Google Maps Link', 'name' => 'khartoum_map_url', 'type' => 'text', 'default_value' => 'https://maps.google.com/?q=Khartoum,+Sudan' ),
	),
	'location' => array(
		array( array( 'param' => 'options_page', 'operator' => '==', 'value' => 'altysier-global-settings' ) ),
	),
) );

// ══════════════════════════════════════════════════════════════
// 13. GLOBAL SETTINGS — Email & SMTP
// ══════════════════════════════════════════════════════════════
acf_add_local_field_group( array(
	'key'    => 'group_smtp_settings',
	'title'  => 'Gmail SMTP Settings',
	'fields' => array(
		array( 'key' => 'field_smtp_enabled', 'label' => 'Enable Custom SMTP', 'name' => 'smtp_enabled', 'type' => 'true_false', 'default_value' => 1, 'ui' => 1, 'instructions' => 'When off, WordPress falls back to the server\'s default mail sending (usually unreliable — keep this on).' ),
		array( 'key' => 'field_smtp_host', 'label' => 'SMTP Host', 'name' => 'smtp_host', 'type' => 'text', 'default_value' => 'smtp.gmail.com' ),
		array( 'key' => 'field_smtp_port', 'label' => 'SMTP Port', 'name' => 'smtp_port', 'type' => 'number', 'default_value' => 587 ),
		array( 'key' => 'field_smtp_encryption', 'label' => 'Encryption', 'name' => 'smtp_encryption', 'type' => 'select', 'choices' => array( 'tls' => 'TLS', 'ssl' => 'SSL', 'none' => 'None' ), 'default_value' => 'tls' ),
		array( 'key' => 'field_smtp_username', 'label' => 'Gmail Address', 'name' => 'smtp_username', 'type' => 'text', 'instructions' => 'The full Gmail address used to send mail.' ),
		array( 'key' => 'field_smtp_password', 'label' => 'Gmail App Password', 'name' => 'smtp_password', 'type' => 'password', 'instructions' => 'A 16-character Google App Password — NOT your normal Gmail password. Generate one at myaccount.google.com/apppasswords (requires 2-Step Verification enabled).' ),
		array( 'key' => 'field_mail_from_name', 'label' => 'Sender Name', 'name' => 'mail_from_name', 'type' => 'text', 'default_value' => 'Altysier Group Website' ),
		array( 'key' => 'field_mail_from_email', 'label' => 'Sender / Reply-To Email', 'name' => 'mail_from_email', 'type' => 'text', 'instructions' => 'Leave blank to use the Gmail Address above.' ),
		array( 'key' => 'field_enquiry_recipient', 'label' => 'Enquiry Recipient Email', 'name' => 'enquiry_recipient', 'type' => 'text', 'instructions' => 'Where contact-form submissions are delivered.', 'default_value' => 'manu.abhiram@gmail.com' ),
	),
	'location' => array(
		array( array( 'param' => 'options_page', 'operator' => '==', 'value' => 'altysier-smtp-settings' ) ),
	),
) );

// ══════════════════════════════════════════════════════════════
// 14. GLOBAL SETTINGS — reCAPTCHA
// ══════════════════════════════════════════════════════════════
acf_add_local_field_group( array(
	'key'    => 'group_recaptcha_settings',
	'title'  => 'Google reCAPTCHA v3 Settings',
	'fields' => array(
		array( 'key' => 'field_recaptcha_enabled', 'label' => 'Enable reCAPTCHA v3', 'name' => 'recaptcha_enabled', 'type' => 'true_false', 'default_value' => 0, 'ui' => 1, 'instructions' => 'Keep off until both keys below are filled in — forms work fine (nonce + honeypot + rate limiting still apply) with this off.' ),
		array( 'key' => 'field_recaptcha_site_key', 'label' => 'Site Key', 'name' => 'recaptcha_site_key', 'type' => 'text', 'instructions' => 'From google.com/recaptcha/admin — create a v3 key for this domain.' ),
		array( 'key' => 'field_recaptcha_secret_key', 'label' => 'Secret Key', 'name' => 'recaptcha_secret_key', 'type' => 'password', 'instructions' => 'Never exposed to the frontend — used only in the server-side verification request.' ),
		array( 'key' => 'field_recaptcha_threshold', 'label' => 'Score Threshold', 'name' => 'recaptcha_threshold', 'type' => 'number', 'default_value' => 0.5, 'step' => 0.1, 'min' => 0, 'max' => 1, 'instructions' => '0.0 (likely bot) – 1.0 (likely human). Google recommends starting at 0.5.' ),
	),
	'location' => array(
		array( array( 'param' => 'options_page', 'operator' => '==', 'value' => 'altysier-recaptcha-settings' ) ),
	),
) );

// ══════════════════════════════════════════════════════════════
// 14b. GLOBAL SETTINGS — 404 Page Content
// ══════════════════════════════════════════════════════════════
acf_add_local_field_group( array(
	'key'    => 'group_error404_settings',
	'title'  => '🚧 404 Page Content',
	'fields' => array(
		array( 'key' => 'field_error_page_bg_image', 'label' => 'Background Image', 'name' => 'error_page_bg_image', 'type' => 'image', 'return_format' => 'url', 'instructions' => 'Leave blank to use the default background photo.' ),
		array( 'key' => 'field_error_page_title', 'label' => 'Title', 'name' => 'error_page_title', 'type' => 'text', 'default_value' => 'Destination Unavailable' ),
		array( 'key' => 'field_error_page_text', 'label' => 'Description', 'name' => 'error_page_text', 'type' => 'textarea', 'rows' => 3, 'default_value' => 'The page you are attempting to access does not exist, has been relocated, or is temporarily unavailable across our network. Please use the navigation links below to redirect your query.' ),
		array( 'key' => 'field_error_page_btn1_label', 'label' => 'Primary Button Label', 'name' => 'error_page_btn1_label', 'type' => 'text', 'default_value' => 'Return to Home' ),
		array( 'key' => 'field_error_page_btn1_link', 'label' => 'Primary Button Link', 'name' => 'error_page_btn1_link', 'type' => 'text', 'default_value' => '/' ),
		array( 'key' => 'field_error_page_btn2_label', 'label' => 'Secondary Button Label', 'name' => 'error_page_btn2_label', 'type' => 'text', 'default_value' => 'Our Companies' ),
		array( 'key' => 'field_error_page_btn2_link', 'label' => 'Secondary Button Link', 'name' => 'error_page_btn2_link', 'type' => 'text', 'default_value' => '/#companies' ),
		array(
			'key'          => 'field_error_page_links',
			'label'        => 'Helpful Links',
			'name'         => 'error_page_links',
			'type'         => 'repeater',
			'button_label' => 'Add Link Card',
			'instructions' => 'Leave empty to show the default 4 link cards (About Us, Our Companies, CSR & Impact, Contact Us).',
			'sub_fields'   => array(
				array( 'key' => 'field_error_link_title', 'label' => 'Title', 'name' => 'title', 'type' => 'text' ),
				array( 'key' => 'field_error_link_desc', 'label' => 'Description', 'name' => 'desc', 'type' => 'text' ),
				array( 'key' => 'field_error_link_url', 'label' => 'Link', 'name' => 'link', 'type' => 'text' ),
			),
		),
	),
	'location' => array(
		array( array( 'param' => 'options_page', 'operator' => '==', 'value' => 'altysier-404-settings' ) ),
	),
) );

// ══════════════════════════════════════════════════════════════
// 15. FLEXIBLE PAGE BUILDER — for any new page (page-flexible.php)
// ══════════════════════════════════════════════════════════════
// One generic template + this flexible-content field lets an admin assemble a
// brand-new page from the same section types used across the rest of the site
// (same CSS, no new page-*.php file or field group needed per page) by adding,
// removing, and reordering layouts freely.
acf_add_local_field_group( array(
	'key'    => 'group_flexible_builder',
	'title'  => '🧩 Page Builder — Sections',
	'fields' => array(
		array(
			'key'          => 'field_flex_sections',
			'label'        => 'Page Sections',
			'name'         => 'page_sections',
			'type'         => 'flexible_content',
			'button_label' => 'Add Section',
			'layouts'      => array(

				'layout_hero_banner' => array(
					'key' => 'layout_hero_banner', 'name' => 'hero_banner', 'label' => 'Hero Banner', 'display' => 'block',
					'sub_fields' => array(
						array( 'key' => 'field_flex_hero_bg', 'label' => 'Background Photo', 'name' => 'bg_image', 'type' => 'image', 'return_format' => 'url' ),
						array( 'key' => 'field_flex_hero_watermark', 'label' => 'Watermark Text', 'name' => 'watermark', 'type' => 'text' ),
						array( 'key' => 'field_flex_hero_title', 'label' => 'Title (H1)', 'name' => 'title', 'type' => 'text' ),
						array( 'key' => 'field_flex_hero_subtitle', 'label' => 'Subtitle', 'name' => 'subtitle', 'type' => 'textarea', 'rows' => 2 ),
					),
				),

				'layout_text_intro' => array(
					'key' => 'layout_text_intro', 'name' => 'text_intro', 'label' => 'Text Intro (heading + statement + photo)', 'display' => 'block',
					'sub_fields' => array(
						array( 'key' => 'field_flex_intro_watermark', 'label' => 'Watermark Text', 'name' => 'watermark', 'type' => 'text' ),
						array( 'key' => 'field_flex_intro_eyebrow', 'label' => 'Eyebrow', 'name' => 'eyebrow', 'type' => 'text' ),
						array( 'key' => 'field_flex_intro_heading', 'label' => 'Heading', 'name' => 'heading', 'type' => 'text' ),
						array( 'key' => 'field_flex_intro_statement', 'label' => 'Statement (large, bold intro line)', 'name' => 'statement', 'type' => 'textarea', 'rows' => 2 ),
						array( 'key' => 'field_flex_intro_narrative', 'label' => 'Narrative', 'name' => 'narrative', 'type' => 'wysiwyg', 'tabs' => 'visual', 'media_upload' => 0, 'toolbar' => 'basic' ),
						array( 'key' => 'field_flex_intro_photo', 'label' => 'Photo', 'name' => 'photo', 'type' => 'image', 'return_format' => 'url' ),
					),
				),

				'layout_feature' => array(
					'key' => 'layout_feature', 'name' => 'feature_section', 'label' => 'Feature Section (photo + text + point list)', 'display' => 'block',
					'sub_fields' => array(
						array( 'key' => 'field_flex_feat_watermark', 'label' => 'Watermark Text', 'name' => 'watermark', 'type' => 'text' ),
						array( 'key' => 'field_flex_feat_eyebrow', 'label' => 'Eyebrow', 'name' => 'eyebrow', 'type' => 'text' ),
						array( 'key' => 'field_flex_feat_heading', 'label' => 'Heading', 'name' => 'heading', 'type' => 'text' ),
						array( 'key' => 'field_flex_feat_photo', 'label' => 'Photo', 'name' => 'photo', 'type' => 'image', 'return_format' => 'url' ),
						array( 'key' => 'field_flex_feat_badge', 'label' => 'Photo Badge Text', 'name' => 'badge', 'type' => 'text' ),
						array( 'key' => 'field_flex_feat_statement', 'label' => 'Statement', 'name' => 'statement', 'type' => 'text' ),
						array( 'key' => 'field_flex_feat_lead', 'label' => 'Lead Text', 'name' => 'lead', 'type' => 'textarea', 'rows' => 2 ),
						array( 'key' => 'field_flex_feat_reverse', 'label' => 'Photo on Right', 'name' => 'reverse_layout', 'type' => 'true_false', 'ui' => 1 ),
						array(
							'key' => 'field_flex_feat_points', 'label' => 'Points', 'name' => 'points', 'type' => 'repeater', 'button_label' => 'Add Point',
							'sub_fields' => array(
								array( 'key' => 'field_flex_point_title', 'label' => 'Title', 'name' => 'title', 'type' => 'text' ),
								array( 'key' => 'field_flex_point_desc', 'label' => 'Description', 'name' => 'desc', 'type' => 'textarea', 'rows' => 2 ),
							),
						),
					),
				),

				'layout_card_grid' => array(
					'key' => 'layout_card_grid', 'name' => 'card_grid', 'label' => 'Card Grid', 'display' => 'block',
					'sub_fields' => array(
						array( 'key' => 'field_flex_cards_eyebrow', 'label' => 'Eyebrow', 'name' => 'eyebrow', 'type' => 'text' ),
						array( 'key' => 'field_flex_cards_heading', 'label' => 'Heading', 'name' => 'heading', 'type' => 'text' ),
						array(
							'key' => 'field_flex_cards', 'label' => 'Cards', 'name' => 'cards', 'type' => 'repeater', 'button_label' => 'Add Card',
							'instructions' => 'Icon Key options: trade_ship, industry, default, transport_truck, feed, medical, bajaj, petroleum, agri, logistics, fleet (or the shared set: pie-chart, globe-alt, badge-star, people, shield-check, economic-growth, filing-cabinet, handshake, package, globe-thin, briefcase, clipboard).',
							'sub_fields' => array(
								array( 'key' => 'field_flex_card_number', 'label' => 'Number / Tag (optional)', 'name' => 'number', 'type' => 'text' ),
								array( 'key' => 'field_flex_card_title', 'label' => 'Title', 'name' => 'title', 'type' => 'text' ),
								array( 'key' => 'field_flex_card_text', 'label' => 'Text', 'name' => 'text', 'type' => 'textarea', 'rows' => 2 ),
							),
						),
					),
				),

				'layout_stats' => array(
					'key' => 'layout_stats', 'name' => 'stats_row', 'label' => 'Stats Row', 'display' => 'block',
					'sub_fields' => array(
						array(
							'key' => 'field_flex_stats', 'label' => 'Stats', 'name' => 'stats', 'type' => 'repeater', 'button_label' => 'Add Stat',
							'sub_fields' => array(
								array( 'key' => 'field_flex_stat_number', 'label' => 'Number', 'name' => 'number', 'type' => 'text' ),
								array( 'key' => 'field_flex_stat_label', 'label' => 'Label', 'name' => 'label', 'type' => 'text' ),
							),
						),
					),
				),

				'layout_faq' => array(
					'key' => 'layout_faq', 'name' => 'faq_accordion', 'label' => 'FAQ Accordion', 'display' => 'block',
					'sub_fields' => array(
						array( 'key' => 'field_flex_faq_eyebrow', 'label' => 'Eyebrow', 'name' => 'eyebrow', 'type' => 'text' ),
						array( 'key' => 'field_flex_faq_heading', 'label' => 'Heading', 'name' => 'heading', 'type' => 'text' ),
						array(
							'key' => 'field_flex_faq_items', 'label' => 'Questions', 'name' => 'faq_items', 'type' => 'repeater', 'button_label' => 'Add Question',
							'sub_fields' => array(
								array( 'key' => 'field_flex_faq_q', 'label' => 'Question', 'name' => 'question', 'type' => 'text' ),
								array( 'key' => 'field_flex_faq_a', 'label' => 'Answer', 'name' => 'answer', 'type' => 'textarea', 'rows' => 3 ),
							),
						),
					),
				),

				'layout_cta' => array(
					'key' => 'layout_cta', 'name' => 'cta_band', 'label' => 'CTA Band', 'display' => 'block',
					'sub_fields' => array(
						array( 'key' => 'field_flex_cta_watermark', 'label' => 'Watermark Text', 'name' => 'watermark', 'type' => 'text' ),
						array( 'key' => 'field_flex_cta_bg', 'label' => 'Background Photo', 'name' => 'bg_image', 'type' => 'image', 'return_format' => 'url' ),
						array( 'key' => 'field_flex_cta_eyebrow', 'label' => 'Eyebrow', 'name' => 'eyebrow', 'type' => 'text' ),
						array( 'key' => 'field_flex_cta_heading', 'label' => 'Heading', 'name' => 'heading', 'type' => 'text' ),
						array( 'key' => 'field_flex_cta_text', 'label' => 'Text', 'name' => 'text', 'type' => 'textarea', 'rows' => 2 ),
						array( 'key' => 'field_flex_cta_btn_label', 'label' => 'Button Label', 'name' => 'btn_label', 'type' => 'text', 'default_value' => 'Contact Us' ),
						array( 'key' => 'field_flex_cta_btn_link', 'label' => 'Button Link', 'name' => 'btn_link', 'type' => 'text', 'default_value' => '/contact/' ),
					),
				),

				'layout_content' => array(
					'key' => 'layout_content', 'name' => 'rich_content', 'label' => 'Rich Text Content', 'display' => 'block',
					'sub_fields' => array(
						array( 'key' => 'field_flex_content_body', 'label' => 'Content', 'name' => 'body', 'type' => 'wysiwyg', 'tabs' => 'all', 'toolbar' => 'full' ),
					),
				),

			),
		),
	),
	'location' => array(
		array(
			array( 'param' => 'page_template', 'operator' => '==', 'value' => 'page-flexible.php' ),
			array( 'param' => 'page_type', 'operator' => '!=', 'value' => 'front_page' ),
		),
	),
	'menu_order' => 5,
) );
