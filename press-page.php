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
 * Press Page scripts
 * loads the javascript, but only on a page with the /press/ slug. This is hard-coded.
 * @author Chris Reynolds
 * @since 0.1
 */
function presspage_load_scripts() {
	wp_register_script( 'kinetic', presspage_plugin_js . 'jquery.kinetic.js', array( 'jquery', 'jquery-ui' ), '1.5' );
	wp_register_script( 'mousewheel', presspage_plugin_js . 'jquery.mousewheel.min.js', array( 'jquery', 'jquery-ui' ), '3.0.6' );
	wp_register_script( 'smoothdivscroll', presspage_plugin_js . 'jquery.smoothdivscroll-1.3-min.js', array( 'kinetic', 'mousewheel', 'jquery', 'jquery-ui', 'jquery-ui-widget', '1.3' ) );
	if ( !is_admin() /*&& is_page('press')*/ ) {
		wp_enqueue_script( 'kinetic' );
		wp_enqueue_script( 'mousewheel' );
		wp_enqueue_script( 'smoothdivscroll' );
	}
}
add_action( 'wp_print_scripts', 'presspage_load_scripts' );

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