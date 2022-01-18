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
 * ACF color palette
 *
 * @return void
 */
function acf_color_palette() { ?>
	<script type="text/javascript">
		(function ($) {
			acf.add_filter('color_picker_args', function (args, $field) {
				// add the hexadecimal codes here for the colors you want to appear as swatches
				args.palettes = ['#2196F3', '#FF4081', '#FF4A4A', '#2EE085', '#777777', '#ffffff', '#000000']
				// return colors
				return args;
			});
		})(jQuery);
	</script>
<?php }

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
	$file = ACF_GUTENBERG_ABS_PATH . "/" . $slug . ".php";

	// include a template part from within the "parts/acf-blocks-gutenberg" folder
	if ( file_exists( $file ) ) {
		include( $file );
	}
}

/**
 * ACF Register block function
 *
 * @return void
 */
function my_acf_configure_gutenberg_blocks() {

	if ( function_exists( 'acf_register_block_type' ) ) {

		$blocks = my_acf_gutenberg_blocks();

		if ( is_array( $blocks ) ) {

			$formatsForPreview = array( 'gif', 'png', 'jpg' );

			foreach ( $blocks as $block ) {

				$previewImage = IMG_PATH . '/logo.svg';

				foreach ( $formatsForPreview as $format ) {
					$previewImagePath = ACF_GUTENBERG_PREVIEW_ABS_PATH . '/' . $block['name'] . '.' . $format;
					if ( file_exists( $previewImagePath ) ) {
						$previewImage = ACF_GUTENBERG_PREVIEW_PATH . '/' . $block['name'] . '.' . $format;
						break;
					}
				}

				acf_register_block_type( array(
						'name'            => $block['name'],
						'title'           => $block['title'],
						'description'     => ! empty( $block['description'] ) ? $block['description'] : '',
						'render_callback' => 'my_acf_block_render_callback',
						'category'        => ! empty( $block['category'] ) ? $block['category'] : 'datasolution',
						'icon'            => ! empty( $block['icon'] ) ? $block['icon'] : '<svg width="17" height="17" xmlns="http://www.w3.org/2000/svg"><path d="M15.889 4.144a8.074 8.074 0 0 0-3.053-3.045C11.55.37 10.091 0 8.5 0c-.206 0-.409.006-.597.018H7.66v8.73h1.664V1.633c.963.103 1.859.39 2.663.853a6.574 6.574 0 0 1 2.451 2.477c.594 1.05.896 2.238.896 3.535 0 1.298-.302 2.487-.896 3.537a6.557 6.557 0 0 1-2.451 2.476c-1.032.596-2.205.898-3.487.898-1.284 0-2.461-.303-3.5-.898a6.533 6.533 0 0 1-2.461-2.476c-.595-1.049-.897-2.238-.897-3.537 0-1.122.228-2.168.675-3.107l.171-.359H.679l-.062.154A8.849 8.849 0 0 0 0 8.499c0 1.589.374 3.047 1.111 4.334a8.132 8.132 0 0 0 3.051 3.054C5.447 16.626 6.907 17 8.5 17c1.592 0 3.051-.37 4.336-1.1a8.067 8.067 0 0 0 3.053-3.044C16.626 11.567 17 10.102 17 8.5c0-1.601-.374-3.067-1.111-4.355" fill="#FF7130" fill-rule="evenodd"/></svg>',
						'keywords'        => ! empty( $block['keywords'] ) ? $block['keywords'] : array( 'datasolution' ),
						'mode'            => ! empty( $block['mode'] ) ? $block['mode'] : 'preview',
						'supports'        => array(
								'align'  => false,
								'anchor' => true
						),
						'example'         => array(
								'attributes' => array(
										'mode' => 'preview',
										'data' => array(
												'preview_image' => $previewImage,
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
			'core/spacer',

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
 * Returns Gutenberg ACF blocks
 * @return array[]
 */
function my_acf_gutenberg_blocks() {
	return array(
			array(
					'name'        => 'block-test',
					'title'       => __( 'Test block', 'your_text_domain' ),
					'description' => __( 'A custom test block Gutenberg.', 'your_text_domain' ),
					'keywords'    => array( 'test', 'block' ),
			)
	);
}
