<?php

function the_blog_categories($all_news_label='All news') {
	$category_query_id = get_query_var( 'cat' );

  $blog_page_slug = get_blog_home();
  $total_posts = wp_count_posts()->publish;
  $category_name = "$all_news_label ($total_posts)";
  $category_link = get_home_url().'/'.$blog_page_slug;
  $category_class = $category_query_id==0 ? 'class="active"' : '';

  echo "<li $category_class>";
  echo "<a $category_class href=\"$category_link\">$category_name</a>";
  echo "</li>";
  foreach ( get_categories( array( 'hide_empty' => true ) ) as $category ) {
    $category_name = "$category->cat_name ($category->count)";
    $category_link = get_category_link($category->term_id);
    $category_class = $category->term_id == $category_query_id ? 'class="active"' : '';

		echo "<li $category_class>";
    echo "<a $category_class href=\"$category_link\">$category_name</a>";
		echo "</li>";
	}
}

function the_blog_categories_dropdown() {
	$category_base = get_option( 'category_base' );
	if ( ! empty( $category_base ) ) {
		$category_base = '/' . $category_base . '/';
	} else {
		$category_base = '/';
	}
	$category_id = get_query_var( 'cat' );

	echo '<div class="btn-group">';
	echo '<button type="button" data-toggle="dropdown" class="text-uppercase dropdown-toggle btn btn-default">';
	if (empty($category_id)):
		_e("All news", "kastoria");
	else:
		echo get_cat_name($category_id);
	endif;
	echo '<span class="caret"></span></button>';
	echo '<ul role="menu" class="dropdown-menu">';
	if (!empty($category_id)):
		echo '<li><a class="text-uppercase" href="' .
		     get_bloginfo( 'wpurl' ) .'/'.
		     get_language_code_for_url(). get_blog_home(). '/">' .
		     translate("All news", "kastoria").
		     '</a>' .
		     '</li>';
	endif;
	foreach ( get_categories( array( 'hide_empty' => true ) ) as $category ):
		if ($category->term_id != $category_id):
			echo '<li><a class="text-uppercase" href="' .
			     get_bloginfo( 'wpurl' ) .'/'.
			     get_language_code_for_url(). $category_base .
			     $category->category_nicename . '/">' .
			     $category->cat_name.
			     '</a>' .
			     '</li>';
		endif;
	endforeach;
	echo '</ul></div>';
}

function get_categories_as_anchors( $categories, $sep = ', ', $classes = 'category' ) {
	$links = '';
	foreach ( $categories as $cat ) {
		$links .= '<a class="text-uppercase '.$classes.'" href="' . get_category_link( $cat->term_id ) . '">' . $cat->cat_name . '</a>' . $sep;
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
