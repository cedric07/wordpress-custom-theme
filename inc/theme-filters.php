<?php

// Add Filters
add_filter( 'excerpt_more', 'view_more_article' ); // Add 'View Article' button instead of [...] for Excerpts

// ACF
add_filter( 'block_categories_all', 'my_acf_block_categories', 10, 2 ); // ACF Create block categories
add_filter( 'allowed_block_types_all', 'my_acf_allowed_blocks', 10, 2 ); // ACF allowed blocks
