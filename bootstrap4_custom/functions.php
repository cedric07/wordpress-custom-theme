<?php

// Folders
define('THEME_DIR', get_template_directory());
define('THEME_JS', THEME_DIR . '/js');
define('THEME_CSS', THEME_DIR . '/css');
define('THEME_IMAGES', THEME_DIR . '/img');
define('THEME_INCLUDES', THEME_DIR . '/inc');
define('THEME_TEMPLATES', THEME_DIR . '/templates');

// Includes
require THEME_INCLUDES . '/theme-actions.php';
require THEME_INCLUDES . '/theme-sub-actions.php';

require THEME_INCLUDES . '/theme-filters.php';
require THEME_INCLUDES . '/theme-sub-filters.php';

require THEME_INCLUDES . '/theme-size-images.php';
require THEME_INCLUDES . '/theme-functions.php';
