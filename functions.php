<?php
/*
 * Includes
 * */
define( 'INCLUDES_PATH', dirname( __FILE__ ) . '/includes/' );

include( INCLUDES_PATH . 'acc.php' );
include( INCLUDES_PATH . 'blog-categories.php' );
include( INCLUDES_PATH . 'blog-header.php' );
include( INCLUDES_PATH . 'blog-language.php' );
include( INCLUDES_PATH . 'blog-menus.php' );
include( INCLUDES_PATH . 'blog-pages.php' );
include( INCLUDES_PATH . 'blog-pagination.php' );
include( INCLUDES_PATH . 'blog-taxonomies.php' );
include( INCLUDES_PATH . 'calendar-widget.php' );
include( INCLUDES_PATH . 'get-permalinks.php' );
include( INCLUDES_PATH . 'language-menu.php' );
include( INCLUDES_PATH . 'media.php' );
include( INCLUDES_PATH . 'setup-custom-post-type.php' );
include( INCLUDES_PATH . 'setup-taxonomies.php' );


/*
 * Remove wordpress header metadata
*/

function my_remove_generators() {
  remove_action('wp_head', 'wp_generator');
  remove_action('wp_head', 'wlwmanifest_link');
  remove_action('wp_head', 'rsd_link');
  remove_action('wp_head', 'print_emoji_detection_script', 7);
  remove_action('wp_print_styles', 'print_emoji_styles' );
  if ( ! empty ( $GLOBALS['sitepress'] ) ) {
    remove_action( 'wp_head', array( $GLOBALS['sitepress'], 'meta_generator_tag' ) );
  }
}

add_action( 'wp_head', 'my_remove_generators', 0 );

/*
 * Add featured image support for custom theme
*/
// add_theme_support( 'post-thumbnails' );

/*
Description: Used to style the TinyMCE editor.
*/
add_editor_style( 'assets/css/editor.css' );

/*
 * Display page title to browser tab
*/
add_theme_support( 'title-tag' );

/*
 * Add menu support to custom theme
*/
function register_my_menu() {
	register_nav_menu( 'header-menu', __( 'Header Menu' ) );
}

add_action( 'init', 'register_my_menu' );
/*
 * Add new custom image styles
 * add_image_size( $name, $width, $height, $crop );
*/
// add_image_size( 'project_thumbnail', 270, 180, true );
// add_image_size( 'services_thumbnail', 366, 194, true );
/*
 * Display new custom image styles when uploading media
*/
// add_filter( 'image_size_names_choose', 'my_custom_sizes' );
// function my_custom_sizes( $sizes ) {
// 	return array_merge( $sizes, array(
// 		'project_thumbnail'         => __( 'Project Thumbnail' ),
// 		'services_thumbnail'        => __( 'Services Thumbnail' )
// 	) );
// }

/*
 * get link from first menu item child
*/
// function my_nav_menu_child_link( $menu, $args ) {
//   if ( $args->menu->slug == 'main-nav-menu' || $args->menu->slug == 'main-nav-menu-en' ):
//     foreach ( $menu as $menu_item ):
//       $children = get_children( array(
//         'post_type'   => 'page',
//         'post_parent' => $menu_item->object_id,
//         'post_status' => 'publish',
//         'numberposts' => 1,
//         'orderby'     => 'menu_order',
//         'order'       => 'ASC'
//       ) );
//       if ( $children ):
//         foreach ( $children as $child ):
//           $menu_item->url = get_permalink( $child->ID );
//         endforeach;
//       endif;
//     endforeach;
//   endif;
//   return $menu;
// }

// add_filter( 'wp_nav_menu_objects', 'my_nav_menu_child_link', 10, 2 );

/*
 * Rename posts from admin
*/
// function edit_admin_menus() {
// 	global $menu;
// 	global $submenu;

// 	$menu[5][0]                = 'News'; // Change Posts to News
// 	$submenu['edit.php'][5][0] = 'All News';
// 	//$submenu['edit.php'][10][0] = 'Add a News Article';
// }

// add_action( 'admin_menu', 'edit_admin_menus' );

/*
 * Remove comments from admin
*/
// function remove_menus() {
// 	remove_menu_page( 'edit-comments.php' );//Comments
// }

// add_action( 'admin_menu', 'remove_menus' );

/*
 * Reorder admin menu
*/
// function custom_menu_order( $menu_ord ) {
// 	if ( ! $menu_ord ) {
// 		return true;
// 	}

// 	return array(
// 		'index.php', // Dashboard
// 		'separator1', // First separator
// 		'upload.php', // Media
// 		'link-manager.php', // Links
// 		'edit.php?post_type=page', // Pages
// 		'edit.php', // Posts
// 	);
// }

