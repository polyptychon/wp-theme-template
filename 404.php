<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * Learn more: {@link https://codex.wordpress.org/Template_Hierarchy}
 *
 * @package Polyptychon
 * @subpackage theme_name
 * @since theme_name 1.0
 *
 */
?>
<?php get_header(); ?>
<section class="content container">
  <header>
    <h2><span class="text"><?php _e("Error 404", "theme_name");?></span></h2>
    <h1><?php _e('Nothing Found', 'theme_name');?></h1>
    <hr>
  </header>
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2 news-post">
        <h3><?php _e("We are sorry, the page you are looking for does not exist.", "theme_name");?></h3>
        <p><?php _e("You can navigate to our website from the main menu on the right top of the page or visit our ", 'theme_name')?>
          <a href="<?php echo get_home_url(); ?>"><?php _e( "homepage", "theme_name");?></a>.
        </p>
      </div>
    </div>
  </div>
</section>
<?php get_footer(); ?>
