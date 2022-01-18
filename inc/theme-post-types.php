<?php
// Register Custom Post Type
function custom_post_type() {

	$labels = array(
		'name'                  => _x( 'Test Post Types', 'Post Type General Name', 'your_text_domain' ),
		'singular_name'         => _x( 'Test Post Type', 'Post Type Singular Name', 'your_text_domain' ),
		'menu_name'             => __( 'Test Post Type', 'your_text_domain' ),
		'name_admin_bar'        => __( 'Test Post Type', 'your_text_domain' ),
		'archives'              => __( 'Item Archives', 'your_text_domain' ),
		'attributes'            => __( 'Item Attributes', 'your_text_domain' ),
		'parent_item_colon'     => __( 'Parent Item:', 'your_text_domain' ),
		'all_items'             => __( 'All Items', 'your_text_domain' ),
		'add_new_item'          => __( 'Add New Item', 'your_text_domain' ),
		'add_new'               => __( 'Add New', 'your_text_domain' ),
		'new_item'              => __( 'New Item', 'your_text_domain' ),
		'edit_item'             => __( 'Edit Item', 'your_text_domain' ),
		'update_item'           => __( 'Update Item', 'your_text_domain' ),
		'view_item'             => __( 'View Item', 'your_text_domain' ),
		'view_items'            => __( 'View Items', 'your_text_domain' ),
		'search_items'          => __( 'Search Item', 'your_text_domain' ),
		'not_found'             => __( 'Not found', 'your_text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'your_text_domain' ),
		'featured_image'        => __( 'Featured Image', 'your_text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'your_text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'your_text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'your_text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'your_text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'your_text_domain' ),
		'items_list'            => __( 'Items list', 'your_text_domain' ),
		'items_list_navigation' => __( 'Items list navigation', 'your_text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'your_text_domain' ),
	);
	$args = array(
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'revisions' ),
		'taxonomies'            => array( TAXO_TEST ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
		'show_in_rest'          => true
	);
	register_post_type( POST_TYPE_TEST, $args );

}
