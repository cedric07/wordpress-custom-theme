<?php

/**
 * CSS
 */
function front_css() {
	if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {

		if (defined('WP_DEBUG') && true === WP_DEBUG) {
			$vendor_file = '/dist/css/vendors.css';
			$custom_file = '/dist/css/custom.css';
		} else {
			$vendor_file = '/dist/css/vendors.min.css';
			$custom_file = '/dist/css/custom.min.css';
		}

		wp_enqueue_style('vendors', get_stylesheet_directory_uri() . $vendor_file, [], filemtime(get_stylesheet_directory() . $vendor_file), 'all');
		wp_enqueue_style('main', get_stylesheet_directory_uri() . $custom_file, [], filemtime(get_stylesheet_directory() . $custom_file), 'all');
	}
}

/**
 * JS
 */
function front_js() {
	if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {

		if (defined('WP_DEBUG') && true === WP_DEBUG) {
			$vendor_file = '/dist/js/vendors.js';
			$custom_file = '/dist/js/custom.js';
		} else {
			$vendor_file = '/dist/js/vendors.min.js';
			$custom_file = '/dist/js/custom.min.js';
		}

		wp_register_script('vendors', get_stylesheet_directory_uri() . $vendor_file, [], filemtime(get_stylesheet_directory() . $vendor_file), TRUE);
		wp_enqueue_script('app', get_stylesheet_directory_uri() . $custom_file, ['vendors'], filemtime(get_stylesheet_directory() . $custom_file), TRUE);
	}
}

/**
 * Register Navigation
 */
function register_menu() {
	register_nav_menus([ // Using array to specify more menus if needed
		'header-menu' => __('Header Menu', 'bootstrap4_custom'), // Main Navigation
	]);
}

/**
 * Register Sidebar
 */
if ( function_exists( 'register_sidebar' ) ) {
	// Define Sidebar Widget Area 1
	register_sidebar( array(
		'name'          => esc_html( 'Widget Area 1', 'bootstrap4_custom' ),
		'description'   => esc_html( 'Description for this widget-area...', 'bootstrap4_custom' ),
		'id'            => 'widget-area-1',
		'before_widget' => '<div id="%1$s" class="%2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>',
	) );
	// Define Sidebar Widget Area 2
	register_sidebar( array(
		'name'          => esc_html( 'Widget Area 2', 'bootstrap4_custom' ),
		'description'   => esc_html( 'Description for this widget-area...', 'bootstrap4_custom' ),
		'id'            => 'widget-area-2',
		'before_widget' => '<div id="%1$s" class="%2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>',
	) );
}

/**
 * Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous
 * Links, No plugin
 */
function pagination() {
	global $wp_query;
	$big = 999999999;
	echo paginate_links([
		'base'    => str_replace($big, '%#%', get_pagenum_link($big)),
		'format'  => '?paged=%#%',
		'current' => max(1, get_query_var('paged')),
		'total'   => $wp_query->max_num_pages,
        'type'      => 'list',
        'prev_text' => 'prev',
        'next_text' => 'next',
	]);
}

/**
 * Theme setup
 */
function my_theme_setup() {
	// Nouveauté à ajouter
	add_theme_support('editor-styles');
	// Puis la même fonction qu'on utilisait auparavant pour Tiny MCE
	add_editor_style('style-editor.css');
	// ACTIVER LA FEUILLE DE STYLES PAR DÉFAUT DES BLOCS GUTENBERG
	add_theme_support( 'wp-block-styles' );
}
