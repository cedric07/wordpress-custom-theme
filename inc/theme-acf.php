<?php
/**
 * ACF theme options
 */
function my_acf_theme_options() {
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
			'page_title'  => __( 'General Settings', 'your_text_domain' ),
			'menu_title'  => __( 'General', 'your_text_domain' ),
			'parent_slug' => 'theme-general-settings',
			'menu_slug'   => 'general',
			'create_json' => true
		];
		$acf_options_pages[]  = [
			'page_title'  => __( 'Header Settings', 'your_text_domain' ),
			'menu_title'  => __( 'Header', 'your_text_domain' ),
			'parent_slug' => 'theme-general-settings',
			'menu_slug'   => 'header',
			'create_json' => true
		];
		$acf_options_pages[]  = [
			'page_title'  => __( 'Footer Settings', 'your_text_domain' ),
			'menu_title'  => __( 'Footer', 'your_text_domain' ),
			'parent_slug' => 'theme-general-settings',
			'menu_slug'   => 'footer',
			'create_json' => true
		];
		$acf_options_pages[]  = [
			'page_title'  => __( '404 page Settings', 'your_text_domain' ),
			'menu_title'  => __( '404 page', 'your_text_domain' ),
			'parent_slug' => 'theme-general-settings',
			'menu_slug'   => '404-page',
			'create_json' => true
		];

		foreach ( $acf_options_pages as $key => $acf_option ) {
			// creation de la page d'option
			acf_add_options_page( $acf_option );
			// création du groupe ACF et json correspondant
			if ( isset( $acf_option['create_json'] ) && $acf_option['create_json'] ) {

				$acf_json_group_name = 'group_theme_options_' . str_replace( '-', '_', $acf_option['menu_slug'] );

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
								"value": "' . $acf_option['menu_slug'] . '"
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
}

/**
 * @param $categories
 * @param $post
 *
 * @return array
 * ACF Create block categories in gutenberg
 */
function my_acf_block_categories( $categories ) {
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

/**
 * @param $block
 * ACF render gutenberg blocks
 */
function my_acf_block_render_callback( $block ) {
	// Example : convert name ("acf/testimonial") into path friendly slug ("testimonial")
	$slug = str_replace( 'acf/', '', $block['name'] );

	// include a template part from within the "parts/acf-blocks-gutenberg" folder
	if ( file_exists( get_template_directory() . "/parts/acf-blocks-gutenberg/{$slug}.php" ) ) {
		include( get_template_directory() . "/parts/acf-blocks-gutenberg/{$slug}.php" );
	}
}

/**
 * Register Gutenberg ACF blocks
 */
function my_acf_gutenberg_blocks() {
	// check function exists
	if ( function_exists( 'acf_register_block' ) ) {

		// register a test custom block
		acf_register_block( array(
			'name'            => 'block-test',
			'title'           => __( 'Test block', 'your_text_domain' ),
			'description'     => __( 'A custom test block Gutenberg.', 'your_text_domain' ),
			'render_callback' => 'my_acf_block_render_callback',
			'category'        => 'custom-cat',
			'icon'            => 'editor-ol',
			'keywords'        => array( 'test', 'block' ),
		) );
	}
}