// add_filter( 'custom_menu_order', 'custom_menu_order' ); // Activate custom_menu_order
// add_filter( 'menu_order', 'custom_menu_order' );

/*
 * Disable styles and js from  CONTACT FORM 7
*/
// add_action( 'wp_enqueue_scripts', 'contact_form_7_scripts' );
// function contact_form_7_scripts() {
// 	wp_dequeue_script( 'contact-form-7' );
// 	wp_dequeue_style( 'contact-form-7' );
// }

/*
 * Disable styles and js from WPML START
 * */
// define( 'ICL_DONT_LOAD_LANGUAGE_SELECTOR_CSS', true );
// define( 'ICL_DONT_LOAD_LANGUAGES_JS', true );


/*
 * Custom Post type Projects
 */

// add_action( 'init', 'create_post_type_projects' );

// function create_post_type_projects() {
// 	$post_type = 'moveart_project';

// 	create_custom_post_type( array(
// 		'post_type_name' => $post_type,
// 		'plural_name'    => 'Projects',
// 		'singular_name'  => 'Project'
// 	) );

// 	register_taxonomy( 'Institute', array( $post_type ), setup_tax( array(
// 		'post_type_name' => $post_type,
// 		'plural_name'    => 'Institutes',
// 		'singular_name'  => 'Institute'
// 	) ) );


// 	register_taxonomy( 'Year', array( $post_type ), setup_tax( array(
// 		'post_type_name' => $post_type,
// 		'plural_name'    => 'Years',
// 		'singular_name'  => 'Year'
// 	) ) );

// 	register_taxonomy( 'City', array( $post_type ), setup_tax( array(
// 		'post_type_name' => $post_type,
// 		'plural_name'    => 'Cities',
// 		'singular_name'  => 'City'
// 	) ) );

// 	register_taxonomy( 'Country', array( $post_type ), setup_tax( array(
// 		'post_type_name' => $post_type,
// 		'plural_name'    => 'Countries',
// 		'singular_name'  => 'Country'
// 	) ) );
// }

/*
 * Customize Gallery html
 */
// function my_post_gallery($output, $attr) {
//   global $post;

//   if (isset($attr['orderby'])) {
//     $attr['orderby'] = sanitize_sql_orderby($attr['orderby']);
//     if (!$attr['orderby'])
//       unset($attr['orderby']);
//   }

//   extract(shortcode_atts(array(
//     'order' => 'ASC',
//     'orderby' => 'menu_order ID',
//     'id' => $post->ID,
//     'itemtag' => 'dl',
//     'icontag' => 'dt',
//     'captiontag' => 'dd',
//     'columns' => 3,
//     'size' => 'thumbnail',
//     'include' => '',
//     'exclude' => ''
//   ), $attr));

//   $id = intval($id);
//   if ('RAND' == $order) $orderby = 'none';

//   if (!empty($include)) {
//     $include = preg_replace('/[^0-9,]+/', '', $include);
//     $_attachments = get_posts(array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby));

//     $attachments = array();
//     foreach ($_attachments as $key => $val) {
//       $attachments[$val->ID] = $_attachments[$key];
//     }
//   }

//   if (empty($attachments)) return '';

//   // Here's your actual output, you may customize it to your need
//   $output = "<div class=\"content-photos photos\">";

//   // Now you loop through each attachment
//   foreach ($attachments as $id => $attachment) {
//     $img_thumb = wp_get_attachment_image_src($id, 'gallery_thumbnail');
//     $img = wp_get_attachment_image_src($id, 'full');

//     $output .= "<div class=\"image-container\">\n";
//     $output .= "<div class=\"ih-item square effect6 from_top_and_bottom\">\n";
//     $output .= "<a href=\"{$img[0]}\" class=\"trigger\">\n";
//     $output .= "<div class=\"img\">\n";
//     $output .= "<img src=\"{$img_thumb[0]}\" width=\"{$img_thumb[1]}\" height=\"{$img_thumb[2]}\" alt=\"\" />\n";
//     $output .= "</div>\n";
//     $output .= "<div class=\"info\"><div class=\"icons\"><span class=\"glyphicon icon-fullscreen-image\"></span></div></div>";
//     $output .= "</a>\n";
//     $output .= "</div>\n";
//     $output .= "</div>\n";
//   }

//   $output .= "</div>\n";

//   return $output;
// }
// add_filter('post_gallery', 'my_post_gallery', 10, 2);

/*
 * Customize anchor image
 */
// function custom_image_tag($html, $id) {
//   $img = wp_get_attachment_image_src($id, 'full');
//   if ($img && count($img)>=3) {
//     $str = '<img data-width="'.$img[1].'" data-height="'.$img[2].'" ';
//     return str_replace('<img ', $str, $html);
//   }
//   return $html;
// }
// add_filter('get_image_tag', 'custom_image_tag', 10, 2);
