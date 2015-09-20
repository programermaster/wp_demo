<?php
/*
Plugin Name:Chapter 3 – Multi-Level Menu
Plugin URI:Declares a plugin that will be visible in the
Description:interface
WordPress admin
Version:1.0
Author:Yannick Lefebvre
Author URI:http://ylefebvre.ca
License:GPLv2
*/
add_action( 'admin_menu', 'ch3mlm_admin_menu' );

function ch3mlm_admin_menu()
{
   // add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
// Create top-level menu item
    add_menu_page('My Complex Plugin Configuration Page',
        'My Complex Plugin', 'manage_options',
        'ch3mlm-main-menu', 'ch3mlm_my_complex_main',
        plugins_url('myplugin.png', __FILE__));

   // add_submenu_page( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function );
    // Create a sub-menu under the top-level menu
    add_submenu_page('ch3mlm-main-menu',
        'My Complex Menu Sub-Config Page', 'Sub-Config Page',
        'manage_options', 'ch3mlm-sub-menu',
        'ch3mlm_my_complex_submenu');
}