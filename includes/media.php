<?php
/*
 * Support Photoswipe.js
 *
 * Example:
 *
 * * the_picture_a( array(
 *    "image"       => $image,
 *    "link_large"  => "collection_image_large",
 *    "link_retina" => "collection_image_retina",
 *    "thumbs"      => array(
 *      "default" => "collection_image",
 *      "retina"  => "collection_image_large"
 *    )
 * ) );
 *
 */
function the_picture_a( $args = array() ) {
	echo get_picture_a( $args );
}
/*
 * Support Photoswipe.js
 */
function get_picture_a( $args = array() ) {
	$defaults      = array(
		"link_large"  => null,
		"link_retina" => - 1,
	);
	$r             = wp_parse_args( $args, $defaults );
	$args['thumb'] = $r['link_large'];
	$img_large     = get_picture_attributes( $args );
	$args['thumb'] = $r['link_retina'];
	$img_retina    = get_picture_attributes( $args );

	$picture = '<a href="' . $img_large['src'] . '"';
	$picture .= ' data-width="' . $img_large['width'] . '"';
	$picture .= ' data-height="' . $img_large['height'] . '"';
	$picture .= ' data-retina-image="' . $img_retina['src'] . '"';
	$picture .= ' data-retina-width="' . $img_retina['width'] . '"';
	$picture .= ' data-retina-height="' . $img_retina['height'] . '"';
	$picture .= '>';
	$picture .= get_picture( $args );
	$picture .= '</a>';

	return $picture;
}

/*
 * Support ACF and Post Featured Image
 *
 * Example:
 *
 * the_picture( array(
 *    "image"       => $image,
 *    "thumbs"      => array(
 *      "default" => "collection_image",
 *      "retina"  => "collection_image_large"
 *    )
 * ) );
 *
 */
function the_picture( $args = array() ) {
	echo get_picture( $args );
}

/*
 * Support ACF and Post Featured Image
 */
function get_picture( $args = array() ) {
	$defaults = array(
		"image"  => null,
		"id"     => - 1,
		"width"  => 0,
		"height" => 0,
		"thumbs" => array(
			"default"   => "large",
			"screen-xs" => "",
			"screen-sm" => "",
			"screen-md" => "",
			"screen-lg" => "",
			"retina"    => ""
		)
	);
	$r        = wp_parse_args( $args, $defaults );

	$thumbs = $r["thumbs"];

	if ( empty( $thumbs["screen-xs"] ) && empty( $thumbs["screen-sm"] ) && empty( $thumbs["screen-md"] ) && empty( $thumbs["screen-lg"] ) && empty( $thumbs["retina"] ) ) {
		$r['thumb'] = $thumbs["default"];
		$img        = get_picture_attributes( $r );
		$picture    = '<img src="' . $img['src'] . '" alt="' . $img['alt'] . '" width="' . $img['width'] . '" height="' . $img['height'] . '">';
	} else {
		$picture = '<picture>';
		if ( ! empty( $thumbs["screen-xs"] ) ) {
			$r['thumb'] = $thumbs["screen-xs"];
			$img        = get_picture_attributes( $r );
			$picture .= '<source srcset="' . $img['src'] . '" media="(min-width: 480px)">';
		}
		if ( ! empty( $thumbs["screen-sm"] ) ) {
			$r['thumb'] = $thumbs["screen-sm"];
			$img        = get_picture_attributes( $r );
			$picture .= '<source srcset="' . $img['src'] . '" media="(min-width: 768px)">';
		}
		if ( ! empty( $thumbs["screen-md"] ) ) {
			$r['thumb'] = $thumbs["screen-md"];
			$img        = get_picture_attributes( $r );
			$picture .= '<source srcset="' . $img['src'] . '" media="(min-width: 992px)">';
		}
		if ( ! empty( $thumbs["screen-lg"] ) ) {
			$r['thumb'] = $thumbs["screen-lg"];
			$img        = get_picture_attributes( $r );
			$picture .= '<source srcset="' . $img['src'] . '" media="(min-width: 1200px)">';
		}
		if ( ! empty( $thumbs["retina"] ) ) {
			$r['thumb'] = $thumbs["retina"];
			$img        = get_picture_attributes( $r );
			$picture .= '<source srcset="' . $img['src'] . '" media="(min-device-width : 768px) and (-webkit-min-device-pixel-ratio: 2), (min-device-pixel-ratio: 2) ">';
		}
		if ( ! empty( $thumbs["default"] ) ) {
			$r['thumb'] = $thumbs["default"];
			$img        = get_picture_attributes( $r );
			$picture .= '<img srcset="' . $img['src'] . '" alt="' . $img['alt'] . '" width="' . $img['width'] . '" height="' . $img['height'] . '">';
		}
		$picture .= '</picture>';
	}


	return $picture;
}

/*
 * Support ACF and Post Featured Image
 */
function get_picture_attributes( $args ) {
	$defaults = array(
		"image"  => null,
		"id"     => - 1,
		"thumb"  => "large",
		"width"  => 0,
		"height" => 0
	);
	$r        = wp_parse_args( $args, $defaults );

	if ( is_null( $r['image'] ) ) {
		$id  = $r['id'] == - 1 ? get_post_thumbnail_id() : $r['id'];
		$img = wp_get_attachment_image_src( $id, 'large' );
		$src = $img[0];
		$alt = get_post_meta( $id, '_wp_attachment_image_alt', true );
		$w   = $r['width'] == 0 ? $img[1] : $r['width'];
		$h   = $r['height'] == 0 ? $img[2] : $r['height'];
	} else {
		$src = $r['image']['sizes'][ $r['thumb'] ];
		$alt = $r['image']['alt'];
		$w   = $r['width'] == 0 ? $r['image']['sizes'][ $r['thumb'] . '-width' ] : $r['width'];
		$h   = $r['height'] == 0 ? $r['image']['sizes'][ $r['thumb'] . '-height' ] : $r['height'];
	}

	return array(
		"src"    => $src,
		"alt"    => $alt,
		"width"  => $w,
		"height" => $h
	);
}

/*
 * remove title form Vimeo embed
 */
function the_embed_video( $video_embed_code, $width = 500, $height = 281 ) {
	echo get_embed_video( $video_embed_code, $width, $height );
}

function get_embed_video( $video_embed_code, $width = 500, $height = 281 ) {
	// remove title form Vimeo embed
	if ( strpos( $video_embed_code, 'vimeo' ) !== false ) {
		$src = get_embed_video_src( $video_embed_code );

		return "<iframe src=\"$src?color=ffffff&amp;title=0&amp;byline=0&amp;portrait=0\" width=\"$width\" height=\"$height\" frameborder=\"0\" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>";
	} else {
		return $video_embed_code;
	}
}

/*
 * Get src value from embed html
 */
function get_embed_video_src( $video_embed_code ) {
	preg_match( '/src="(.+?)"/', $video_embed_code, $matches );

	return $matches[1];
}
