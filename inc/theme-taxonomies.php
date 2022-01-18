<?php
// Register Custom Taxonomy
function custom_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Test Taxonomies', 'Taxonomy General Name', 'your_text_domain' ),
		'singular_name'              => _x( 'Test Taxonomy', 'Taxonomy Singular Name', 'your_text_domain' ),
		'menu_name'                  => __( 'Test Taxonomy', 'your_text_domain' ),
		'all_items'                  => __( 'All Items', 'your_text_domain' ),
		'parent_item'                => __( 'Parent Item', 'your_text_domain' ),
		'parent_item_colon'          => __( 'Parent Item:', 'your_text_domain' ),
		'new_item_name'              => __( 'New Item Name', 'your_text_domain' ),
		'add_new_item'               => __( 'Add New Item', 'your_text_domain' ),
		'edit_item'                  => __( 'Edit Item', 'your_text_domain' ),
		'update_item'                => __( 'Update Item', 'your_text_domain' ),
		'view_item'                  => __( 'View Item', 'your_text_domain' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'your_text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'your_text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'your_text_domain' ),
		'popular_items'              => __( 'Popular Items', 'your_text_domain' ),
		'search_items'               => __( 'Search Items', 'your_text_domain' ),
		'not_found'                  => __( 'Not Found', 'your_text_domain' ),
		'no_terms'                   => __( 'No items', 'your_text_domain' ),
		'items_list'                 => __( 'Items list', 'your_text_domain' ),
		'items_list_navigation'      => __( 'Items list navigation', 'your_text_domain' ),
	);
	$args   = array(
		'labels'            => $labels,
		'meta_box_cb'       => 'post_categories_meta_box',
		'hierarchical'      => true,
		'public'            => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud'     => true,
		'show_in_rest'      => true
	);
	register_taxonomy( TAXO_TEST, array( POST_TYPE_TEST ), $args );

}
