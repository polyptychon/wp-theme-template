<?php
function setup_tax( $args ) {
	$defaults = array(
		'post_type_name'    => '',
		'plural_name'       => '',
		'singular_name'     => '',
		'hierarchical'      => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true
	);

	$r              = wp_parse_args( $args, $defaults );
	$plural_name    = $r['plural_name'];
	$singular_name  = $r['singular_name'];
	$post_type_name = $r['post_type_name'];

	$labels = array(
		'name'              => _x( $plural_name, 'taxonomy general name' ),
		'singular_name'     => _x( $singular_name, 'taxonomy singular name' ),
		'search_items'      => __( "Search $plural_name" ),
		'all_items'         => __( "All $plural_name" ),
		'parent_item'       => __( "Parent $singular_name" ),
		'parent_item_colon' => __( "Parent .$singular_name:" ),
		'edit_item'         => __( "Edit $singular_name" ),
		'update_item'       => __( "Update $singular_name" ),
		'add_new_item'      => __( "Add New $singular_name" ),
		'new_item_name'     => __( "New $singular_name Name" ),
		'menu_name'         => __( $singular_name ),
	);

	$args = array(
		'hierarchical'      => $r['hierarchical'],
		'labels'            => $labels,
		'show_ui'           => $r['show_ui'],
		'show_admin_column' => $r['show_admin_column'],
		'query_var'         => $r['query_var'],
		'rewrite'           => array( 'slug' => strtolower("$post_type_name-$singular_name") ),
	);

	return $args;
}
