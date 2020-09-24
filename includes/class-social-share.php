<?php

defined( 'ABSPATH' ) or die( 'Your system is shutting down here...' );

require_once SOCIAL_SHARE_CHEEVT_PLUGIN_PATH . 'admin/class-social-share-admin.php';
require_once SOCIAL_SHARE_CHEEVT_PLUGIN_PATH . 'public/class-social-share-public.php';

class SocialShare
{
  public $socialNetworks = [ 'facebook', 'twitter', 'linkedin', 'pinterest', 'whatsapp' ];

  public function __construct()
  {
    new SocialShareAdmin($this->socialNetworks);
    new SocialSharePublic();

    register_setting( 'social_share_cheevt', 'social_share_settings', array( $this, 'validate_options' ) );
    
    $this->setDefaultSettings();
  }

  protected function setDefaultSettings()
  {
    add_option('social_share_settings', [
      'social_networks' => [ 'facebook' => 1, 'twitter' => 1, 'linkedin' => 1 ],
      'post_types' => ['post' => 1, 'page' => 1],
      'button_size' => '32'
    ]);
  }

  

}