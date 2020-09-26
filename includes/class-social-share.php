<?php

defined( 'ABSPATH' ) or die( 'Your system is shutting down here...' );

require_once SOCIAL_SHARE_CHEEVT_PLUGIN_PATH . 'admin/class-social-share-admin.php';
require_once SOCIAL_SHARE_CHEEVT_PLUGIN_PATH . 'public/class-social-share-public.php';

class SocialShare
{
  public $socialPublic;
  public function __construct()
  {
    new SocialShareAdmin();
    $this->socialPublic = new SocialSharePublic();   

    add_shortcode( 'social-cheevt', array( $this, 'renderShortcode' ) );
    
    $this->setDefaultSettings();
  }

  public function renderShortcode()
  {
    return $this->socialPublic->prepareHtml();
  }

  protected function setDefaultSettings()
  {
    add_option('social_share_settings', [
      'social_networks' => [ 'facebook' => 1, 'twitter' => 1, 'linkedin' => 1 ],
      'post_types' => ['post' => 1, 'page' => 1],
      'button_size' => '32',
      'position' => 'bottom',
      'color' => 'default',
      'custom_color' => ['background' => '#000000', 'color' => '#FFFFFF']
    ]);
  }

  

}