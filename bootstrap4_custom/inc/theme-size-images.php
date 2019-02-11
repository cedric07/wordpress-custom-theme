<?php

/**
 * Theme image sizes
 *
 * @package WordPress
 * @subpackage BOOTSTRAP 4 CUSTOM
 * @since BOOTSTRAP 4 CUSTOM 1.0
 */

if (function_exists('add_theme_support')) {
	add_theme_support('post-thumbnails');
	// add_image_size('custom-size', 700, 200, array('center','center'));
}
