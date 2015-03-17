<?php

function get_page_permalink($id) {
	$id = icl_object_id($id, 'page', false,ICL_LANGUAGE_CODE);
  return get_permalink( $id );
}

function get_blog_home() {
  $blog_page_slug = "post";
  if ( get_option( 'show_on_front' ) == 'page' ) {
    $blog_page_slug = get_post( get_option( 'page_for_posts' ) )->post_name;
  }

  return $blog_page_slug;
}

