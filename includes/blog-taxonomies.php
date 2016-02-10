<?php

function get_taxonomy_terms_as_anchor_tags( $postID, $taxonomy_slug, $post_type_home_id = 11 ) {
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

function get_custom_post_type_taxonomies( $post_type = "collection-item" ) {
  $taxonomy_object_names = get_object_taxonomies( $post_type, 'objects' );
  $taxonomy_names        = array();

  foreach ( $taxonomy_object_names as $key => $value ) {
    $slug                    = $value->slug ? $value->slug : $value->name;
    $taxonomy_names[ $slug ] = $value->labels->name;
  }

  return $taxonomy_names;
}

function get_custom_post_type_taxonomy( $taxonomy, $post_type = "collection-item" ) {
  $taxonomy_object_names = get_object_taxonomies( $post_type, 'objects' );
  $taxonomy_names        = array();

  foreach ( $taxonomy_object_names as $key => $value ) {
    $taxonomy_names[ $value->slug ] = $value->labels->name;
  }

  return $taxonomy_names;
}

function get_all_taxonomies_for_query( $post_type ) {
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

function get_all_taxonomies_filter( $post_type ) {
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

function the_blog_taxonomy_dropdown( $taxonomy_slug, $post_type_home_id=11, $post_type_slug='collection', $all_label = 'All exhibits', $count_posts=false ) {
  echo get_blog_taxonomy_dropdown( $taxonomy_slug, $post_type_home_id, $post_type_slug, $all_label, $count_posts );
}
function get_blog_taxonomy_dropdown( $taxonomy_slug, $post_type_home_id=11, $post_type_slug='collection', $all_label = 'All exhibits', $count_posts=false ) {
  $query_var = get_query_var( $taxonomy_slug );

  $total_posts = $count_posts ? my_count_posts(ICL_LANGUAGE_CODE, $post_type_slug) : '';
  $post_type_link = get_page_permalink( $post_type_home_id );
  $terms     = get_terms( $taxonomy_slug, array('hide_empty'=> true) );
  $term_name = $count_posts ? "$all_label ($total_posts)":$all_label;

  if ( !empty( $query_var ) ) {
    foreach ( $terms as $term ) {
      $term_slug = urldecode( $term->slug ? $term->slug : $term->name );
      if ( $term_slug == $query_var ) {
        $term_name = $count_posts ? "$term->name ($term->count)":$term->name;
      }
    }
  }
  $str  = '<div class="dropdown">';
  $str .= '<button type="button" data-toggle="dropdown" class="text-uppercase dropdown-toggle btn btn-default">';
  $str .= "$term_name&nbsp;";
  $str .= '<span class="caret"></span></button>';
  $str .= '<ul role="menu" class="dropdown-menu">';
  if ( !empty( $query_var ) ) {
    $term_name = $count_posts ? "$all_label ($total_posts)":$all_label;
    $str .= "<li><a class=\"text-uppercase\" href=\"$post_type_link\">$term_name</a></li>";
  }
  foreach ( $terms as $term ) {
    $term_slug = urldecode( $term->slug ? $term->slug : $term->name );
    if ( $term_slug != $query_var ) {
      $term_link = "$post_type_link?$taxonomy_slug=$term_slug";
      $term_name = $count_posts ? "$term->name  ($term->count)" : $term->name;
      $str .= "<li><a class=\"text-uppercase\" href=\"$term_link\">$term_name </a></li>";
    }
  }
  $str .= '</ul></div>';
  return $str;
}
function the_taxonomy_list($taxonomy_slug, $post_type_home_id=11, $post_type_slug='collection', $all_taxonomy_label='All exhibits', $count_posts=true) {
  echo get_taxonomy_list($taxonomy_slug, $post_type_home_id, $post_type_slug, $all_taxonomy_label, $count_posts);
}

function get_taxonomy_list($taxonomy_slug, $post_type_home_id=11, $post_type_slug='collection', $all_taxonomy_label='All exhibits', $count_posts=true) {
  $query_var = get_query_var($taxonomy_slug);

  $total_posts = $count_posts ? my_count_posts(ICL_LANGUAGE_CODE, $post_type_slug) : '';
  $term_name = $count_posts ? "$all_taxonomy_label ($total_posts)" : $all_taxonomy_label;
  $post_type_link = get_page_permalink( $post_type_home_id );
  $term_class = empty( $query_var ) ? 'class="active"' : '';

  $str  = "<li $term_class>";
  $str .= "<a $term_class href=\"$post_type_link\">$term_name</a>";
  $str .= "</li>";
  foreach ( get_terms($taxonomy_slug, array('hide_empty'=> true)) as $term ) {
    $term_slug = urldecode( $term->slug ? $term->slug : $term->name );
    $term_name = $count_posts ? "$term->name  ($term->count)" : $term->name;
    $term_link = $post_type_link."?$taxonomy_slug=$term_slug";
    $term_class = $query_var == $term_slug ? 'class="active"' : '';

    $str .= "<li $term_class>";
    $str .= "<a $term_class href=\"$term_link\">$term_name</a>";
    $str .= "</li>";
  }
  return $str;
}
