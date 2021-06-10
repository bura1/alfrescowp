<?php

/*
Plugin Name: Alfresco WP
Description: Search Alfresco documents. Paste [alfresco-search] shortcode on page.
Version: 1.0
Author: TB
*/

/* Add CSS */
function add_awp_stylesheet() {
    wp_register_style( 'alfrescowp.css', plugin_dir_url( __FILE__ ) . 'alfrescowp.css', false, '1.0.0' );
    wp_enqueue_style( 'alfrescowp.css' );
}
add_action('wp_enqueue_scripts', 'add_awp_stylesheet');

// Add front page
include('public/frontpage-content.php');

?>
