<?php

function my_acf_init() {

	// check function exists
	if ( function_exists( 'acf_register_block' ) ) {

		// register a test custom block
		acf_register_block( array(
			'name'            => 'block-test',
			'title'           => __( 'Bloc de test' ),
			'description'     => __( 'Bloc de test Gutenberg.' ),
			'render_callback' => 'my_acf_block_render_callback',
			'category'        => 'custom-cat',
			'icon'            => 'editor-ol',
			'keywords'        => array( 'test', 'bloc' ),
		) );
	}
}
