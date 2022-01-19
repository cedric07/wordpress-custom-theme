<?php

/**
 * Navigation
 */
function header_nav() {
	wp_nav_menu(
		[
			'theme_location'  => 'header-menu',
			'menu'            => '',
			'container'       => false,
			'container_class' => false,
			'container_id'    => false,
			'menu_class'      => 'header--menu',
			'menu_id'         => false,
			'echo'            => true,
			'fallback_cb'     => 'wp_page_menu',
			'before'          => '',
			'after'           => '',
			'link_before'     => '',
			'link_after'      => '',
			'depth'           => 0,
		]
	);
}

/**
 * Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous
 * Links, No plugin
 */
function pagination( $query = null ) {
	global $wp_query;
	global $paged;
	if ( empty( $paged ) ) {
		$paged = 1;
	}
	$big = 999999999;

	echo paginate_links( [
		'base'      => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
		'format'    => '?paged=%#%',
		'current'   => max( 1, $paged ),
		'total'     => empty( $query ) ? $wp_query->max_num_pages : $query->max_num_pages,
		'type'      => 'list',
		'prev_text' => 'prev',
		'next_text' => 'next',
	] );
}


/**
 * Get/Truncate post title
 *
 * @param $limit
 *
 * @return string
 */
function customTitle( $limit = 50 ) {
	$title = get_the_title();
	if ( ! empty( $title ) ) {
		$title = truncate( $title, $limit );
	}

	return $title;
}

/**
 * Get/Truncate post excerpt
 *
 * @param $limit
 *
 * @return string
 */
function customExcerpt( $limit = 100 ) {
	$excerpt = get_the_excerpt();
	if ( ! empty( $excerpt ) ) {
		$excerpt = truncate( $excerpt, $limit );
	}

	return $excerpt;
}

/**
 * truncate : cuts a string to the length of $length and replaces the last
 *            characters with the ending if the text is longer than length.
 *
 * @param string $text : string to truncate
 * @param int $length : length of returned string, including ellipsis
 * @param array $options : an array of html attributes and options :
 *     'ending' will be used as Ending and appended to the trimmed string
 *     'exact' if false, $text will not be cut mid-word
 *     'html' if true, HTML tags would be handled correctly
 *
 * @access public
 * @return string : trimmed string
 */
function truncate( $text, $length = 100, $options = array() ) {
	$default = array(
		'ending' => '...',
		'exact'  => true,
		'html'   => false
	);
	$options = array_merge( $default, $options );
	extract( $options );
	if ( $html ) {
		if ( mb_strlen( preg_replace( '/<.*?>/', '', $text ) ) <= $length ) {
			return $text;
		}
		$totalLength = mb_strlen( strip_tags( $ending ) );
		$openTags    = array();
		$truncate    = '';
		preg_match_all( '/(<\/?([\w+]+)[^>]*>)?([^<>]*)/', $text, $tags, PREG_SET_ORDER );
		foreach ( $tags as $tag ) {
			if ( ! preg_match( '/img|br|input|hr|area|base|basefont|col|frame|isindex|link|meta|param/s', $tag[2] ) ) {
				if ( preg_match( '/<[\w]+[^>]*>/s', $tag[0] ) ) {
					array_unshift( $openTags, $tag[2] );
				} else if ( preg_match( '/<\/([\w]+)[^>]*>/s', $tag[0], $closeTag ) ) {
					$pos = array_search( $closeTag[1], $openTags );
					if ( $pos !== false ) {
						array_splice( $openTags, $pos, 1 );
					}
				}
			}
			$truncate      .= $tag[1];
			$contentLength = mb_strlen( preg_replace( '/&[0-9a-z]{2,8};|&#[0-9]{1,7};|&#x[0-9a-f]{1,6};/i', ' ', $tag[3] ) );
			if ( $contentLength + $totalLength > $length ) {
				$left           = $length - $totalLength;
				$entitiesLength = 0;
				if ( preg_match_all( '/&[0-9a-z]{2,8};|&#[0-9]{1,7};|&#x[0-9a-f]{1,6};/i', $tag[3], $entities, PREG_OFFSET_CAPTURE ) ) {
					foreach ( $entities[0] as $entity ) {
						if ( $entity[1] + 1 - $entitiesLength <= $left ) {
							$left --;
							$entitiesLength += mb_strlen( $entity[0] );
						} else {
							break;
						}
					}
				}
				$truncate .= mb_substr( $tag[3], 0, $left + $entitiesLength );
				break;
			} else {
				$truncate    .= $tag[3];
				$totalLength += $contentLength;
			}
			if ( $totalLength >= $length ) {
				break;
			}
		}
	} else {
		if ( mb_strlen( $text ) <= $length ) {
			return $text;
		} else {
			$truncate = mb_substr( $text, 0, $length - mb_strlen( $ending ) );
		}
	}
	if ( ! $exact ) {
		$spacepos = mb_strrpos( $truncate, ' ' );
		if ( isset( $spacepos ) ) {
			if ( $html ) {
				$bits = mb_substr( $truncate, $spacepos );
				preg_match_all( '/<\/([a-z]+)>/', $bits, $droppedTags, PREG_SET_ORDER );
				if ( ! empty( $droppedTags ) ) {
					foreach ( $droppedTags as $closingTag ) {
						if ( ! in_array( $closingTag[1], $openTags ) ) {
							array_unshift( $openTags, $closingTag[1] );
						}
					}
				}
			}
			$truncate = mb_substr( $truncate, 0, $spacepos );
		}
	}
	$truncate .= $ending;
	if ( $html ) {
		foreach ( $openTags as $tag ) {
			$truncate .= '</' . $tag . '>';
		}
	}

	return $truncate;
}

