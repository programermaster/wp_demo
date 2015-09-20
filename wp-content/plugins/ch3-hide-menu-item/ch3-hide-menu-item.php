<?php
/*
Plugin Name:Chapter 3 – Hide menu item  .
Plugin URI:Declares a plugin that will be visible in the
Description:interface
WordPress admin
Version:1.0
Author:Yannick Lefebvre
Author URI:http://ylefebvre.ca
License:GPLv2
*/
add_action( 'admin_menu', 'ch3hmi_hide_menu_item' );
function ch3hmi_hide_menu_item() {
    //remove users menu item
   //remove_menu_page( 'users.php' );

    remove_submenu_page( 'options-general.php',        'options-permalink.php' );
}