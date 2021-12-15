<?php

// Front assets
add_action( 'wp_enqueue_scripts', 'front_css' );
add_action( 'wp_enqueue_scripts', 'front_js' );

// Admin assets
add_action('admin_print_styles', 'admin_css', 11);
add_action( 'enqueue_block_editor_assets', 'front_js' ); // Load js in gutenberg

// Global actions
add_action( 'after_setup_theme', 'editor_style' ); // Editor style
add_action( 'after_setup_theme', 'language_setup' ); // Theme language
add_action( 'after_setup_theme', 'my_menus' ); // Register Menus
add_action( 'widgets_init', 'my_sidebars' ); // Register Sidebars
add_action('_admin_menu', 'remove_editor_menu', 1); // Remove Editor menu on Appearance >> Editor

// ACF
add_action( 'acf/init', 'my_acf_theme_options' ); // ACF Theme Options
add_action( 'acf/init', 'my_acf_configure_gutenberg_blocks' ); // ACF Blocks Gutenberg

// Post types
add_action( 'init', 'custom_post_type', 0 );

// Taxonomies
add_action( 'init', 'custom_taxonomy', 0 );

// Remove Actions
remove_action( 'wp_head', 'feed_links_extra', 3 ); // Display the links to the extra feeds such as category feeds
remove_action( 'wp_head', 'feed_links', 2 ); // Display the links to the general feeds: Post and Comment Feed
remove_action( 'wp_head', 'rsd_link' ); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action( 'wp_head', 'wlwmanifest_link' ); // Display the link to the Windows Live Writer manifest file.
remove_action( 'wp_head', 'index_rel_link' ); // Index link
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); // Prev link
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 ); // Start link
remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 ); // Display relational links for the posts adjacent to the current post.
remove_action( 'wp_head', 'wp_generator' ); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
remove_action( 'wp_head', 'rel_canonical' );
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
