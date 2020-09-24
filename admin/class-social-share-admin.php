<?php

class SocialShareAdmin
{
  public $socialNetworks;
  
  public function __construct($socialNetworks)
  {
    $this->socialNetworks = $socialNetworks;
    add_action( 'admin_menu', [$this, 'adminPage'] );
  }

  function adminPage()
  {
    add_menu_page( 'Social Share CheeVT', 'Social Share CheeVT', 'manage_options', 'social_share_cheevt', [$this, 'adminIndex'], 'dashicons-share', 110 );
  }

  function adminIndex()
  {
    $postTypes = get_post_types( ['public' => true], 'names', 'and' );
    $buttonSizes = [
      'small' => '16',
      'medium' => '32',
      'large' => '48',
      'x-large' => '64'
    ];

    $options = get_option('social_share_settings');
    require_once SOCIAL_SHARE_CHEEVT_PLUGIN_PATH . 'admin/templates/settings.php';
  }
}