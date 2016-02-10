<?php

function the_blog_categories($all_news_label='All news') {
	echo get_blog_categories($all_news_label);
}

function get_blog_categories($all_news_label='All news', $count_posts=true) {
  $category_query_id = get_query_var( 'cat' );

  $blog_page_slug = get_blog_home();

  $total_posts = $count_posts ? my_count_posts(ICL_LANGUAGE_CODE, 'post') : '';
  $category_name = $count_posts ? "$all_news_label ($total_posts)" : $all_news_label;
  $category_link = get_home_url().'/'.$blog_page_slug;
  $category_class = $category_query_id==0 ? 'class="active"' : '';

  $str  = "<li $category_class>";
  $str .= "<a $category_class href=\"$category_link\">$category_name</a>";
  $str .= "</li>";
  foreach ( get_categories( array( 'hide_empty' => true ) ) as $category ) {
    $category_name = $count_posts ? "$category->cat_name ($category->count)" : $category->cat_name;
    $category_link = get_category_link($category->term_id);
    $category_class = $category->term_id == $category_query_id ? 'class="active"' : '';

    $str .= "<li $category_class>";
    $str .= "<a $category_class href=\"$category_link\">$category_name</a>";
    $str .= "</li>";
  }
  return $str;
}

function the_blog_categories_dropdown($all_news_label='All news', $classes='text-uppercase', $count_posts=false) {
	echo get_blog_categories_dropdown($all_news_label, $classes, $count_posts);
}

function get_blog_categories_dropdown($all_news_label='All news', $classes='text-uppercase', $count_posts=false) {
  $category_query_id = get_query_var( 'cat' );

  $blog_page_slug = get_blog_home();
  $category_link = get_home_url().'/'.$blog_page_slug;
  $total_posts = $count_posts ? my_count_posts(ICL_LANGUAGE_CODE, 'post') : '';

  if ( empty($category_query_id) ) {
    $category_name = $count_posts ? "$all_news_label ($total_posts)" : $all_news_label;
  } else {
    $category_name = get_cat_name( $category_query_id );
    $category_name = $count_posts ? $category_name . ' (%selected_category_count%)' : $category_name;
  }


  $str  = '<div class="dropdown">';

  $str .= "<button type=\"button\" data-toggle=\"dropdown\" class=\"$classes dropdown-toggle btn btn-default\">";
  $str .= "$category_name&nbsp;";
  $str .= "<span class=\"caret\"></span>";
  $str .= "</button>";

  $str .= '<ul role="menu" class="dropdown-menu">';

  if ( !empty($category_query_id) ) {
    $category_name = $count_posts ? "$all_news_label ($total_posts)" : $all_news_label;
    $str .= "<li>";
    $str .= "<a class=\"$classes\" href=\"$category_link\">$category_name</a>";
    $str .= "</li>";
  }

  foreach ( get_categories( array( 'hide_empty' => true ) ) as $category ) {
    $category_name = $count_posts ? "$category->cat_name ($category->count)" : $category->cat_name;
    $category_link = get_category_link($category->term_id);

    if ($category->term_id != $category_query_id) {
      $str .= "<li>";
      $str .= "<a class=\"$classes\" href=\"$category_link\">$category_name</a>";
      $str .= "</li>";
    } else {
      $str = str_replace('%selected_category_count%', $category->count, $str );
    }
  }
  $str .= '</ul></div>';
  return $str;
}

function get_categories_as_anchors( $categories, $sep = ', ', $classes = 'category' ) {
	$links = '';
	foreach ( $categories as $category ) {
    $category_name = $category->cat_name;
    $category_link = get_category_link($category->term_id);
		$links .= "<a class=\"text-uppercase $classes\" href=\"$category_link\">$category_name</a>$sep";
	}
	return trim( $links, $sep );
}

function get_all_categories_as_string( $exclude_id=null, $sep = ',' ) {
	$a          = '';
	$categories = get_categories();
	foreach ( $categories as $category ) {
		if ( !$exclude_id || $exclude_id != $category->term_id ) {
			$a .= $category->term_id . $sep;
		}
	}
	return trim( $a, $sep );
}

function the_blog_home_url() {
	echo get_blog_home_url();
}
function get_blog_home_url() {
	return get_bloginfo( 'wpurl' ) .'/'. get_language_code_for_url(). get_blog_home().'/';
}
