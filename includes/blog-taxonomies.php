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

function the_blog_taxonomy_dropdown( $taxonomy_slug, $post_type_home_id=11, $all = 'All' ) {
  $terms     = get_terms( $taxonomy_slug );
  $query_var = get_query_var( $taxonomy_slug );
  echo '<div class="btn-group">';
  echo '<button type="button" data-toggle="dropdown" class="text-uppercase dropdown-toggle btn btn-default">';
  if ( empty( $query_var ) ) {
    echo $all;
  } else {
    foreach ( $terms as $term ) {
      $slug = urldecode( $term->slug ? $term->slug : $term->name );
      if ( $slug == $query_var ) {
        echo $term->name;
      }
    }
  }
  echo '<span class="caret"></span></button>';
  echo '<ul role="menu" class="dropdown-menu">';
  if ( ! empty( $query_var ) ) {
    $link = get_page_permalink( $post_type_home_id );
    echo '<li><a class="text-uppercase" href="' . $link . '">' . $all . '</a>' . '</li>';
  }
  foreach ( $terms as $term ) {
    $slug = urldecode( $term->slug ? $term->slug : $term->name );
    if ( $slug != $query_var ) {
      $link = get_page_permalink( $post_type_home_id ) . '?' . $taxonomy_slug . '=' . $slug;
      echo '<li><a class="text-uppercase" href="'.$link.'">' . $term->name . '</a>' . '</li>';
    }
  }
  echo '</ul></div>';
}
