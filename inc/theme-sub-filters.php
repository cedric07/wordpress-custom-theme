<?php

/**
 * Disable Guntenberg
 *
 * @param $current_status
 * @param $post_type
 *
 * @return false|mixed
 */
function my_disable_gutenberg( $current_status, $post_type ) {

	// Disabled post types
	$disabled_post_types = array( 'yourPostTypeHere' );

	if ( in_array( $post_type, $disabled_post_types, true ) ) {
		$current_status = false;
	}

	return $current_status;
}

/**
 * Change Yoast SEO priority to 'low' to get ACF fields before Yoast metabox.
 * @return string
 */
function move_yoast_below_acf() {
	return 'low';
}
