<?php

/**
 * CSS
 */
function front_css() {

	if ( defined( 'WP_DEBUG' ) && true === WP_DEBUG ) {
		$vendor_file = CSS_DIR . '/' . VENDORS_CSS_FILENAME . '.css';
		$custom_file = CSS_DIR . '/' . CUSTOM_CSS_FILENAME . '.css';
	} else {
		$vendor_file = CSS_DIR . '/' . VENDORS_CSS_FILENAME . '.min.css';
		$custom_file = CSS_DIR . '/' . CUSTOM_CSS_FILENAME . '.min.css';
	}

	if ( file_exists( get_template_directory() . $vendor_file ) ) {
		wp_enqueue_style( VENDORS_CSS_FILENAME, get_stylesheet_directory_uri() . $vendor_file, [], filemtime( get_stylesheet_directory() . $vendor_file ), 'all' );
	}

	if ( file_exists( get_template_directory() . $custom_file ) ) {
		wp_enqueue_style( CUSTOM_CSS_FILENAME, get_stylesheet_directory_uri() . $custom_file, [], filemtime( get_stylesheet_directory() . $custom_file ), 'all' );
	}
}

/**
 * Editor css
 */
function editor_css() {
	if ( function_exists( 'add_theme_support' ) ) {
		add_theme_support( 'editor-styles' );

		if ( defined( 'WP_DEBUG' ) && true === WP_DEBUG ) {
			$vendor_file = CSS_DIR . '/' . VENDORS_CSS_FILENAME . '.css';
			$editor_file = CSS_DIR . '/' . EDITOR_CSS_FILENAME . '.css';
		} else {
			$vendor_file = CSS_DIR . '/' . VENDORS_CSS_FILENAME . '.min.css';
			$editor_file = CSS_DIR . '/' . EDITOR_CSS_FILENAME . '.min.css';
		}

		if ( file_exists( get_template_directory() . $vendor_file ) ) {
			add_editor_style( $vendor_file );
		}

		if ( file_exists( get_template_directory() . $editor_file ) ) {
			add_editor_style( $editor_file );
		}

		// Default stylesheet for gutenberg blocks
		add_theme_support( 'wp-block-styles' );
	}
}

/**
 * Admin CSS
 */
function admin_css() {
	if ( defined( 'WP_DEBUG' ) && true === WP_DEBUG ) {
		$admin_file = CSS_DIR . '/'.ADMIN_CSS_FILENAME.'.css';
	} else {
		$admin_file = CSS_DIR . '/'.ADMIN_CSS_FILENAME.'.min.css';
	}

	if ( file_exists( get_template_directory() . $admin_file ) ) {
		wp_enqueue_style( ADMIN_CSS_FILENAME, get_stylesheet_directory_uri() . $admin_file, [], filemtime( get_stylesheet_directory() . $admin_file ), 'all' );
	}
}

/**
 * JS
 */
function front_js() {

	if ( defined( 'WP_DEBUG' ) && true === WP_DEBUG ) {
		$vendor_file = JS_DIR . '/'.VENDORS_JS_FILENAME.'.js';
		$custom_file = JS_DIR . '/'.CUSTOM_JS_FILENAME.'.js';
	} else {
		$vendor_file = JS_DIR . '/'.VENDORS_JS_FILENAME.'.min.js';
		$custom_file = JS_DIR . '/'.CUSTOM_JS_FILENAME.'.min.js';
	}

	if ( file_exists( get_template_directory() . $vendor_file ) ) {
		wp_register_script( VENDORS_JS_FILENAME, get_stylesheet_directory_uri() . $vendor_file, [], filemtime( get_stylesheet_directory() . $vendor_file ), true );
	}

	if ( file_exists( get_template_directory() . $custom_file ) ) {
		wp_enqueue_script( CUSTOM_JS_FILENAME, get_stylesheet_directory_uri() . $custom_file, [
			'jquery',
			VENDORS_JS_FILENAME
		], filemtime( get_stylesheet_directory() . $custom_file ), true );

		// Pass PHP Data to JavaScript
		$dataToBePassed = array(
			'myVar' => 'My value',
		);

		wp_localize_script( CUSTOM_JS_FILENAME, 'php_vars', $dataToBePassed );
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
