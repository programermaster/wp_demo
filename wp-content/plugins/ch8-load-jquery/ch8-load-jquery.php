<?php
/*
Plugin Name:Chapter – Chapter 8 – Load jQuery
Plugin URI:Declares a plugin that will be visible in the
Description:interface
WordPress admin
Version:1.0
Author:Yannick Lefebvre
Author URI:http://ylefebvre.ca
License:GPLv2
*/

//wp_enqueue_scripts for front-facing pages, admin_enqueue_scripts for administration pages, and login_enqueue_scripts for the login page
add_action( 'wp_enqueue_scripts', 'ch8lj_front_facing_pages' );
function ch8lj_front_facing_pages() {
    wp_enqueue_script( 'jquery' );
}