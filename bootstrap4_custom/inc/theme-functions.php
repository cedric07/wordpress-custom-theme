<?php

/**
 * Navigation
 */
function menu_nav() {
	wp_nav_menu(
		[
			'theme_location'  => 'header-menu',
			'menu'            => '',
			'container'       => false,
			'container_class' => false,
			'container_id'    => false,
			'menu_class'      => '',
			'menu_id'         => false,
			'echo'            => true,
			'fallback_cb'     => 'wp_page_menu',
			'depth'           => 2,
		]
	);
}

/**
 * ACF Options page.
 */
if ( function_exists( 'acf_add_options_page' ) ) {
	acf_add_options_page( [
		'page_title' => 'Theme General Settings',
		'menu_title' => 'Theme Settings',
		'menu_slug'  => 'theme-general-settings',
		'capability' => 'edit_posts',
		'redirect'   => true,
	] );

	acf_add_options_sub_page( [
		'page_title'  => 'Header Settings',
		'menu_title'  => 'Header',
		'parent_slug' => 'theme-general-settings',
	] );

	acf_add_options_sub_page( [
		'page_title'  => 'Footer Settings',
		'menu_title'  => 'Footer',
		'parent_slug' => 'theme-general-settings',
	] );

	acf_add_options_sub_page( [
		'page_title'  => '404 page Settings',
		'menu_title'  => '404 page',
		'parent_slug' => 'theme-general-settings',
	] );

	acf_add_options_sub_page( [
		'page_title'  => 'General Settings',
		'menu_title'  => 'General',
		'parent_slug' => 'theme-general-settings',
	] );
}

/**
 * Get/Truncate post title
 *
 * @param $limit
 *
 * @return string
 */
function customTitle( $limit = null ) {
	$title = get_the_title();
	if ( ! empty( $title ) && ! empty( $limit ) ) {
		$title = stringTrunc( $title, $limit, '...' );
	}

	return $title;
}

/**
 * Get/Truncate post excerpt
 *
 * @param $limit
 *
 * @return string
 */
function customExcerpt( $limit = null ) {
	$excerpt = get_the_excerpt();
	if ( ! empty( $excerpt ) && ! empty( $limit ) ) {
		$excerpt = stringTrunc( $excerpt, $limit, '...' );
	}

	return $excerpt;
}

/**
 * Truncate string (number of characters)
 *
 * @param $string
 * @param $limit
 * @param $end
 *
 * @return string
 */
function stringTrunc( $string, $limit, $end ) {
	return ( strlen( $string ) > $limit ) ? substr( $string, 0, $limit ) . $end : $string;
}

/**
 * @param $block
 * ACF render blocks
 */
function my_acf_block_render_callback( $block ) {
	// Example : convert name ("acf/testimonial") into path friendly slug ("testimonial")
	$slug = str_replace( 'acf/', '', $block['name'] );

	// include a template part from within the "template-parts/block" folder
	if ( file_exists( get_template_directory() . "/templates/block/content-{$slug}.php" ) ) {
		include( get_template_directory() . "/templates/block/content-{$slug}.php" );
	}
}
