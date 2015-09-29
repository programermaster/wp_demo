<?php
/*
Plugin Name:Chapter – Chapter 8 – Pop up dialog
Plugin URI:Declares a plugin that will be visible in the
Description:interface
WordPress admin
Version:1.0
Author:Yannick Lefebvre
Author URI:http://ylefebvre.ca
License:GPLv2
*/

    add_action( 'wp_enqueue_scripts', 'ch8pud_load_scripts' );
    add_action( 'wp_footer', 'ch8pud_footer_code' );

global $load_scripts;
//second exec
function ch8pud_load_scripts() {
    global $load_scripts;
    if ( $load_scripts ) {
        wp_enqueue_script('jquery');
        add_thickbox();
    }
}

//third exec
function ch8pud_footer_code() {
// Only load scripts if keyword is found on page
    global $load_scripts;
    echo "test1";
    if ( $load_scripts ) { ?>
        <script type="text/javascript">
            jQuery( document ).ready( function() {
                setTimeout(
                    function(){
                        tb_show( 'Pop-Up Message',
                            '<?php echo plugins_url('content.html?width=420&height=220',__FILE__ )?>', null );
                    }, 2000 );
            });
        </script>
    <?php }

}

//first exec
add_filter( 'the_posts', 'ch8pud_conditionally_add_scripts_and_styles' );
function ch8pud_conditionally_add_scripts_and_styles( $posts ) {

// Exit function immediately if no posts are present
    if ( empty( $posts ) ) return $posts;
// Global variable to indicate if scripts should be loaded
    global $load_scripts;


    if(isset($load_scripts) && $load_scripts==true) return $posts;
    $load_scripts = false;

// Cycle through posts and set flag true if
// keyword is found
    foreach ( $posts as $post ) {
        $shortcode_pos = stripos( $post->post_content, '[popup]', 0 );
        if ( $shortcode_pos !== false ) {
            $load_scripts = true;
            return $posts;
        }

    }
// Return posts array unchanged
    return $posts;
}

add_shortcode( 'popup', 'ch8pud_popup_shortcode' );
function ch8PUD_popup_shortcode() {
    return;
}