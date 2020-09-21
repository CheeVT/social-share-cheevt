<?php

class SocialShareAdmin
{
  public function __construct()
  {
    add_action( 'admin_menu', [$this, 'adminPage'] );
  }

  function adminPage()
  {
    add_menu_page( 'Social Share CheeVT', 'Social Share CheeVT', 'manage_options', 'social_share_cheevt', [$this, 'adminIndex'], 'dashicons-share', 110 );
  }

  function adminIndex()
  {
    require_once SOCIAL_SHARE_CHEEVT_PLUGIN_PATH . 'admin/templates/settings.php';
  }
}