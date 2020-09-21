<?php

defined( 'ABSPATH' ) or die( 'Your system is shutting down here...' );

require_once SOCIAL_SHARE_CHEEVT_PLUGIN_PATH . 'admin/class-social-share-admin.php';

class SocialShare
{
  public function __construct()
  {
    new SocialShareAdmin();
  }

}