<?php
/*
Plugin Name: Mos Tcpalitigatorlist
Description: This plugin will check number
Version: 0.0.1
Author: Md. Mostak Shahid
*/


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// Define MOS_TCPALITIGATORLIST_FILE.
if ( ! defined( 'MOS_TCPALITIGATORLIST_FILE' ) ) {
	define( 'MOS_TCPALITIGATORLIST_FILE', __FILE__ );
}
// Define MOS_TCPALITIGATORLIST_SETTINGS.
if ( ! defined( 'MOS_TCPALITIGATORLIST_SETTINGS' ) ) {
  //define( 'MOS_TCPALITIGATORLIST_SETTINGS', admin_url('/edit.php?post_type=post_type&page=plugin_settings') );
	define( 'MOS_TCPALITIGATORLIST_SETTINGS', admin_url('/options-general.php?page=mos_tcpalitigatorlist_settings') );
}
$mos_tcpalitigatorlist_options = get_option( 'mos_tcpalitigatorlist_options' );
$plugin = plugin_basename(MOS_TCPALITIGATORLIST_FILE); 
require_once ( plugin_dir_path( MOS_TCPALITIGATORLIST_FILE ) . 'mos-tcpalitigatorlist-functions.php' );
require_once ( plugin_dir_path( MOS_TCPALITIGATORLIST_FILE ) . 'mos-tcpalitigatorlist-settings.php' );
require_once ( plugin_dir_path( MOS_TCPALITIGATORLIST_FILE ) . 'mos-tcpalitigatorlist-shortcodes.php' );
require_once ( plugin_dir_path( MOS_TCPALITIGATORLIST_FILE ) . 'mos-tcpalitigatorlist-hooks.php' );
//require_once ( plugin_dir_path( MOS_TCPALITIGATORLIST_FILE ) . 'custom-settings.php' );

require_once('plugins/update/plugin-update-checker.php');
$pluginInit = Puc_v4_Factory::buildUpdateChecker(
	'https://raw.githubusercontent.com/mostak-shahid/update/master/mos-tcpalitigatorlist.json',
	MOS_TCPALITIGATORLIST_FILE,
	'mos-tcpalitigatorlist'
);


register_activation_hook(MOS_TCPALITIGATORLIST_FILE, 'mos_tcpalitigatorlist_activate');
add_action('admin_init', 'mos_tcpalitigatorlist_redirect');
 
function mos_tcpalitigatorlist_activate() {
    $mos_tcpalitigatorlist_option = array();
    // $mos_tcpalitigatorlist_option['mos_login_type'] = 'basic';
    // update_option( 'mos_tcpalitigatorlist_option', $mos_tcpalitigatorlist_option, false );
    add_option('mos_tcpalitigatorlist_do_activation_redirect', true);
}
 
function mos_tcpalitigatorlist_redirect() {
    if (get_option('mos_tcpalitigatorlist_do_activation_redirect', false)) {
        delete_option('mos_tcpalitigatorlist_do_activation_redirect');
        if(!isset($_GET['activate-multi'])){
            wp_safe_redirect(MOS_TCPALITIGATORLIST_SETTINGS);
        }
    }
}

// Add settings link on plugin page
function mos_tcpalitigatorlist_settings_link($links) { 
  $settings_link = '<a href="'.MOS_TCPALITIGATORLIST_SETTINGS.'">Settings</a>'; 
  array_unshift($links, $settings_link); 
  return $links; 
} 
add_filter("plugin_action_links_$plugin", 'mos_tcpalitigatorlist_settings_link' );



