<?php

function pagination( $query = null, $classes = 'pull-right' ) {
  global $wp_query, $paged;
  if ( $query ) {
    $wp_query = $query;
  }
  $pageNumber     = empty( $paged ) ? 1 : $paged;
  $totalPages     = $wp_query->max_num_pages;
  $paginationHTML = "";
  if ( $totalPages <= 1 ) {
    return;
  }
  $paginationHTML .= "<ul class=\"pagination $classes\">";
  $paginationHTML .= "<li><a rel=\"prev\" class=\"previous\" href=\"" . get_pagenum_link( $pageNumber - 1 ) . "\"><span class=\"glyphicon previous-icon\"></span></a></li>";
  if ( $totalPages < 8 ) {
    $paginationHTML .= get_pagination_HTML( 1, $totalPages, $pageNumber );
  } else {
    if ( $pageNumber < 5 ) {
      $paginationHTML .= get_pagination_HTML( 1, 5, $pageNumber );
      $paginationHTML .= "<li><a>...</a></li>";
      $paginationHTML .= get_pagination_HTML( $totalPages, $totalPages, $pageNumber );
    } else if ( $pageNumber > $totalPages - 4 ) {
      $paginationHTML .= get_pagination_HTML( 1, 1, $pageNumber );
      $paginationHTML .= "<li><a>...</a></li>";
      $paginationHTML .= get_pagination_HTML( $totalPages - 4, $totalPages, $pageNumber );
    } else {
      $paginationHTML .= get_pagination_HTML( 1, 1, $pageNumber );
      $paginationHTML .= "<li><a>...</a></li>";
      $paginationHTML .= get_pagination_HTML( $pageNumber - 1, $pageNumber + 1, $pageNumber );
      $paginationHTML .= "<li><a>...</a></li>";
      $paginationHTML .= get_pagination_HTML( $totalPages, $totalPages, $pageNumber );
    }
  }
  $paginationHTML .= "<li><a rel=\"next\" class=\"next\" href=\"" . get_pagenum_link( min( $pageNumber + 1, $totalPages ) ) . "\"><span class=\"glyphicon next-icon\"></span></a></li>";
  $paginationHTML .= "</ul>";
  echo $paginationHTML;
}

function get_pagination_HTML( $start, $end, $pageNumber ) {
  $paginationHTML = "";
  for ( $i = $start; $i <= $end; $i ++ ) {
    $cssClass = "";
    if ( $i == $pageNumber ) {
      $cssClass = "active";
    }
    $rel = $i > $pageNumber ? "next" : $rel = "previous";
    $paginationHTML .= "<li class=\"pages " . $cssClass . "\"><a rel=\"" . $rel . "\" href=\"" . get_pagenum_link( $i ) . "\">" . $i . "</a></li>";
  }

  return $paginationHTML;
}
