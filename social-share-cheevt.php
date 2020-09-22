<?php

/**
 * Plugin bootstrap file
 *
 * @social-share-cheevt
 * Plugin Name:       Social Share CheeVT
 * Plugin URI:        https://github.com/CheeVT/social-share
 * Description:       Share WordPress content to Social Networks
 * Version:           1.0.0
 * Author:            CheeVT
 * Author URI:        https://github.com/CheeVT
 * Text Domain:       social-share-cheevt
 * Domain Path:       /
 */

defined( 'ABSPATH' ) or die( 'Your system is shutting down here...' );

define( 'SOCIAL_SHARE_CHEEVT_PLUGIN', plugin_basename( __FILE__ ) );
define( 'SOCIAL_SHARE_CHEEVT_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );

function activateSocialShare()
{
	/*require_once SOCIAL_SHARE_CHEEVT_PLUGIN_PATH . 'includes/class-social-share-activator.php';
	SocialShareActivator::activate();*/
}
register_activation_hook( __FILE__, 'activateSocialShare' );

function settingsLink( $links ) 
{
  $settingsLink = '<a href="admin.php?page=social_share_cheevt">Settings</a>';
  array_push( $links, $settingsLink );
  return $links;
}
add_filter( 'plugin_action_links_' . SOCIAL_SHARE_CHEEVT_PLUGIN, 'settingsLink' );



require_once SOCIAL_SHARE_CHEEVT_PLUGIN_PATH . 'includes/class-social-share.php';

$pluginInit = new SocialShare();