// -----------------------------------------
// Ajoute/Modifie un parametre à un URL.
// -----------------------------------------
function ajouterParametreGET( $url, $paramNom, $paramValeur ) {
	$urlFinal = "";
	if ( $paramNom == "" ) {
		$urlFinal = $url;
	} else {
		$t_url = explode( "?", $url );
		if ( count( $t_url ) == 1 ) {
			// pas de queryString
			$urlFinal .= $url;
			if ( substr( $url, strlen( $url ) - 1, strlen( $url ) ) != "/" ) {
				$t_url2 = explode( "/", $url );
				if ( preg_match( "/./", $t_url2[ count( $t_url2 ) - 1 ] ) == false ) {
					$urlFinal .= "/";
				}
			}
			$urlFinal .= "?" . $paramNom . "=" . $paramValeur;
		} else if ( count( $t_url ) == 2 ) {
			// il y a une queryString
			$paramAAjouterPresentDansQueryString = "non";
			$t_queryString                       = explode( "&", $t_url[1] );
			foreach ( $t_queryString as $cle => $coupleNomValeur ) {
				$t_param = explode( "=", $coupleNomValeur );
				if ( $t_param[0] == $paramNom ) {
					$paramAAjouterPresentDansQueryString = "oui";
				}
			}
			if ( $paramAAjouterPresentDansQueryString == "non" ) {
				// le parametre à ajouter n'existe pas encore dans la queryString
				$urlFinal = $url . "&" . $paramNom . "=" . $paramValeur;
			} else if ( $paramAAjouterPresentDansQueryString == "oui" ) {
				// le parametre à ajouter existe déjà dans la queryString
				// donc on va reconstruire l'URL
				$urlFinal = $t_url[0] . "?";
				foreach ( $t_queryString as $cle => $coupleNomValeur ) {
					if ( $cle > 0 ) {
						$urlFinal .= "&";
					}
					$t_coupleNomValeur = explode( "=", $coupleNomValeur );
					if ( $t_coupleNomValeur[0] == $paramNom ) {
						$urlFinal .= $paramNom . "=" . $paramValeur;
					} else {
						$urlFinal .= $t_coupleNomValeur[0] . "=" . $t_coupleNomValeur[1];
					}
				}
			}
		}
	}

	return $urlFinal;
}

/**
 * Return SVG Icon
 *
 * @param $name
 * @param string $class
 *
 * @return array|false|string|string[]
 */
function icon( $name, string $class = '' ) {
	$svg    = file_get_contents( ICONS_ABS_PATH . '/' . $name . '.svg' );
	$class  = ( ! empty( $class ) ) ? 'icon ' . $class : 'icon';
	$render = str_replace( '<svg ', '<svg class="' . $class . '"', $svg );

	return $render;
}

/**
 * Return image path
 *
 * @param $image
 *
 * @return array|mixed|string|string[]|void
 */
function getImagePath( $image ) {
	$image_url   = $image['url'];
	$uploads_dir = wp_upload_dir();
	$image_path  = str_replace( $uploads_dir['baseurl'], $uploads_dir['basedir'], $image_url );

	return $image_path;
}

/**
 * Strip tags for wysiwyg field
 *
 * @param $field
 *
 * @return string
 */
function stripTagsField( $field ) {
	return strip_tags( $field, '<br><strong><b>' );
}
