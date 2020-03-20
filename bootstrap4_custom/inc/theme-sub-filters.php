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

	return '... <a class="view-article" href="' . get_permalink( $post->ID ) . '">' . __( 'View Article', 'bootstrap4_custom' ) . '</a>';
}
