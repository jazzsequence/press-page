#Press Page

##Description

A WordPress plugin to display a custom post type for press features in a horizontal sliding scroll

This plugin uses the following GitHub project:  
[Smooth-Div-Scroll](https://github.com/tkahn/Smooth-Div-Scroll) by [tkahn](https://github.com/tkahn)

**[Demo](http://museumthemes.com/press-page/)**

##Usage
Plugin can be used out of the box with the `[presspage]` shortcode or the included `page-press.php` template. The shortcode includes two optional parameters, if left blank, default post thumbnail size will be used. The optional parameters are `width` and `height` and control the dimensions of the images used. If one is left blank, the same value will be used for both.

By default, the `presspage.css` file defines the width to be 930px and the height to be 255px. These can be changed in  your CSS by adding your height and width to the `#makeMeScrollable` ID.

###Examples
`[presspage]`

`[presspage width=200]`

`[presspage height=500]`

`[presspage width=200 height=500]`