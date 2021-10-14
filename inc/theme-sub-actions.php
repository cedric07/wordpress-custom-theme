<?php

/**
 * CSS
 */
function front_css() {
	if ( $GLOBALS['pagenow'] != 'wp-login.php' && ! is_admin() ) {

		if ( defined( 'WP_DEBUG' ) && true === WP_DEBUG ) {
			$vendor_file = '/dist/css/vendors.css';
			$custom_file = '/dist/css/custom.css';
		} else {
			$vendor_file = '/dist/css/vendors.min.css';
			$custom_file = '/dist/css/custom.min.css';
		}

		if ( file_exists( get_template_directory() . $vendor_file ) ) {
			wp_enqueue_style( 'vendors', get_stylesheet_directory_uri() . $vendor_file, [], filemtime( get_stylesheet_directory() . $vendor_file ), 'all' );
		}
		if ( file_exists( get_template_directory() . $custom_file ) ) {
			wp_enqueue_style( 'custom', get_stylesheet_directory_uri() . $custom_file, [], filemtime( get_stylesheet_directory() . $custom_file ), 'all' );
		}
	}
}

/**
 * JS
 */
function front_js() {
	if ( $GLOBALS['pagenow'] != 'wp-login.php' && ! is_admin() ) {

		if ( defined( 'WP_DEBUG' ) && true === WP_DEBUG ) {
			$vendor_file = '/dist/js/vendors.js';
			$custom_file = '/dist/js/custom.js';
		} else {
			$vendor_file = '/dist/js/vendors.min.js';
			$custom_file = '/dist/js/custom.min.js';
		}

		if ( file_exists( get_template_directory() . $vendor_file ) ) {
			wp_register_script( 'vendors', get_stylesheet_directory_uri() . $vendor_file, [], filemtime( get_stylesheet_directory() . $vendor_file ), true );
		}

		if ( file_exists( get_template_directory() . $custom_file ) ) {
			wp_enqueue_script( 'custom', get_stylesheet_directory_uri() . $custom_file, [
				'jquery',
				'vendors'
			], filemtime( get_stylesheet_directory() . $custom_file ), true );

			// Pass PHP Data to JavaScript
			$dataToBePassed = array(
				'myVar' => 'My value',
			);

			wp_localize_script( 'custom', 'php_vars', $dataToBePassed );
		}
	}
}

/**
 * Register Menus
 */
function my_menus() {
	if ( function_exists( 'register_nav_menus' ) ) {
		register_nav_menus( [ // Using array to specify more menus if needed
			'header-menu' => __( 'Header Menu', 'your_text_domain' ), // Main Navigation
		] );
	}
}

/**
 * Register Sidebars
 */
function my_sidebars() {
	if ( function_exists( 'register_sidebar' ) ) {
		// Define Sidebar Widget Area 1
		register_sidebar( array(
			'name'          => __( 'Widget Area 1', 'your_text_domain' ),
			'description'   => __( 'Description for this widget-area...', 'your_text_domain' ),
			'id'            => 'widget-area-1',
			'before_widget' => '<div id="%1$s" class="%2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>',
		) );
	}
}

/**
 * Editor style
 */
function editor_style() {
	if ( function_exists( 'add_theme_support' ) ) {
		add_theme_support( 'editor-styles' );

		if ( defined( 'WP_DEBUG' ) && true === WP_DEBUG ) {
			add_editor_style( '/dist/css/style-editor.css' );
		} else {
			add_editor_style( '/dist/css/style-editor.min.css' );
		}

		// Default stylesheet for gutenberg blocks
		add_theme_support( 'wp-block-styles' );
	}
}

/**
 * Theme language
 */
function language_setup() {
	load_theme_textdomain( 'your_text_domain', get_template_directory() . '/languages' );
}

/**
 * Remove Editor menu on Appearance >> Editor
 */
function remove_editor_menu() {
	remove_action( 'admin_menu', '_add_themes_utility_last', 101 );
}
