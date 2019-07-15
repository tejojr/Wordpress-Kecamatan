<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Graduate
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function graduate_body_classes( $classes ) {
	$options = graduate_get_theme_options();

	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Add a class for layout
	$classes[] = esc_attr( $options['site_layout'] );

	// Add a class for sidebar
	$sidebar_position = graduate_layout();

	if( is_singular() ) {
		$sidebar = get_post_meta( get_the_id(), 'graduate-sidebar', true );
		$post_sidebar = ! empty( $sidebar ) ? $sidebar : 'sidebar-1';
	} else {
		$post_sidebar = 'sidebar-1';
	}

	if ( is_active_sidebar( $post_sidebar ) ) {
		$classes[] = esc_attr( $sidebar_position );
	} else {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'graduate_body_classes' );
