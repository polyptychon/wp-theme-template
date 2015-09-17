<?php
function get_first_level_page( $page_id ) {
	$parent       = array_reverse( get_post_ancestors( $page_id ) );
	$first_parent = get_post( $parent[0] );

	return $first_parent;
}
function get_first_level_page_title( $page_id ) {
	$parent       = array_reverse( get_post_ancestors( $page_id ) );
	$first_parent = get_post( $parent[0] );

	return $first_parent->post_title;
}
function get_auto_excerpt($excerpt_word_count=40)
{
	global $post;
	$excerpt = $post->post_excerpt;
	if( $excerpt == '' )
	{
		$excerpt = $post->post_content;
		$excerpt = strip_shortcodes( $excerpt );
		$excerpt = str_replace(']]>', ']]>', $excerpt);
		$excerpt = strip_tags($excerpt);
		$words = explode(' ', $excerpt, $excerpt_word_count + 1);
		if (count($words) > $excerpt_length)
		{
			array_pop($words);
			$excerpt = implode(' ', $words);
			$excerpt .= '...';
		}
	}
	return $excerpt;
}
/*
* Get Homepage ID
*/

function get_home_page_id() {
	if ( get_option( 'show_on_front' ) == 'page' ) {
		return get_option( 'page_on_front' );
	}
	return -1;
}
