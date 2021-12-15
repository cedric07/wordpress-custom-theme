<?php

/**
 * Custom View Article link to Post
 *
 * @param $more
 *
 * @return string
 */
function view_more_article( $more ) {
	global $post;

	return '... <a class="view-article" href="' . get_permalink( $post->ID ) . '">' . __( 'View Article', 'your_text_domain' ) . '</a>';
}

/**
 * Change Yoast SEO priority to 'low' to get ACF fields before Yoast metabox.
 * @return string
 */
function move_yoast_below_acf() {
	return 'low';
}
