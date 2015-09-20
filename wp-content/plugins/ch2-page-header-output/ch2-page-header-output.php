<?php

/*
Plugin Name:Chapter 2 – Page Header Output
Plugin URI:Declares a plugin that will be visible in the
Description:interface
WordPress admin
Version:1.0
Author:Yannick Lefebvre
Author URI:http://ylefebvre.ca
License:GPLv2
*/

//page header
add_action( 'wp_head', 'ch2pho_page_header_output' );

add_filter( 'the_content', 'ch2lfa_link_filter_analytics' );

add_action( 'wp_footer', 'ch2lfa_footer_analytics_code' );

function ch2lfa_link_filter_analytics ( $the_content ) {
    $new_content = str_replace( "href",
        "onClick=\"recordOutboundLink(this, 'Outbound Links', '" .
        home_url() . "' );return false;\" href", $the_content );
    return $new_content;
}

function ch2pho_page_header_output() { ?>

<script type="text/javascript">
var gaJsHost = ( ( "https:" == document.location.protocol ) ?
    "https://ssl." : "http://www." );
document.write( unescape( "%3Cscript src='" + gaJsHost +
    "google-analytics.com/ga.js' \n\
type='text/javascript'%3E%3C/script%3E" ) );
</script>

<script type="text/javascript">
try {
    var pageTracker = _gat._getTracker( "UA-xxxxxx-x" );
    pageTracker._trackPageview();
} catch( err ) {}
</script>

<?php }

function ch2lfa_footer_analytics_code() { ?>
<script type="text/javascript">
    function recordOutboundLink( link, category, action ) {
        _gat._getTrackerByName()._trackEvent( category, action );
        setTimeout( 'document.location = "' + link.href + '"', 100 );
    }
</script>
<?php } ?>