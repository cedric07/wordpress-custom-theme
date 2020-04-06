<?php

// Add Filters
add_filter( 'excerpt_more', 'view_more_article' ); // Add 'View Article' button instead of [...] for Excerpts
add_filter( 'block_categories', 'my_acf_block_categories', 10, 2 ); // ACF Create block categories
