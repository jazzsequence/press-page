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

Nothing here yet.

== Screenshots ==

Nothing to see here. You can see an example of the slider in action here: http://www.smoothdivscroll.com/index.html

== Changelog ==

= 0.1 =
* initial release