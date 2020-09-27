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

    add_shortcode('social-cheevt', [$this, 'renderShortcode']);    
  }

  public function renderShortcode()
  {
    return $this->socialPublic->prepareHtml();
  } 

}