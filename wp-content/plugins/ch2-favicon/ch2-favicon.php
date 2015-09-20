<?php

/*
Plugin Name:Chapter 2 – Favicon  .
Plugin URI:Declares a plugin that will be visible in the
Description:interface
WordPress admin
Version:1.0
Author:Yannick Lefebvre
Author URI:http://ylefebvre.ca
License:GPLv2
*/

add_action( 'wp_head', 'ch2fi_page_header_output' );

function ch2fi_page_header_output() {
$icon_url = plugins_url( 'favicon.ico', __FILE__ );
?>
    <link rel="shortcut icon" href="<?php echo $icon_url; ?>" />
<?php }