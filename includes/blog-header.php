<?php
function brand_title() {
	echo esc_attr( get_bloginfo( 'title', 'display' ) ) . ' - ' . esc_attr( get_bloginfo( 'description', 'display' ) );
}
