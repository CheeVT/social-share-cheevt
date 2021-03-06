<?php

class SocialShareActivator
{
  public static function activate()
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