<?php

class SocialShareAdmin
{
  protected $options;
  protected $socialNetworks = [ 'facebook', 'twitter', 'linkedin', 'pinterest', 'whatsapp' ];
  protected $buttonSizes = [
    'small' => '16',
    'medium' => '32',
    'large' => '48',
    'x-large' => '64'
  ];
  protected $postTypes;

  public function __construct()
  {
    $this->options = get_option( 'social_share_settings' );
    $this->postTypes = get_post_types( ['public' => true], 'names', 'and' );

    add_action( 'admin_menu', [$this, 'adminPage'] );
    add_action( 'admin_init', [$this, 'adminInit'] );
  }

  function adminPage()
  {
    add_menu_page( 'Social Share CheeVT', 'Social Share CheeVT', 'manage_options', 'social_share_cheevt', [$this, 'adminIndex'], 'dashicons-share', 110 );    
  }

  public function adminInit()
  {
    register_setting( 'social_share_cheevt', 'social_share_settings' );
    
    add_settings_section( 'social_share_settings', 'Social Share Options', [$this, 'socialShareSettings'], 'social_share_cheevt');

    add_settings_field( 'social_networks', 'Social Networks', [$this, 'socialNetworks'], 'social_share_cheevt', 'social_share_settings' );
    add_settings_field( 'post_types', 'Post Types', [$this, 'postTypes'], 'social_share_cheevt', 'social_share_settings' );
    add_settings_field( 'button_size', 'Button size', [$this, 'buttonSize'], 'social_share_cheevt', 'social_share_settings' );
  }

  function adminIndex()
  {
    require_once SOCIAL_SHARE_CHEEVT_PLUGIN_PATH . 'admin/templates/settings.php';
  }

  public function socialShareSettings() {
    echo 'Customize social share buttons';
  }

  public function socialNetworks()
  {
    $output = '';
    foreach ( $this->socialNetworks as $network )
    {
      $checked = array_key_exists($network, $this->options['social_networks']) ? 'checked' : '';
      $output .= '<label for="' . $network . '"><img src="' . SOCIAL_SHARE_CHEEVT_PLUGIN_URL . '/assets/images/' . $network . '" style="width: 30px;"/></label>';
      $output .= '<input type="checkbox" id="'.$network.'" name="social_share_settings[social_networks][' . $network . ']" value="1" '.$checked.' />';
    }
    echo $output;
  }

  public function postTypes()
  {
    $output = '';
    foreach ( $this->postTypes as $type )
    {
      $checked = array_key_exists($type, $this->options['post_types']) ? 'checked' : '';
      $output .= '<label for="' . $type . '">' . ucfirst($type) . '</label>';
      $output .= '<input type="checkbox" id="'.$type.'" name="social_share_settings[post_types][' . $type . ']" value="1" '.$checked.' />';
    }
    echo $output;
  }

  public function buttonSize()
  {
    $output = '';
    foreach ( $this->buttonSizes as $label => $size )
    {
      $checked = $size == $this->options['button_size'] ? 'checked' : '';
      $output .= '<label for="' . $label . '">' . ucfirst($label) . '</label>';
      $output .= '<input type="radio" id="'.$label.'" name="social_share_settings[button_size]" value="'. $size .'" '.$checked.' />';
    }
    echo $output;
    
  }
}
