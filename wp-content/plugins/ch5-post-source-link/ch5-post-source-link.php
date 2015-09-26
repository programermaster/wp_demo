<?php
/*
Plugin Name:Chapter 5 – Post Source Link .
Plugin URI:Declares a plugin that will be visible in the
Description:interface
WordPress admin
Version:1.0
Author:Yannick Lefebvre
Author URI:http://ylefebvre.ca
License:GPLv2
*/

add_action( 'add_meta_boxes', 'ch5_psl_register_meta_box' );
function ch5_psl_register_meta_box() {
   // add_meta_box( 'ch5_psl_source_meta_box', 'Post/Page Source', 'ch5_psl_source_meta_box', 'post', 'normal');
    //add_meta_box( 'ch5_psl_source_meta_box', 'Post/Page Source', 'ch5_psl_source_meta_box', 'page', 'normal');

    $post_types = get_post_types( array(), 'objects' );
    foreach ( $post_types as $post_type ) {
        add_meta_box( 'ch5_psl_post_source_meta_box', 'Post/Page Source', 'ch5_psl_source_meta_box', $post_type->name, 'normal' );
    }
}

function ch5_psl_source_meta_box( $post ) {
// Retrieve current source name and address based on post ID
    $post_source_name = esc_html( get_post_meta( $post->ID, 'post_source_name', true ) );
    $post_source_address = esc_html( get_post_meta( $post->ID, 'post_source_address', true ) );
    ?>
    <!-- Display fields to enter source name and address -->
    <table>
        <tr>
            <td style="width: 100px">Source Name</td>
            <td>
                <input type="text" size="40" name="post_source_name" value="<?php echo $post_source_name; ?>" />
            </td>
        </tr>
        <tr>
            <td>Source Address</td>
            <td>
                <input type="text" size="40" name="post_source_address" value="<?php echo $post_source_address; ?>" />
            </td>
        </tr>
    </table>
<?php }

add_action( 'save_post', 'ch5_psl_save_source_data', 10, 2 );
function ch5_psl_save_source_data( $post_id = false, $post = false ) {
// Check post type for posts or pages
    if ( $post->post_type == 'post' || $post->post_type == 'page' ) {
// Store data in post meta table if present in post data
        if ( !empty( $_POST['post_source_name'] ) ) update_post_meta( $post_id, 'post_source_name', $_POST['post_source_name'] );
        if ( !empty( $_POST['post_source_address'] ) ) update_post_meta( $post_id, 'post_source_address', $_POST['post_source_address'] );
    }
}

function ch5_psl_display_source_link ( $before_link = '',$source_intro_text = '',$after_link = '', $post_id = '' ) {

    $post_id = ( !empty( $post_id ) ? $post_id : get_the_ID() );
    $before_link = ( !empty( $before_link ) ? $before_link :'<div class="PostSource">' );
    $source_intro_text = ( !empty( $source_intro_text ) ? $source_intro_text : '<strong>Source:</strong> ' );
    $after_link = ( !empty( $after_link ) ? $after_link : '</div>' );
// Retrieve current source name and address based on post ID
    $post_source_name = get_post_meta( $post_id, 'post_source_name', true );
    $post_source_address = get_post_meta( $post_id, 'post_source_address', true );
// Output information to browser
    if ( !empty( $post_source_name ) && !empty( $post_source_address ) ) {
        echo $before_link;
        echo $source_intro_text;
        echo '<a href="' . esc_url( $post_source_address );
        echo '">' . $post_source_name;
        echo '</a>' . $after_link;
    }
}