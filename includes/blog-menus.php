<?php
class My_Walker_Page_Child_Link extends Walker_Page {
	public function start_el( &$output, $page, $depth = 0, $args = array(), $current_page = 0 ) {
		if ( $depth ) {
			$indent = str_repeat( "\t", $depth );
		} else {
			$indent = '';
		}

		$css_class = array( 'page_item', 'page-item-' . $page->ID );

		if ( isset( $args['pages_with_children'][ $page->ID ] ) ) {
			$css_class[] = 'page_item_has_children';
		}

		if ( ! empty( $current_page ) ) {
			$_current_page = get_post( $current_page );
			if ( $_current_page && in_array( $page->ID, $_current_page->ancestors ) ) {
				$css_class[] = 'current_page_ancestor';
			}
			if ( $page->ID == $current_page ) {
				$css_class[] = 'current_page_item';
			} elseif ( $_current_page && $page->ID == $_current_page->post_parent ) {
				$css_class[] = 'current_page_parent';
			}
		} elseif ( $page->ID == get_option('page_for_posts') ) {
			$css_class[] = 'current_page_parent';
		}


		$css_classes = implode( ' ', apply_filters( 'page_css_class', $css_class, $page, $depth, $args, $current_page ) );

		if ( '' === $page->post_title ) {
			$page->post_title = sprintf( __( '#%d (no title)' ), $page->ID );
		}

		$args['link_before'] = empty( $args['link_before'] ) ? '' : $args['link_before'];
		$args['link_after'] = empty( $args['link_after'] ) ? '' : $args['link_after'];

		$permalink = get_permalink( $page->ID );
		if ( isset( $args['pages_with_children'][ $page->ID ] ) ) {
			if ($page->post_parent == 0):
				$children = get_children( array( 'post_type'   => 'page',
				                                 'post_parent' => $page->ID,
				                                 'post_status' => 'publish',
				                                 'numberposts' => 1,
				                                 'orderby'     => 'menu_order',
				                                 'order'       => 'ASC'
				) );
				if ( $children ):
					foreach ( $children as $child ):
						$permalink = get_permalink( $child->ID );
					endforeach;
				endif;
			endif;
		}
		/** This filter is documented in wp-includes/post-template.php */
		$output .= $indent . sprintf(
				'<li class="%s"><a href="%s">%s%s%s</a>',
				$css_classes,
				$permalink,
				$args['link_before'],
				apply_filters( 'the_title', $page->post_title, $page->ID ),
				$args['link_after']
			);

		if ( ! empty( $args['show_date'] ) ) {
			if ( 'modified' == $args['show_date'] ) {
				$time = $page->post_modified;
			} else {
				$time = $page->post_date;
			}

			$date_format = empty( $args['date_format'] ) ? '' : $args['date_format'];
			$output .= " " . mysql2date( $date_format, $time );
		}
	}
}
