<?php

/**
 * Remove the <div> surrounding the dynamic navigation to cleanup markup
 *
 * @param string $args
 *
 * @return string
 */
function my_wp_nav_menu_args($args = '') {
	$args['container'] = FALSE;
	return $args;
}

/**
 * Add page slug to body class, love this - Credit: Starkers Wordpress Theme
 *
 * @param $classes
 *
 * @return array
 */
function add_slug_to_body_class($classes) {
	global $post;
	if (is_home()) {
		$key = array_search('blog', $classes);
		if ($key > -1) {
			unset($classes[$key]);
		}
	}
	elseif (is_page()) {
		$classes[] = sanitize_html_class($post->post_name);
	}
	elseif (is_singular()) {
		$classes[] = sanitize_html_class($post->post_name);
	}

	return $classes;
}

/**
 * Custom View Article link to Post
 *
 * @param $more
 *
 * @return string
 */
function view_more_article($more) {
	global $post;
	return '... <a class="view-article" href="' . get_permalink($post->ID) . '">' . __('View Article', 'bootstrap4_custom') . '</a>';
}

/**
 * Allow svg upload
 *
 * @param $m
 *
 * @return mixed
 */
function custom_mtypes( $m ) {
    $m['svg']  = 'image/svg+xml';
    $m['svgz'] = 'image/svg+xml';

    return $m;
}
