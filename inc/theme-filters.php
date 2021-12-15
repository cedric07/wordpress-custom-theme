<?php

// Add Filters
add_filter( 'use_block_editor_for_post_type', 'my_disable_gutenberg', 10, 2 ); // Disable Guntenberg for post types

// ACF
add_filter( 'block_categories_all', 'my_acf_block_categories', 10, 2 ); // ACF Create block categories
add_filter( 'allowed_block_types_all', 'my_acf_allowed_blocks', 10, 2 ); // ACF allowed blocks

// Auto update
add_filter( 'plugins_auto_update_enabled', '__return_false' ); // Disable auto update plugins
add_filter( 'themes_auto_update_enabled', '__return_false' ); // Disable auto update themes
add_filter( 'allow_major_auto_core_updates', '__return_false' ); // Disable auto update core major

// Yoast
add_filter( 'wpseo_primary_term_taxonomies', '__return_empty_array' ); // Disabling the Primary category feature
add_filter( 'wpseo_metabox_prio', 'move_yoast_below_acf' ); // Change Yoast SEO priority to 'low' to get ACF fields before Yoast metabox.
