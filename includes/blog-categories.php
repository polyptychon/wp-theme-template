<?php

function get_blog_categories() {
	$category_base = get_option( 'category_base' );
	if ( ! empty( $category_base ) ) {
		$category_base = '/' . $category_base . '/';
	} else {
		$category_base = '/';
	}
	$category_id = get_query_var( 'cat' );

	$blog_page_slug = get_blog_home();

	echo "<li " . ( $category_id == 0 ? ' class="active"' : '' ) . "><a href='/" . ( ICL_LANGUAGE_CODE ) . "/" . $blog_page_slug . "'>" . __( 'All news ', 'cacta' ) . " (" . count_posts( ( ICL_LANGUAGE_CODE ), "post", "publish" ) . ")" . "</a></li>"; ?>
	<?php foreach ( get_categories( array( 'hide_empty' => true ) ) as $category ) {
		echo '<li' . ( $category->term_id == $category_id ? ' class="active"' : '' ) . '><a href="' . get_bloginfo( 'wpurl' ) . '/' . ( ICL_LANGUAGE_CODE ) . $category_base .
		     $category->category_nicename . '/">' .
		     $category->cat_name . " (" . $category->count . ")" . '</a>  ' .
		     '</li>';
	}
}

function get_categories_as_anchors( $categories, $sep = ', ', $classes = 'category' ) {
	$links = '';
	foreach ( $categories as $cat ) {
		$links .= '<a href="' . get_category_link( $cat->term_id ) . '" class=' . $classes . '>' . $cat->cat_name . '</a>' . $sep;
	}

	return trim( $links, $sep );
}

function get_all_categories_as_string( $exclude_id, $sep = ',' ) {
	$a          = '';
	$categories = get_categories();
	foreach ( $categories as $category ) {
		if ( $exclude_id != $category->term_id ) {
			$a .= $category->term_id . $sep;
		}
	}

	return trim( $a, $sep );
}
