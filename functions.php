<?php
/*
 * Includes
 * */
define( 'INCLUDES_PATH', dirname( __FILE__ ) . '/includes/' );

include( INCLUDES_PATH . 'media.php' );
include( INCLUDES_PATH . 'acc.php' );
include( INCLUDES_PATH . 'blog-header.php' );
include( INCLUDES_PATH . 'blog-taxonomies.php' );
include( INCLUDES_PATH . 'setup-taxonomies.php' );
include( INCLUDES_PATH . 'setup-custom-post-type.php' );
include( INCLUDES_PATH . 'blog-categories.php' );
include( INCLUDES_PATH . 'blog-home-pagination.php' );
include( INCLUDES_PATH . 'get-permalinks.php' );
include( INCLUDES_PATH . 'language-menu.php' );

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
// function register_my_menu() {
// 	register_nav_menu( 'header-menu', __( 'Header Menu' ) );
// }

// add_action( 'init', 'register_my_menu' );
/*
 * Add new custom image styles
 * add_image_size( $name, $width, $height, $crop );
*/
// add_image_size( 'project_thumbnail', 270, 180, true );
// add_image_size( 'services_thumbnail', 366, 194, true );
// add_image_size( 'about_thumbnail', 753, 420, true );
// add_image_size( 'news_thumbnail', 558, 350, true );
// add_image_size( 'contact_thumbnail', 947, 420, true );
// add_image_size( 'home_project_thumbnail', 165, 165, true );
// add_image_size( 'home_clientlist_thumbnail', 220, 220, true );
// add_image_size( 'home_header_thumbnail', 1600, 471, true );
/*
 * Display new custom image styles when uploading media
*/
// add_filter( 'image_size_names_choose', 'my_custom_sizes' );
// function my_custom_sizes( $sizes ) {
// 	return array_merge( $sizes, array(
// 		'project_thumbnail'         => __( 'Project Thumbnail' ),
// 		'services_thumbnail'        => __( 'Services Thumbnail' ),
// 		'about_thumbnail'           => __( 'About Thumbnail' ),
// 		'news_thumbnail'            => __( 'News Thumbnail' ),
// 		'contact_thumbnail'         => __( 'Contact Thumbnail' ),
// 		'home_project_thumbnail'    => __( 'Home Project Thumbnail' ),
// 		'home_clientlist_thumbnail' => __( 'Home Clientlist Thumbnail' ),
// 		'home_header_thumbnail'     => __( 'Home Header Thumbnail' ),
// 	) );
// }

/*
 * Main Menu active item is collection if artwork
*/
// add_filter( 'nav_menu_css_class', 'thd_menu_classes', 10, 2 );
// function thd_menu_classes( $classes, $item ) {
// 	if ( get_post()->post_parent!=0 && get_post()->post_parent == get_post($item->ID)->post_parent) {
// 		$classes = str_replace( 'current_page_parent', '', $classes );
// 		$classes = str_replace( 'menu-item', 'menu-item current_page_parent', $classes );
// 	} else  if ( ( get_post()->post_type == $item->attr_title) ) {
// 		$classes = str_replace( 'current_page_parent', '', $classes );
// 		$classes = str_replace( 'menu-item', 'menu-item current_page_parent', $classes );
// 	} else {
// 		$classes = str_replace( 'current_page_parent', '', $classes );
// 	}
// 	if ( is_404() ) {
// 		$classes = str_replace( 'current_page_parent', '', $classes );
// 	}

// 	return $classes;
// }

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

