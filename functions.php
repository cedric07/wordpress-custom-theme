<?php

// Folders
define( 'THEME_DIR', get_template_directory() );
define( 'THEME_INCLUDES', THEME_DIR . '/inc' );
define( 'THEME_ACF_JSON', THEME_DIR . '/acf-json' );

// Constants
define( 'IMG_PATH', get_template_directory_uri() . '/dist/img' );
define( 'IMG_ABS_PATH', get_template_directory() . '/dist/img' );

define( 'ICONS_PATH', get_template_directory_uri() . '/dist/img/icons' );
define( 'ICONS_ABS_PATH', get_template_directory() . '/dist/img/icons' );

define( 'FONT_PATH', get_template_directory_uri() . '/dist/fonts' );
define( 'FONT_ABS_PATH', get_template_directory() . '/dist/fonts' );

define( 'ACF_GUTENBERG_PATH', get_template_directory_uri() . '/parts/acf-blocks-gutenberg' );
define( 'ACF_GUTENBERG_ABS_PATH', get_template_directory() . '/parts/acf-blocks-gutenberg' );

define( 'ACF_GUTENBERG_PREVIEW_PATH', get_template_directory_uri() . '/dist/img/acf-blocks-gutenberg-preview' );
define( 'ACF_GUTENBERG_PREVIEW_ABS_PATH', get_template_directory() . '/dist/img/acf-blocks-gutenberg-preview' );

define( 'POST_TYPE_TEST', 'test_post_type' );

define( 'TAXO_TEST', 'test_taxonomy' );

// Includes
require THEME_INCLUDES . '/theme-actions.php';
require THEME_INCLUDES . '/theme-sub-actions.php';

require THEME_INCLUDES . '/theme-filters.php';
require THEME_INCLUDES . '/theme-sub-filters.php';

require THEME_INCLUDES . '/theme-size-images.php';
require THEME_INCLUDES . '/theme-functions.php';

require THEME_INCLUDES . '/theme-post-types.php';
require THEME_INCLUDES . '/theme-taxonomies.php';

require THEME_INCLUDES . '/theme-acf.php';

// Emails
require_once( 'inc/classes/Mail.php' );
Mail::init();

