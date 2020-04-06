<?php
/**
 * ACFs.
 */
define( 'THEME_ACF_JSON', THEME_DIR . '/acf-json' );

if ( function_exists( 'acf_add_options_page' ) ) {

	if ( ! is_dir( THEME_ACF_JSON ) ) {
		mkdir( THEME_ACF_JSON );
	}

	$acf_options_pages    = array();
	$acf_options_pages[0] = array(
		'page_title' => __( 'Theme General Settings', 'your_text_domain' ),
		'menu_title' => __( 'Theme Settings', 'your_text_domain' ),
		'menu_slug'  => 'theme-general-settings',
		'capability' => 'edit_posts',
		'redirect'   => true,
	);
	$acf_options_pages[]  = [
		'page_title'          => __( 'General Settings', 'your_text_domain' ),
		'menu_title'          => __( 'General', 'your_text_domain' ),
		'parent_slug'         => 'theme-general-settings',
		'acf_json_group_name' => 'general'
	];
	$acf_options_pages[]  = [
		'page_title'          => __( 'Header Settings', 'your_text_domain' ),
		'menu_title'          => __( 'Header', 'your_text_domain' ),
		'parent_slug'         => 'theme-general-settings',
		'acf_json_group_name' => 'header'
	];
	$acf_options_pages[]  = [
		'page_title'          => __( 'Footer Settings', 'your_text_domain' ),
		'menu_title'          => __( 'Footer', 'your_text_domain' ),
		'parent_slug'         => 'theme-general-settings',
		'acf_json_group_name' => 'footer'
	];
	$acf_options_pages[]  = [
		'page_title'          => __( '404 page Settings', 'your_text_domain' ),
		'menu_title'          => __( '404 page', 'your_text_domain' ),
		'parent_slug'         => 'theme-general-settings',
		'acf_json_group_name' => '404_page'
	];

	foreach ( $acf_options_pages as $key => $acf_option ) {
		// creation de la page d'option
		acf_add_options_page( $acf_option );
		// création du groupe ACF et json correspondant
		if ( isset( $acf_option['acf_json_group_name'] ) && $acf_option['acf_json_group_name'] != '' ) {

			$acf_json_group_name = 'group_theme_options_' . $acf_option['acf_json_group_name'];

			if ( ! file_exists( THEME_ACF_JSON . '/' . $acf_json_group_name . '.json' ) ) {
				$json_data = '{
					"key": "' . $acf_json_group_name . '",
					"title": "Theme options - ' . $acf_option['menu_title'] . '",
					"fields": [],
					"location": [
						[
							{
								"param": "options_page",
								"operator": "==",
								"value": "acf-options-' . strtolower( str_replace( ' ', '-', $acf_option['menu_title'] ) ) . '"
							}
						]
					],
					"menu_order": 0,
					"position": "normal",
					"style": "default",
					"label_placement": "top",
					"instruction_placement": "label",
					"hide_on_screen": "",
					"active": 1,
					"description": "",
					"modified": ' . time() . '
				}';

				$fp = fopen( THEME_ACF_JSON . '/' . $acf_json_group_name . '.json', 'w' );
				fwrite( $fp, $json_data );
				fclose( $fp );
			}
		}
	}
}

/**
 * @param $block
 * ACF render blocks
 */
function my_acf_block_render_callback( $block ) {
	// Example : convert name ("acf/testimonial") into path friendly slug ("testimonial")
	$slug = str_replace( 'acf/', '', $block['name'] );

	// include a template part from within the "template-parts/block" folder
	if ( file_exists( get_template_directory() . "/templates/blocks-gutenberg/{$slug}.php" ) ) {
		include( get_template_directory() . "/templates/blocks-gutenberg/{$slug}.php" );
	}
}

/**
 * @param $categories
 * @param $post
 *
 * @return array
 * ACF Create block categories
 */
function my_acf_block_categories( $categories, $post ) {
	if ( $post->post_type !== 'post' ) {
		return $categories;
	}

	return array_merge(
		$categories,
		array(
			array(
				'slug'  => 'custom-cat',
				'title' => __( 'Custom blocks', 'your_text_domain' )
			),
		)
	);
}
