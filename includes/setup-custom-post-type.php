<?php
function create_custom_post_type($args) {
	$defaults = array(
		'post_type_name' => '',
		'plural_name' => '',
		'singular_name' => '',
		'public' => true,
		'has_archive' => true,
		'menu_position' => 5,
		'supports' => array( 'title', 'editor', 'thumbnail', 'revisions' ),
		'capability_type' => 'post',
		'hierarchical' => false,
	);

	$r = wp_parse_args( $args, $defaults );
	$plural_name = $r['plural_name'];
	$singular_name = $r['singular_name'];
	$post_type_name = $r['post_type_name'];

	register_post_type( $post_type_name,
		array(
			'labels'      => array(
				'name'               => __( $plural_name ),
				'singular_name'      => __( $singular_name ),
				'add_new_item'       => __( "Add New $singular_name" ),
				'edit_item'          => __( "Edit $singular_name" ),
				'view_item'          => __( "View $singular_name" ),
				'search_items'       => __( "Search $plural_name" ),
				'not_found'          => __( "No $plural_name found." ),
				'not_found_in_trash' => __( "No $plural_name found in Trash." )
			),
			'public' => $r['public'],
			'has_archive' => $r['has_archive'],
			'menu_position' => $r['menu_position'],

			'supports' => $r['supports'],
			'rewrite' => array('slug' => strtolower($singular_name), 'with_front' => false),
			'capability_type' => $r['capability_type'],
			'hierarchical' => $r['hierarchical'],
		)
	);
}
