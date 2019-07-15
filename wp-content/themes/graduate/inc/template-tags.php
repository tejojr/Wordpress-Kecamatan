<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Graduate
 */

if ( ! function_exists( 'graduate_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function graduate_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		$year  = get_the_time('Y');
	    $month = get_the_time('m');
	    $post_type = get_post_type();
		$tp_education_post_type = array(
	    	'tp-course',
	    	'tp-class',
	    	'tp-event',
	    	'tp-team',
	    	'tp-testimonial',
	    	'tp-excursion',
	    	'tp-affiliation',
	    	);

		if ( 'post' === $post_type ) {
			$date_url = get_month_link( $year, $month );
		} else {
			if ( function_exists( 'tp_education_post_type_date_link' ) && in_array( $post_type, $tp_education_post_type ) ) {
				$date_url = tp_education_post_type_date_link( $post_type, $year, $month );
			} else {
				$date_url = get_month_link( get_the_date( 'Y' ), get_the_date( 'm' ) );
			}
		}

		$posted_on = '<span class="screen-reader-text">Posted on</span><a href="' . esc_url( $date_url ) . '" rel="bookmark">' . $time_string . '</a>';

		$byline = sprintf(
			esc_html_x( 'Posted by %s', 'post author', 'graduate' ),
			'<span class="by-inline"><span class="screen-reader-text">Author</span><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		if ( function_exists('tp_education_like_button') )
			$likes = tp_education_like_button();
		else
			$likes = '';

		$comments = '<span class="comments-links">' 
	            . absint( get_comments_number( '0', '1', '%' ) ) .'<i class="fa fa-commenting-o"></i>
	      	</span><!--.comments-link-->';

		echo '<span class="byline">' . $byline . '</span><span class="posted-on"> ' . $posted_on . '</span><span class="likes"> ' . $likes . '</span>' . $comments; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'graduate_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function graduate_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'graduate' ) );
			if ( $categories_list && graduate_categorized_blog() ) {
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'graduate' ) . '</span>', $categories_list ); // WPCS: XSS OK.
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html__( ', ', 'graduate' ) );
			if ( $tags_list ) {
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'graduate' ) . '</span>', $tags_list ); // WPCS: XSS OK.
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			/* translators: %s: post title */
			comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'graduate' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				/* translators: %s: Name of current post */
				esc_html__( 'Edit %s', 'graduate' ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function graduate_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'graduate_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'graduate_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so graduate_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so graduate_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in graduate_categorized_blog.
 */
function graduate_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'graduate_categories' );
}
add_action( 'edit_category', 'graduate_category_transient_flusher' );
add_action( 'save_post',     'graduate_category_transient_flusher' );
