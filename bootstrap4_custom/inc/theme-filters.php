<?php

/**
 * Theme Filters
 *
 * @package WordPress
 * @subpackage BOOTSTRAP 4 CUSTOM
 * @since BOOTSTRAP 4 CUSTOM 1.0
 */

// Add Filters
add_filter('body_class', 'add_slug_to_body_class'); // Add slug to body class (Starkers build)
add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args'); // Remove surrounding <div> from WP Navigation
add_filter('excerpt_more', 'view_more_article'); // Add 'View Article' button instead of [...] for Excerpts
add_filter( 'upload_mimes', 'custom_mtypes' ); // Allow svg upload