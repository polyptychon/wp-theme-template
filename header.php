<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section
 *
 */
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link type="text/css" rel="stylesheet" href="<?php bloginfo( 'template_url' ); ?>/assets/css/main.css">
	<link rel="shortcut icon" href="<?php bloginfo( 'template_url' ); ?>/assets/images/favicon.png"/>
	<script>(function() { document.addEventListener("DOMContentLoaded", function() { var u = document.querySelectorAll(".text-uppercase"); for (var i = 0, l = u.length; i < l; i++) { u[i].innerHTML = getAccText(u[i].innerHTML); } function getAccText(t) { t = t.replace(/Ά/g, "Α");t = t.replace(/ά/g, "α");t = t.replace(/Έ/g, "Ε");t = t.replace(/έ/g, "ε");t = t.replace(/Ή/g, "Η");t = t.replace(/ή/g, "η");t = t.replace(/Ί/g, "Ι");t = t.replace(/Ϊ/g, "Ι");t = t.replace(/ί/g, "ι");t = t.replace(/ϊ/g, "ι");t = t.replace(/ΐ/g, "ι");t = t.replace(/Ό/g, "Ο");t = t.replace(/ό/g, "ο");t = t.replace(/Ύ/g, "Υ");t = t.replace(/Ϋ/g, "Υ");t = t.replace(/ύ/g, "υ");t = t.replace(/ϋ/g, "υ");t = t.replace(/ΰ/g, "υ");t = t.replace(/Ώ/g, "Ω");t = t.replace(/ώ/g, "ω"); return t; } }); }());</script>
	<?php wp_head(); ?>
</head>
<body>
<div class="header-bar">
	<div class="container top-header-sub-menu">
		<?php //languages_list_header(); ?>
		<?php wp_nav_menu( array(
			'menu'       => 'Contact Menu',
			'container'  => '',
			'items_wrap' => '<ul class="header-bar-menu pull-right">%3$s</ul> '
		) ); ?>
	</div>
</div>
<div class="header">
	<div class="container">
		<header id="top" class="navbar">
			<div class="navbar-header">
				<h1><a href="<?php echo get_option( 'home' ); ?>" title="<?php brand_title(); ?>" class="navbar-brand"><?php brand_title(); ?></a></h1>
				<button type="button" data-toggle="collapse" data-target=".bs-navbar-collapse" class="navbar-toggle"><span
						class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span
						class="icon-bar"></span></button>
			</div>
			<nav class="collapse navbar-collapse bs-navbar-collapse sub-navbar">
				<?php echo fix_acc(wp_nav_menu( array(
					'menu'       => 'Main Nav Menu',
					'items_wrap' => '<ul class="nav navbar-nav">%3$s</ul>',
					'echo' => false
				) )); ?>
			</nav>
		</header>
	</div>
</div>
