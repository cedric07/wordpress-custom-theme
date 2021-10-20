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
 * ACF render gutenberg blocks
 *
 * @param $block
 * @param string $content
 * @param false $is_preview
 * @param int $post_id
 */
function my_acf_block_render_callback( $block, $content = '', $is_preview = false, $post_id = 0 ) {
	// Example : convert name ("acf/testimonial") into path friendly slug ("testimonial")
	$slug = str_replace( 'acf/', '', $block['name'] );
	$file = ACF_GUTENBERG_PATH . "/" . $slug . ".php";

	// include a template part from within the "parts/acf-blocks-gutenberg" folder
	if ( file_exists( $file ) ) {
		include( $file );
	}
}

/**
 * ACF Register block function
 *
 * @param $datas
 */
function my_acf_configure_gutenberg_blocks( $datas ) {

	if ( function_exists( 'acf_register_block_type' ) ) {
		if ( is_array( $datas ) ) {
			foreach ( $datas as $data ) {
				acf_register_block_type( array(
					'name'            => $data['name'],
					'title'           => $data['title'],
					'description'     => ! empty( $data['description'] ) ? $data['description'] : '',
					'render_callback' => 'my_acf_block_render_callback',
					'category'        => ! empty( $data['category'] ) ? $data['category'] : 'custom-cat',
					'icon'            => ! empty( $data['icon'] ) ? $data['icon'] : 'wordpress',
					'keywords'        => ! empty( $data['keywords'] ) ? $data['keywords'] : array( 'custom' ),
					'mode'            => ! empty( $data['mode'] ) ? $data['mode'] : 'preview',
					'supports'        => array(
						'align'  => false,
						'anchor' => true
					),
					'example'         => array(
						'attributes' => array(
							'mode' => 'preview',
							'data' => array(
								'preview_image' => ACF_GUTENBERG_PREVIEW_PATH . '/' . $data['name'] . '.jpg',
							)
						)
					)
				) );
			}
		}
	}
}

/**
 * Set allowed Blocks
 *
 * @param $allowed_blocks
 *
 * @return string[]
 */
function my_acf_allowed_blocks( $allowed_blocks ) {
	$allowed_blocks = array(
		// Common blocks
		//'core/paragraph',
		//'core/image',
		//'core/heading',
		//'core/gallery',
		//'core/list',
		//'core/quote',
		//'core/audio',
		//'core/cover',
		//'core/file',
		//'core/video',

		// Formatting blocks
		//'core/table',
		//'core/verse',
		//'core/code',
		//'core/freeform',
		//'core/html',
		//'core/preformatted',
		//'core/pullquote',

		// Layout elements blocks
		//'core/buttons',
		//'core/text-columns',
		//'core/media-text',
		//'core/more',
		//'core/nextpage',
		//'core/separator',
		//'core/spacer',

		// Widget blocks
		//'core/shortcode',
		//'core/archives',
		//'core/categories',
		//'core/latest-comments',
		//'core/latest-posts',
		//'core/calendar',
		//'core/rss',
		//'core/search',
		//'core/tag-cloud',

		// Embed
		//'core/embed',
		//'core-embed/twitter',
		//'core-embed/youtube',
		//'core-embed/facebook',
		//'core-embed/instagram',
		//'core-embed/wordpress',
		//'core-embed/soundcloud',
		//'core-embed/spotify',
		//'core-embed/flickr',
		//'core-embed/vimeo',
		//'core-embed/animoto',
		//'core-embed/cloudup',
		//'core-embed/collegehumor',
		//'core-embed/dailymotion',
		//'core-embed/funnyordie',
		//'core-embed/hulu',
		//'core-embed/imgur',
		//'core-embed/issuu',
		//'core-embed/kickstarter',
		//'core-embed/meetup-com',
		//'core-embed/mixcloud',
		//'core-embed/photobucket',
		//'core-embed/polldaddy',
		//'core-embed/reddit',
		//'core-embed/reverbnation',
		//'core-embed/screencast',
		//'core-embed/scribd',
		//'core-embed/slideshare',
		//'core-embed/smugmug',
		//'core-embed/speaker',
		//'core-embed/ted',
		//'core-embed/tumblr',
		//'core-embed/videopress',
		//'core-embed/wordpress-tv',

		// My ACF custom blocks
		'acf/block-test',
	);

	return $allowed_blocks;
}

/**
 * Register Gutenberg ACF blocks
 */
my_acf_configure_gutenberg_blocks(
	array(
		array(
			'name'        => 'block-test',
			'title'       => __( 'Test block', 'your_text_domain' ),
			'description' => __( 'A custom test block Gutenberg.', 'your_text_domain' ),
			'keywords'    => array( 'test', 'block' ),
		)
	)
);
