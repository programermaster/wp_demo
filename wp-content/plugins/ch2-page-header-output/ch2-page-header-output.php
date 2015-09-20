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

global $options_page;

//page header
add_action( 'wp_head', 'ch2pho_page_header_output' );

//add_filter( 'the_content', 'ch2lfa_link_filter_analytics' );

//add_action( 'wp_footer', 'ch2lfa_footer_analytics_code' );

function ch2lfa_link_filter_analytics ( $the_content ) {
    $new_content = str_replace( "href",
        "onClick=\"recordOutboundLink(this, 'Outbound Links', '" .
        home_url() . "' );return false;\" href", $the_content );
    return $new_content;
}

function ch2pho_page_header_output() {
    //$options = get_option( 'ch2pho_options' );
    $options = get_option( 'ch3sapi_options' );

    if ( isset($options['track_outgoing_links']) && $options['track_outgoing_links']==1 ) {
        add_filter( 'the_content','ch2lfa_link_filter_analytics' );
    }

    if ( isset($options['track_outgoing_links']) && $options['track_outgoing_links']==1) {
        add_action( 'wp_footer', 'ch2lfa_footer_analytics_code' );
    }

    ?>

<script type="text/javascript">
var gaJsHost = ( ( "https:" == document.location.protocol ) ?
    "https://ssl." : "http://www." );
document.write( unescape( "%3Cscript src='" + gaJsHost +
    "google-analytics.com/ga.js' \n\
type='text/javascript'%3E%3C/script%3E" ) );
</script>

<script type="text/javascript">
try {
    var pageTracker = _gat._getTracker( "<?php echo $options['ga_account_name']; ?>");
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
<?php }


register_activation_hook( __FILE__,'ch2pho_set_default_options_array' );
function ch2pho_set_default_options_array()
{
    if (get_option('ch2pho_options') === false) {
        $new_options['ga_account_name'] = "UA-000000-0";
        $new_options['track_outgoing_links'] = false;
        $new_options['version'] = "1.1";
        add_option('ch2pho_options', $new_options);
    } else {
        $existing_options = get_option( 'ch2pho_options' );
        if ( $existing_options['version'] < 1.1 ) {
            $existing_options['track_outgoing_links'] = false;
            $existing_options['version'] = "1.1";
            update_option( 'ch2pho_options', $existing_options );
        }
    }
}


add_action( 'admin_menu', 'ch2pho_settings_menu',1 );
function ch2pho_settings_menu() {
    //add_options_page( $page_title, $menu_title, $capability, $menu_slug, $function );
    $options_page = add_options_page( 'My Google Analytics Configuration',
        'My Google Analytics', 'manage_options',
        'ch2pho-my-google-analytics', 'ch2pho_config_page' );

    if ( $options_page )
        add_action( 'load-' . $options_page, 'ch2pho_help_tabs' );
}

/*function ch2pho_config_page() {
// Retrieve plugin configuration options from database
    $options = get_option( 'ch2pho_options' );

    ?>
    <div id="ch2pho-general" class="wrap">
        <h2>My Google Analytics</h2>

        <?php if ( isset( $_GET['message'] )
            && $_GET['message'] == '1' ) { ?>
            <div id='message' class='updated fade'><p><strong>Settings
                        Saved</strong></p></div>
        <?php } ?>

        <form method="post" action="admin-post.php">
            <input type="hidden" name="action"
                   value="save_ch2pho_options" />
            <!-- Adding security through hidden referrer field -->
            <?php wp_nonce_field( 'ch2pho' ); ?>
            Account Name: <input type="text" name="ga_account_name"
                                 value="<?php echo esc_html( $options['ga_account_name'] );
                                 ?>"/><br />
            Track Outgoing Links: <input type="checkbox"
                                         name="track_outgoing_links" <?php if ($options['track_outgoing_links'] ) echo ' checked="checked" ';
            ?>/><br />
            <input type="submit" value="Submit" class="button-primary"/>
        </form>
    </div>
<?php }*/

function ch2pho_config_page() {
    // Retrieve plugin configuration options from database
    $options = get_option( 'ch2pho_options' );
    global $options_page;
    ?>
    <div id="ch2pho-general" class="wrap">
        <h2>My Google Analytics</h2>

        <?php if (isset( $_GET['message'] ) && $_GET['message'] == '1') { ?>
        <div id='message' class='updated fade'>    <p><strong>Settings Saved</strong></p>    </div>
        <?php } ?>

        <form action="admin-post.php" method="post">
            <input type="hidden" name="action"  value="save_ch2pho_options" />
            <!-- Adding security through hidden referrer field -->
            <?php wp_nonce_field( 'ch2pho' ); ?>
            <!-- Security fields for meta box save processing -->
                <?php wp_nonce_field( 'closedpostboxes', 'closedpostboxesnonce', false ); ?>
                <?php wp_nonce_field( 'meta-box-order', 'meta-box-order-nonce', false ); ?>
                <div id="poststuff" class="metabox-holder">
                    <div id="post-body">
                        <div id="post-body-content">
                            <?php do_meta_boxes( $options_page, 'normal', $options) ;
                            ?>
                            <input type="submit" value="Submit" class="button-primary"/>
                        </div>
                    </div>
                    <br class="clear"/>
                </div>
        </form>
    </div>
    <script type="text/javascript">
        //<![CDATA[
        jQuery( document ).ready( function( $ ) {
// close postboxes that should be closed
            $( '.if-js-closed' ) .removeClass( 'if-js-closed' ).addClass( 'closed' );
// postboxes setup
            postboxes.add_postbox_toggles( '<?php echo $options_page; ?>' );
        });
        //]]>
    </script>
<?php }

add_action( 'admin_init', 'ch2pho_admin_init' );
function ch2pho_admin_init() {
    //admin_post.php check action from post ; action = save_ch2pho_options
    add_action( 'admin_post_save_ch2pho_options', 'process_ch2pho_options' );
}

function process_ch2pho_options()
{
// Check that user has proper security level
    if (!current_user_can('manage_options'))
        wp_die('Not allowed');

// Check that nonce field created in configuration form// is present
    check_admin_referer('ch2pho');

// Retrieve original plugin options array
    $options = get_option('ch2pho_options');
// Cycle through all text form fields and store their values
// in the options array
    foreach (array('ga_account_name') as $option_name) {
        if (isset($_POST[$option_name])) {
            $options[$option_name] =
                sanitize_text_field($_POST[$option_name]);
        }
    }
// Cycle through all check box form fields and set the options
// array to true or false values based on presence of
// variables
    foreach (array('track_outgoing_links') as $option_name) {
        if (isset($_POST[$option_name])) {
            $options[$option_name] = true;
        } else {
            $options[$option_name] = false;
        }
    }

    // Store updated options array to database
    update_option('ch2pho_options', $options);
    // Redirect the page to the configuration form that was processed
    wp_redirect( add_query_arg(
        array( 'page' => 'ch2pho-my-google-analytics',
            'message' => '1' ),
        admin_url( 'options-general.php' ) ) );
    exit;

}

function ch2pho_help_tabs()
{
    global $options_page;

    $screen = get_current_screen();
    $screen->add_help_tab(array(
        'id' => 'ch2pho-plugin-help-instructions',
        'title' => 'Instructions',
        'callback' => 'ch2pho_plugin_help_instructions'
    ));
    $screen->add_help_tab(array(
        'id' => 'ch2pho-plugin-help-faq',
        'title' => 'FAQ',
        'callback' => 'ch2pho_plugin_help_faq',
    ));

    $screen->set_help_sidebar( '<p>This is the sidebar content</p>' );

   // add_meta_box( $id, $title, $callback, $page, $context, $priority,        $callback_args );
    add_meta_box('ch2pho_general_meta_box',  'General Settings', 'ch2pho_plugin_meta_box',    $options_page, 'normal', 'core');

    add_meta_box('ch2pho_second_meta_box', 'Second Settings Section', 'ch2pho_second_meta_box',    $options_page, 'normal', 'core');
}

function ch2pho_plugin_help_instructions() { ?>
    <p>These are instructions explaining how to use this
        plugin.</p>
<?php }

function ch2pho_plugin_help_faq() { ?>
    <p>These are the most frequently asked questions on the use of
        this plugin.</p>
<?php }


//add_action( 'admin_enqueue_scripts', 'ch2pho_load_admin_scripts' );
add_action( 'init', 'ch2pho_load_admin_scripts' );
function ch2pho_load_admin_scripts() {
    global $current_screen;
    global $options_page;
    if ( $current_screen->id == $options_page ) {
        wp_enqueue_script( 'common' );
        wp_enqueue_script( 'wp-lists' );
        wp_enqueue_script( 'postbox' );
    }
}

function ch2pho_plugin_meta_box( $options ) { ?>
Account Name: <input type="text" name="ga_account_name"
                     value="<?php echo esc_html( $options['ga_account_name'] );
                     ?>"/><br />
    Track Outgoing Links <input type="checkbox"
                                name="track_outgoing_links" <?php if (
    $options['track_outgoing_links'] ) echo 'checked="checked" ';
    ?>/><br />
<?php }

function ch2pho_second_meta_box($options) { ?>
    <p>This is the content of the second metabox.</p>
<?php }
