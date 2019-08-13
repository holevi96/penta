<?php
/**
Plugin Name: Lists Shortcode And Widgets
Plugin URI: http://OTWthemes.com
Description:  Create Lists. Nice and easy interface. Insert anywhere in your site - page/post editor, sidebars, template files.
Author: OTWthemes.com
Version: 1.5

Author URI: http://themeforest.net/user/OTWthemes
*/

load_plugin_textdomain('otw_lssw',false,dirname(plugin_basename(__FILE__)) . '/languages/');

load_plugin_textdomain('otw-shortcode-widget',false,dirname(plugin_basename(__FILE__)) . '/languages/');

$wp_lssw_tmc_items = array(
	'page'              => array( array(), __( 'Pages', 'otw_lssw' ) ),
	'post'              => array( array(), __( 'Posts', 'otw_lssw' ) ),
	'tanfolyamok'              => array( array(), __( 'Tanfolyamok', 'otw_lssw' ) )
);

$wp_lssw_agm_items = array(
	'page'              => array( array(), __( 'Pages', 'otw_lssw' ) ),
	'post'              => array( array(), __( 'Posts', 'otw_lssw' ) ),
	'tanfolyamok'              => array( array(), __( 'Tanfolyamok', 'otw_lssw' ) )
);

$wp_lssw_cs_items = array(
	'page'              => array( array(), __( 'Pages', 'otw_lssw' ) ),
	'post'              => array( array(), __( 'Posts', 'otw_lssw' ) ),
	'tanfolyamok'              => array( array(), __( 'Tanfolyamok', 'otw_lssw' ) )
);

$otw_lssw_plugin_url = plugin_dir_url( __FILE__);
$otw_lssw_css_version = '1.8';
$otw_lssw_js_version = '1.8';

$otw_lssw_plugin_options = get_option( 'otw_lssw_plugin_options' );

//include functons
require_once( plugin_dir_path( __FILE__ ).'/include/otw_lssw_functions.php' );

//otw components
$otw_lssw_shortcode_component = false;
$otw_lssw_form_component = false;
$otw_lssw_validator_component = false;

//load core component functions
@include_once( 'include/otw_components/otw_functions/otw_functions.php' );

if( !function_exists( 'otw_register_component' ) ){
	wp_die( 'Please include otw components' );
}

//register form component
otw_register_component( 'otw_form', dirname( __FILE__ ).'/include/otw_components/otw_form/', $otw_lssw_plugin_url.'/include/otw_components/otw_form/' );

//register validator component
otw_register_component( 'otw_validator', dirname( __FILE__ ).'/include/otw_components/otw_validator/', $otw_lssw_plugin_url.'/include/otw_components/otw_validator/' );

//register shortcode component
otw_register_component( 'otw_shortcode', dirname( __FILE__ ).'/include/otw_components/otw_shortcode/', $otw_lssw_plugin_url.'/include/otw_components/otw_shortcode/' );

/** 
 *call init plugin function
 */
add_action('init', 'otw_lssw_init' );
add_action('widgets_init', 'otw_lssw_widgets_init' );

?>