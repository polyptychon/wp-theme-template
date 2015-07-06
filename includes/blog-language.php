<?php
function get_language_code() {
	global $sitepress;
	if ($sitepress->get_default_language()==ICL_LANGUAGE_CODE) {
		return '';
	}
	return ICL_LANGUAGE_CODE;
}
function get_language_code_for_url() {
	global $sitepress;
	if ($sitepress->get_default_language()==ICL_LANGUAGE_CODE) {
		return '';
	}
	return ICL_LANGUAGE_CODE.'/';
}


function my_count_posts($language_code = '', $post_type = 'post', $post_status = 'publish') {

	global $sitepress, $wpdb;

	//get default language code
	$default_language_code = $sitepress->get_default_language();

	//adjust post type to format WPML uses
	switch ( $post_type ) {
		case 'page':
			$post_type = 'post_page';
			break;
		case 'post':
			$post_type = 'post_post';
			break;
		default:
			$post_type = 'post_'.$post_type;
	}

	//are we dealing with originals or translations?
	$slc_param = $sitepress->get_default_language() == $language_code ? "IS NULL" : "= '{$default_language_code}'";

	$query = "SELECT COUNT( {$wpdb->prefix}posts.ID )
            FROM {$wpdb->prefix}posts
            LEFT JOIN {$wpdb->prefix}icl_translations ON {$wpdb->prefix}posts.ID = {$wpdb->prefix}icl_translations.element_id
            WHERE {$wpdb->prefix}icl_translations.language_code = '{$language_code}'
            AND {$wpdb->prefix}icl_translations.source_language_code $slc_param
            AND {$wpdb->prefix}icl_translations.element_type = '{$post_type}'
            AND {$wpdb->prefix}posts.post_status = '$post_status'";

	return $wpdb->get_var( $query );
}
