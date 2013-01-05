=== Press Page ===
Contributors: jazzs3quence
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=AWM2TG3D4HYQ6
Tags: smoothdivscroll, press, slider, shortcode
Requires at least: 3.4
Tested up to: 3.5
Stable tag: 0.1
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl-3.0.html

A WordPress plugin to display a custom post type for press features in a horizontal sliding scroll

== Description ==

A WordPress plugin to display a custom post type for press features in a horizontal sliding scroll

This plugin uses the following GitHub project:  
[Smooth-Div-Scroll](https://github.com/tkahn/Smooth-Div-Scroll) by [tkahn](https://github.com/tkahn)

**[Demo](http://museumthemes.com/press-page/)**

= Usage =
Plugin can be used out of the box with the `[presspage]` shortcode or the included `page-press.php` template. The shortcode includes two optional parameters, if left blank, default post thumbnail size will be used. The optional parameters are `width` and `height` and control the dimensions of the images used. If one is left blank, the same value will be used for both.

By default, the `presspage.css` file defines the width to be 930px and the height to be 255px. These can be changed in  your CSS by adding your height and width to the `#makeMeScrollable` ID.

= Examples =
`[presspage]`

`[presspage width=200]`

`[presspage height=500]`

`[presspage width=200 height=500]`

== Installation ==

1. Upload `press-page.zip` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Use the `[presspage]` shortcode or the included template file example in your theme.

== Frequently Asked Questions ==

= What can I use this for besides press? =
Anything you can think of. If you're a musician, you can use it for a scrolling discography, with links to Bandcamp or iTunes. You can use it as a photo gallery and link to full-size images. There are probably a lot of uses I'm not thinking of. There weren't any other WordPress plugins using this SmoothDivScroll javascript, but there are tons of ways to use it.

= I'd like to change the styling. Is that possible? =

Yes. You'll need to edit your CSS either in your theme, in a [Child Theme](http://codex.wordpress.org/Child_Themes), or through some CSS editor in your dashboard via a plugin like [Jetpack](http://wordpress.org/extend/plugins/jetpack/) or [My Custom CSS](http://wordpress.org/extend/plugins/my-custom-css/).

Here's the default CSS that is used by the plugin:

`
	#makeMeScrollable div.scrollableArea section {
		position: relative;
		display: block;
		float: left;
		margin: 0;
		padding: 0;
		/* If you don't want the images in the scroller to be selectable, try the following block of code. It's just a nice feature that prevent the images from accidentally becoming selected/inverted when the user interacts with the scroller. */
		-webkit-user-select: none;
		-khtml-user-select: none;
		-moz-user-select: none;
		-o-user-select: none;
		user-select: none;
	}
	#makeMeScrollable {
		width: 930px;
		height: 255px;
		position: relative;
	}
	.scrollWrapper {
		width: 100%;
		height: 100%;
		overflow: hidden;
	}
	.scrollableArea {
		position: relative;
		height: 100%;
	}
	/* Invisible left hotspot */
	div.scrollingHotSpotLeft
	{
		/* The hotspots have a minimum width of 100 pixels and if there is room the will grow and occupy 15% of the scrollable area (30% combined). Adjust it to your own taste. */
		min-width: 75px;
		width: 10%;
		height: 100%;
		position: absolute;
		z-index: 200;
		left: 0;
		/*  The first url is for Firefox and other browsers, the second is for Internet Explorer */
		cursor: w-resize;
	}
	
	/* Visible left hotspot */
	div.scrollingHotSpotLeftVisible
	{
		background-color: #fff;
		opacity: 0.35; /* Standard CSS3 opacity setting */
		-moz-opacity: 0.35; /* Opacity for really old versions of Mozilla Firefox (0.9 or older) */
		filter: alpha(opacity = 35); /* Opacity for Internet Explorer. */
		zoom: 1; /* Trigger "hasLayout" in Internet Explorer 6 or older versions */
	}
	
	/* Invisible right hotspot */
	div.scrollingHotSpotRight
	{
		min-width: 75px;
		width: 10%;
		height: 100%;
		position: absolute;
		z-index: 200;
		right: 0;
		cursor: e-resize;
	}
	
	/* Visible right hotspot */
	div.scrollingHotSpotRightVisible
	{
		background-color: #fff;
		opacity: 0.35;
		filter: alpha(opacity = 35);
		-moz-opacity: 0.35;
		zoom: 1;
	}
`

== Screenshots ==

1. Press post menu

2. Add new article page

You can see an example of the slider in action here: http://www.museumthemes.com/press-page/

== Changelog ==

= 0.1 =
* initial release