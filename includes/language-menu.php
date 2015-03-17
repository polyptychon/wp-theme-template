<?php

function languages_list_header() {
  $languages = icl_get_languages( 'skip_missing=0&orderby=code' );
  if ( ! empty( $languages ) ) {
    echo '<ul class="header-bar-menu pull-right">';
    foreach ( $languages as $l ) {
      if ( ! $l['active'] ) {
        // language native name
        echo '<li><a href="' . $l['url'] . '">' . $l['native_name'] . '</a></li>';
        //only flag
        //echo'<li class="menu-item menu-item-language"><a href="' . $l['url'] . '"><img src="' . $l['country_flag_url'] . '" height="12" alt="' . $l['language_code'] . '" width="18" /></a></li>';
      }
    }
    echo '</ul>';
  }
}