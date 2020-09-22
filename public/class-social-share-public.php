<?php

class SocialSharePublic
{
  public $options;

  public function __construct()
  {
    add_filter( 'the_content', array( $this, 'render_sharing' ), 99 );
    $this->options = get_option('social_share_settings');
  }

  public function render_sharing( $content )
  {
    $shareIcons = '<p>';
    foreach($this->options['social_networks'] as $network => $enabled) {
      $shareIcons .= '<a href="#">' . $network . '</a> | ';
    }
    $shareIcons .= '</p>';
    return $content . $shareIcons;

  }
}