<?php

// Folders
define( 'THEME_DIR', get_template_directory() );
define( 'THEME_INCLUDES', THEME_DIR . '/inc' );
define( 'THEME_ACF_JSON', THEME_DIR . '/acf-json' );

// Constants
define( 'IMG_DIR', '/dist/img' );
define( 'IMG_PATH', get_template_directory_uri() . IMG_DIR );
define( 'IMG_ABS_PATH', get_template_directory() . IMG_DIR );

define( 'ICONS_DIR', '/dist/img/icons' );
define( 'ICONS_PATH', get_template_directory_uri() . ICONS_DIR );
define( 'ICONS_ABS_PATH', get_template_directory() . ICONS_DIR );

define( 'FONT_DIR', '/dist/fonts' );
define( 'FONT_PATH', get_template_directory_uri() . FONT_DIR );
define( 'FONT_ABS_PATH', get_template_directory() . FONT_DIR );

define( 'CSS_DIR', '/dist/css' );
define( 'CSS_PATH', get_template_directory_uri() . CSS_DIR );
define( 'CSS_ABS_PATH', get_template_directory() . CSS_DIR );

define( 'JS_DIR', '/dist/js' );
define( 'JS_PATH', get_template_directory_uri() . JS_DIR );
define( 'JS_ABS_PATH', get_template_directory() . JS_DIR );

define( 'ACF_GUTENBERG_DIR', '/parts/acf-blocks-gutenberg' );
define( 'ACF_GUTENBERG_PATH', get_template_directory_uri() . ACF_GUTENBERG_DIR );
define( 'ACF_GUTENBERG_ABS_PATH', get_template_directory() . ACF_GUTENBERG_DIR );

define( 'ACF_GUTENBERG_PREVIEW_DIR', IMG_DIR . '/acf-blocks-gutenberg-preview' );
define( 'ACF_GUTENBERG_PREVIEW_PATH', get_template_directory_uri() . ACF_GUTENBERG_PREVIEW_DIR );
define( 'ACF_GUTENBERG_PREVIEW_ABS_PATH', get_template_directory() . ACF_GUTENBERG_PREVIEW_DIR );

define( 'VENDORS_CSS_FILENAME', 'vendors' );
define( 'CUSTOM_CSS_FILENAME', 'custom' );
define( 'EDITOR_CSS_FILENAME', 'style-editor' );
define( 'ADMIN_CSS_FILENAME', 'admin' );

define( 'VENDORS_JS_FILENAME', 'vendors' );
define( 'CUSTOM_JS_FILENAME', 'custom' );

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

