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
function get_search_excerpt($search, $excerpt_word_count=34)
{
  $position = -1;
  $excerpt = get_the_content();
  $excerpt = strip_shortcodes( $excerpt );
  $excerpt = strip_tags($excerpt);
  $fix_search = fix_acc($search);
  $fix_excerpt = fix_acc($excerpt);
  $words = explode(' ', $excerpt);
  $search_result_length = 0;
  if ($fix_excerpt && $fix_search && !empty($fix_excerpt) && !empty($fix_search)) {
    if (preg_match("/(\\w+)?($fix_search)(\\w+)?/iu", $fix_excerpt, $matches, PREG_OFFSET_CAPTURE)) {
      $search_result_length = strlen($matches[0][0]);
      $position = $matches[0][1];
    }
  }
  if ( ($position<0) && (count( explode( ' ', $fix_search ) ) > 0) ) {
    $fix_search = implode('|', explode( ' ', $fix_search ));
    if (preg_match("/(\\w+)?($fix_search)(\\w+)?/iu", $fix_excerpt, $matches, PREG_OFFSET_CAPTURE)) {
      $search_result_length = strlen($matches[0][0]);
      $position = $matches[0][1];
    }
  }
  $sliced_words = array_slice($words, 0, $excerpt_word_count);
  if ($position>0) {
    $words_before = substr($excerpt, 0, $position);
    $words_after = substr($excerpt, $position, $position + strlen($excerpt));
    $words_before_array = explode(' ', $words_before);
    $words_after_array = explode(' ', $words_after);
    $words_before_array = array_slice($words_before_array, -($excerpt_word_count/2));
    $words_after_array = array_slice($words_after_array, 0, ($excerpt_word_count/2));
    $sliced_words = array_merge($words_before_array,$words_after_array);
  }

  if (count($sliced_words) > 0)
  {
    array_pop($sliced_words);
    $excerpt = $position-($excerpt_word_count/2)>0 ? '...' : '';
    $excerpt .= implode(' ', $sliced_words);
    if ($position + $search_result_length<strlen($fix_excerpt)) $excerpt .= '...';
    else $excerpt .= ' '.$words[count($words)-1];
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
