<?php
/**
 * Press Post Type
 * created the custom post type
 * @author Chris Reynolds
 * @since 0.1
 * @link http://justintadlock.com/archives/2010/04/29/custom-post-types-in-wordpress
 * @uses register_post_type
 * @uses add_theme_support
 */
function post_type_press() {
    $labels = array(
		'name' => __('Press', 'presspage'),
		'singular_name' => __('Article', 'presspage'),
		'add_new' => __('Add New', 'presspage'),
		'add_new_item' => __('Add New Article','presspage'),
		'edit_item' => __('Edit Article','presspage'),
		'edit' => __('Edit', 'presspage'),
		'new_item' => __('New Article','presspage'),
		'view_item' => __('View Article','presspage'),
		'search_items' => __('Search Articles','presspage'),
		'not_found' =>  __('No articles found','presspage'),
		'not_found_in_trash' => __('No articles found in Trash','presspage'),
		'view' =>  __('View Article','presspage'),
		'parent_item_colon' => ''
  	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		//'supports' => array( 'title','editor','thumbnail' ),
		'supports' => array( 'title','thumbnail' ), // removes the_content, but can be put back in if you so desire...
		'exclude_from_search' => true,
		'menu_position' => 5,
  	);

  	register_post_type( 'ap_press', $args );

	// add post thumbnail support
	// note, thumbnail size should be defined in the theme's functions.php file like this:
	// set_post_thumbnail_size( 200, 200, true ); // 200 pixels wide by 200 pixels tall, hard crop mode
	add_theme_support( 'post-thumbnails' );
}
add_action( 'init', 'post_type_press', 0 );

/**
 * Press meta boxes
 * @author Chris Reynolds
 * @since 0.1
 * @uses add_meta_box
 * loads all the meta boxes in one place
 * adds additional meta information for presspage.
 */
function ap_press_metaboxes() {
	add_meta_box( "product-details", "Article Details", "ap_press_info_meta", "ap_press", "normal", "low" );
}
add_action( 'admin_menu', 'ap_press_metaboxes' );

/**
 * Product Meta
 * @author Chris Reynolds
 * @since 0.1
 * @uses wp_create_nonce
 * @uses get_post_meta
 * creates the actual meta fields on the product pages. All this stuff is optional but can be used for schema.org schemas
 */
function ap_press_info_meta() {
	global $post;

	echo '<input type="hidden" name="ap_noncename" id="ap_noncename" value="' .
	wp_create_nonce( wp_basename(__FILE__) ) . '" />';

	echo '<p><label for="url"><strong>Article URL</strong></label><br />';
	echo '<input class="widefat" type="text" name="url" value="' . get_post_meta( $post->ID, 'url', true ) . '" /><br />';
	echo '<em>URL to the article</em></p>';

/* removes periodical meta value, but can be added back in if you so desire. using post title for this instead
	echo '<p><label for="periodical"><strong>Periodical</strong></label><br />';
	echo '<input class="widefat" type="text" name="periodical" value="' . get_post_meta( $post->ID, 'periodical', true ) . '" /><br />';
	echo '<em>Name of the periodical the article was published in</em></p>';
*/
}

/**
 * Change default title
 * Changes the default title on press posts
 * @author Chris Reynolds
 * @since 0.1
 * @uses get_current_screen
 * @uses enter_title_here
 * @link http://wp-snippets.com/change-enter-title-here-text-for-custom-post-type/
 */
function ap_press_change_default_title( $title ){
     $screen = get_current_screen();
     if  ( 'ap_press' == $screen->post_type ) {
          $title = 'Enter periodical name here';
     }
     return $title;
}
add_filter( 'enter_title_here', 'ap_press_change_default_title' );

?>