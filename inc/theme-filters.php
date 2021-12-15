<?php

// Add Filters
add_filter( 'excerpt_more', 'view_more_article' ); // Add 'View Article' button instead of [...] for Excerpts

// ACF
add_filter( 'block_categories_all', 'my_acf_block_categories', 10, 2 ); // ACF Create block categories
add_filter( 'allowed_block_types_all', 'my_acf_allowed_blocks', 10, 2 ); // ACF allowed blocks

// Auto update
add_filter( 'plugins_auto_update_enabled', '__return_false' ); // Disable auto update plugins
add_filter( 'themes_auto_update_enabled', '__return_false' ); // Disable auto update themes
add_filter( 'allow_major_auto_core_updates', '__return_false' ); // Disable auto update core major
