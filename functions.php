<?php

// Folders
define( 'THEME_DIR', get_template_directory() );
define( 'THEME_INCLUDES', THEME_DIR . '/inc' );
define( 'THEME_ACF_JSON', THEME_DIR . '/acf-json' );

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
require_once('inc/classes/Mail.php');
Mail::init();

// Constants
define( 'IMG_PATH', get_template_directory_uri() . '/dist/img' );

