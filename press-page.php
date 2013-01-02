<?php
/*
Plugin Name: Press Page
git uri: https://github.com/jazzsequence/press-page
Plugin URI: http://www.museumthemes.com
Description: A WordPress plugin to display a custom post type for press features in a horizontal sliding scroll
Version: 0.1
Author: Arcane Palette Creative Design
Author URI: http://arcanepalette.com/
License: GPL3
*/

/*
    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    http://www.opensource.org/licenses/gpl-3.0.html
*/

/* 	let's define some global values we're going to use later
	we're going to assume you're using wp 2.6+ and not worry about defining WP_PLUGIN_URL */
	define('presspage_plugin_path', WP_PLUGIN_URL . '/press-page/');
	define('presspage_plugin_dir', WP_PLUGIN_DIR . '/press-page/');
	define('presspage_plugin_images', presspage_plugin_path . 'img/');
	define('presspage_plugin_js', presspage_plugin_path . 'js/');
	include_once( presspage_plugin_dir . 'inc/updater/updater.php' );
	include_once( presspage_plugin_dir . 'inc/post_type_press.php' );

/**
 * Register scripts
 * registers the javascript
 * @author Chris Reynolds
 * @since 0.1
 * @link http://scribu.net/wordpress/optimal-script-loading.html
 */
function presspage_register_scripts() {
	wp_register_script( 'kinetic', presspage_plugin_js . 'jquery.kinetic.js', array( 'jquery', 'jquery-ui' ), '1.5', true );
	wp_register_script( 'mousewheel', presspage_plugin_js . 'jquery.mousewheel.min.js', array( 'jquery', 'jquery-ui' ), '3.0.6', true );
	wp_register_script( 'smoothdivscroll', presspage_plugin_js . 'jquery.smoothdivscroll-1.3-min.js', array( 'kinetic', 'mousewheel', 'jquery', 'jquery-ui', 'jquery-ui-widget', '1.3', true ) );
}
add_action( 'init', 'presspage_register_scripts' );

/**
 * Press Page scripts
 * loads the javascript, but only on a page with the /press/ slug. This is hard-coded.
 * @author Chris Reynolds
 * @since 0.1
 * @link http://scribu.net/wordpress/optimal-script-loading.html
 */
function presspage_load_scripts() {
	if ( is_page('press') ) {
		wp_print_scripts( 'kinetic' );
		wp_print_scripts( 'mousewheel' );
		wp_print_scripts( 'smoothdivscroll' );
	}
}
add_action( 'wp_footer', 'presspage_load_scripts' );

/**
 * Insert post data
 * @author Chris Reynolds
 * @since 0.5.1
 * @link http://wordpress.stackexchange.com/a/7522
 * @uses update_post_meta
 * @uses wp_insert_post_data
 * stores post meta data for the custom post types
 */
function ap_press_insert_post_data($data,$postarr) {
	if ( $postarr['post_type'] == 'ap_press' ) {
		update_post_meta($postarr['ID'], 'url', $postarr['url']);
		update_post_meta($postarr['ID'], 'periodical', $postarr['periodical']);
	}
	return $data;
}
add_action('wp_insert_post_data','ap_press_insert_post_data',10,2);

/**
 * Save product postdata
 * deal with saving the post and meta
 * @author Chris Reynolds
 * @since 0.1
 * @uses wp_verify_nonce
 * @uses plugin_basename
 * @uses current_user_can
 * @uses save_post
 * @uses update_post_meta
 * @uses add_post_meta
 * @uses delete_post_meta
 */
function ap_press_save_press_postdata($post_id, $post) {
   	if ( !wp_verify_nonce( $_POST['ap_noncename'], plugin_basename(__FILE__) )) {
	return $post->ID;
	}

	/* confirm user is allowed to save page/post */
	if ( 'page' == $_POST['post_type'] ) {
		if ( !current_user_can( 'edit_page', $post->ID ))
		return $post->ID;
	} else {
		if ( !current_user_can( 'edit_post', $post->ID ))
		return $post->ID;
	}

	/* ready our data for storage */
	foreach ($_POST as $key => $value) {
        $mydata[$key] = $value;
    }

	/* Add values of $mydata as custom fields */
	foreach ($mydata as $key => $value) {
		if( $post->post_type == 'revision' ) return;
		//$value = implode(',', (array)$value);
		if(get_post_meta($post->ID, $key, FALSE)) {
			update_post_meta($post->ID, $key, $value);
		} else {
			add_post_meta($post->ID, $key, $value);
		}
		if(!$value) delete_post_meta($post->ID, $key);
	}
}

add_action('save_post', 'ap_press_save_press_postdata', 1, 2); // save the custom fields

/**
 * Press Page icons
 * deals with the custom icons for the product pages
 * @author Chris Reynolds
 * @since 0.1
 * @uses admin_head
 * blogs-stack icon by Yusuke Kamiyamane from the Fugue icon set
 * released under a CC 3.0 Attribution Unported License http://creativecommons.org/licenses/by/3.0/
 * @link http://p.yusukekamiyamane.com/
 */
function presspage_icons() {
    ?>
    <style type="text/css" media="screen">
        #menu-posts-ap_press .wp-menu-image {
            background: url(<?php echo presspage_plugin_images; ?>blogs-stack.png) no-repeat 6px -17px !important;
        }
		#menu-posts-ap_press:hover .wp-menu-image, #menu-posts-ap_press.wp-has-current-submenu .wp-menu-image {
			background: url(<?php echo presspage_plugin_images; ?>blogs-stack.png) no-repeat 6px 7px !important;
        }
		#icon-edit.icon32-posts-ap_press { background: url(<?php echo presspage_plugin_images; ?>press-icon.png) no-repeat!important; }
    </style>
<?php
}
add_action( 'admin_head', 'presspage_icons' );

?>