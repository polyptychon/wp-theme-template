<?php

function get_taxonomy_terms_as_anchor_tags( $postID, $taxonomy_slug, $post_type_home_id = 18 ) {
	$out   = '';
	$terms = get_the_terms( $postID, $taxonomy_slug );
	if ( $terms && ! is_wp_error( $terms ) ) {
		foreach ( $terms as $term ) {
			$out = '<a href="' . get_page_permalink( $post_type_home_id ) . '?' . $taxonomy_slug . '=' . $term->slug . '">' . $term->name . '</a>';
		}
	}

	return $out;
}

function get_taxonomy_terms_as_text( $postID, $taxonomy_slug ) {
	$out   = '';
	$terms = get_the_terms( $postID, $taxonomy_slug );
	if ( $terms && ! is_wp_error( $terms ) ) {
		foreach ( $terms as $term ) {
			$out = $term->name . ',';
		}
	}

	return trim( $out, ',' );
}

function get_custom_post_type_taxonomies( $post_type = "moveart_project" ) {
	$taxonomy_object_names = get_object_taxonomies( $post_type, 'objects' );
	$taxonomy_names        = array();

	foreach ( $taxonomy_object_names as $key => $value ) {
		$taxonomy_names[ $value->slug ] = $value->labels->name;
	}

	return $taxonomy_names;
}

function get_all_taxonomies_for_query( $post_type = "moveart_project" ) {
	$tax_query      = array();
	$queries        = array();
	$taxonomy_names = get_custom_post_type_taxonomies( $post_type );
	foreach ( $taxonomy_names as $key => $value ) {
		$query_var = get_query_var( $key );
		if ( ! is_array( $query_var ) && empty( $query_var ) ) {
			$queries[ $key ] = array();
		} else {
			$queries[ $key ] = is_array( $query_var ) ? $query_var : array( $query_var );

			array_push( $tax_query, array(
				'taxonomy' => $key,
				'field'    => 'slug',
				'terms'    => $queries[ $key ]
			) );
		}
	}

	return $tax_query;
}

function get_all_taxonomies_filter( $post_type = "moveart_project" ) {
	$tax_query      = array();
	$queries        = array();
	$taxonomy_names = get_custom_post_type_taxonomies( $post_type );
	$filter         = '';
	foreach ( $taxonomy_names as $key => $value ) {
		$query_var = get_query_var( $key );
		if ( ! is_array( $query_var ) && empty( $query_var ) ) {
			$queries[ $key ] = array();
		} else {
			$queries[ $key ] = is_array( $query_var ) ? $query_var : array( $query_var );

			array_push( $tax_query, array(
				'taxonomy' => $key,
				'field'    => 'slug',
				'terms'    => $queries[ $key ]
			) );
			$filter .= implode( ',', $queries[ $key ] ) . ',';
		}
	}

	return $filter;
}
