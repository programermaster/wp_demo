<?php
/*
Plugin Name:Chapter 3 – Individual options  .
Plugin URI:Declares a plugin that will be visible in the
Description:interface
WordPress admin
Version:1.0
Author:Yannick Lefebvre
Author URI:http://ylefebvre.ca
License:GPLv2
*/
register_activation_hook( __FILE__, 'ch3io_set_default_options' );

function ch3io_set_default_options() {
if ( get_option( 'ch3io_version' ) === false ) {
    add_option( 'ch3io_ga_account_name', 'UA-000000-0' );
    add_option( 'ch3io_track_outgoing_links', 'false' );
    add_option( 'ch3io_version', '1.1' );
} elseif ( get_option( 'ch3io_version' ) < 1.1 ) {
    add_option( 'ch3io_track_outgoing_links', 'false' );
    update_option( 'ch3io_version', '1.1' );
}
}

register_deactivation_hook( __FILE__, 'ch3io_unset_default_options' );
function ch3io_unset_default_options() {
    if ( get_option( 'ch3io_version' ) === false ) {
        delete_option( 'ch3io_ga_account_name', 'UA-000000-0' );
        delete_option( 'ch3io_track_outgoing_links', 'false' );
        delete_option( 'ch3io_version', '1.1' );
    }
}