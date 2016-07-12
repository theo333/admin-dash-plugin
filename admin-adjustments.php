<?php
error_reporting(E_ALL);
/*
 * Plugin Name: Admin Dashboard Adjustments
 * Plugin URI: http://theo333.com/
 * Description: Displays "Hello World!" on Admin Dashboard, plus other changes.
 * Version 1.0
 * Author: Theo Manton
 * Author URI: 
 * License: GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: admin-adjustments
 */

/* !0. TABLE OF CONTENTS */

/*  1. HOOKS
 *      
 *  2. SHORTCODES
 *      
 *  3. FILTERS
 *  4. EXTERNAL SCRIPTS
 *  5. ACTIONS
 *  6. HELPERS
 *  7. CUSTOM POST TYPES
 *  8. ADMIN PAGES
 *  9. SETTINGS
 *  
 */

// secure plugin - make sure don't expose any info if called directly (taken from Akismet plugin)
if( !function_exists( 'add_action') ) {
    echo 'Not Allowed';
    exit();
}

/* OR to secure plugin, should I use this line?
 * (found at: https://codex.wordpress.org/Writing_a_Plugin#License)
 * defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
 */

add_action( 'wp_dashboard_setup', 'tts_register_hello_world_widget' );
function tts_register_hello_world_widget() {
	wp_add_dashboard_widget(
		'hello_world_widget',
		__( 'Hello World Widget ' ),
		'tts_hello_world_widget_display'
	);
    wp_add_dashboard_widget(
		'tts_my_dashboard_widget2',
		__( 'My Dashboard Widget 2 '),
		'tts_my_dashboard_widget_display2'
	);

}

function tts_hello_world_widget_display() {
    echo __( 'Hello World!' ) .'<br/><br/>' . '<strong>' . __( 'Today\'s date is:  ' ) . date('m\/d\/y') . '</strong>';
}

function tts_my_dashboard_widget_display2() {
    _e ( 'Cool, this really works!' );
}


// add recent drafts dashboard widget
//function tts_add_recent_drafts_dash_widget() {
//    add_meta_box(
//        'my_dashboard_recent_drafts',
//        'Recent Drafts',
//        'dashboard_recent_drafts',
//        'dashboard',
//        'normal'
//    );   
//}
//add_action( 'wp_dashboard_setup', 'tts_add_recent_drafts_dash_widget' );


// add recent drafts dashboard widget
//function tts_add_recent_drafts_dash_widget2() {
//    wp_add_dashboard_widget(
//        'dashboard_recent_drafts2',
//        __( 'dashboard' ),
//        'normal'
//    );   
//}
//add_action( 'wp_dashboard_setup', 'tts_add_recent_drafts_dash_widget2' );



// remove WP News widget from dashboard
function tts_remove_dashboard_widget() {
    remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
}
add_action( 'wp_dashboard_setup', 'tts_remove_dashboard_widget' );

// add link to Google Analytics in top admin bar
// ref: https://codex.wordpress.org/Function_Reference/add_menu
function tts_add_google_analytics_link () {
    global $wp_admin_bar;
    //var_dump($wp_admin_bar);
    $wp_admin_bar->add_menu( array(
        'id'    => 'google_analytics',
        'title' => 'Google Analytics',
        'href'  => 'http://google.com/analytics'
    ) );
    
}
add_action('wp_before_admin_bar_render', 'tts_add_google_analytics_link');

//=================
// Move the 'Right Now' dashboard widget to the right hand side
function wptutsplus_move_dashboard_widget() {
        global $wp_meta_boxes;
        $widget = $wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now'];
        unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now'] );
        $wp_meta_boxes['dashboard']['side']['core']['dashboard_right_now'] = $widget;
}
add_action( 'wp_dashboard_setup', 'wptutsplus_move_dashboard_widget' );


/* !1. HOOKS */


/* !2. SHORTCODES */

