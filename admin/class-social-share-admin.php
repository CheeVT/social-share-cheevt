<?php

class SocialShareAdmin
{
  protected $options;
  protected $socialNetworks = ['facebook', 'twitter', 'linkedin', 'pinterest', 'whatsapp'];
  protected $buttonSizes = [
    'small' => '16',
    'medium' => '32',
    'large' => '48'
  ];
  protected $postTypes;
  protected $positions = [
    'top' => 'Above content', 
    'bottom' => 'Below content', 
    'float-left' => 'Floating left',
    'featured-image' => 'Inside the featured image'
  ];
  protected $colors = ['default', 'custom'];

  public function __construct()
  {
    $this->options = get_option('social_share_settings');
    $this->postTypes = get_post_types(['public' => true], 'names', 'and' );

    add_action('admin_menu', [$this, 'adminPage']);
    add_action('admin_init', [$this, 'adminInit']);
  }

  function adminPage()
  {
    $settingsPage = add_menu_page('Social Share CheeVT', 'Social Share CheeVT', 'manage_options', 'social_share_cheevt', [$this, 'adminIndex'], 'dashicons-share', 110); 

    add_action('admin_print_styles-' . $settingsPage, [$this, 'adminStyles']);
    add_action('admin_print_scripts-' . $settingsPage, [$this, 'adminScripts']);
  }

  public function adminInit()
  {
    register_setting('social_share_cheevt', 'social_share_settings');
    
    add_settings_section('social_share_settings', 'Social Share Options', [$this, 'socialShareSettings'], 'social_share_cheevt');

    add_settings_field('social_networks', 'Social Networks', [$this, 'socialNetworks'], 'social_share_cheevt', 'social_share_settings');
    add_settings_field('post_types', 'Post Types', [$this, 'postTypes'], 'social_share_cheevt', 'social_share_settings');
    add_settings_field('button_size', 'Button size', [$this, 'buttonSize'], 'social_share_cheevt', 'social_share_settings');
    add_settings_field('position', 'Position', [$this, 'position'], 'social_share_cheevt', 'social_share_settings');
    add_settings_field('color', 'Color', [$this, 'color'], 'social_share_cheevt', 'social_share_settings', ['class' => 'form-table__color']);
    add_settings_field('custom_color', 'Custom Color', [$this, 'customColor'], 'social_share_cheevt', 'social_share_settings', ['class' => ($this->options['color'] == 'default') ? 'form-table__custom-color form-table__custom-color--hide' : 'form-table__custom-color']);
  }

  public function adminStyles()
  {
    wp_enqueue_style('wp-color-picker');
    wp_enqueue_style('social-share-admin', SOCIAL_SHARE_CHEEVT_PLUGIN_URL . '/assets/css/social-share-admin.css');
  }

  public function adminScripts()
  {
    wp_enqueue_script('wp-color-picker');
    wp_enqueue_script('social-share-admin', SOCIAL_SHARE_CHEEVT_PLUGIN_URL . '/assets/js/social-share-admin.js', ['jquery'], '', true);
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
    foreach ($this->socialNetworks as $network)
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
    foreach ($this->postTypes as $type)
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
    foreach ($this->buttonSizes as $label => $size)
    {
      $checked = $size == $this->options['button_size'] ? 'checked' : '';
      $output .= '<label for="' . $label . '">' . ucfirst($label) . '</label>';
      $output .= '<input type="radio" id="'.$label.'" name="social_share_settings[button_size]" value="'. $size .'" '.$checked.' />';
    }
    echo $output;
    
  }

  public function position()
  {
    $output = '';
    foreach ($this->positions as $value => $label)
    {
      $checked = $value == $this->options['position'] ? 'checked' : '';
      $output .= '<label for="' . $value . '">' . $label . '</label>';
      $output .= '<input type="radio" id="'.$value.'" name="social_share_settings[position]" value="'. $value .'" '.$checked.' />';
    }
    echo $output;    
  }

  public function color()
  {
    $output = '';
    foreach ($this->colors as $color)
    {
      $checked = $color == $this->options['color'] ? 'checked' : '';
      $output .= '<label for="' . $color . '">' . ucfirst($color) . '</label>';
      $output .= '<input type="radio" id="'.$color.'" name="social_share_settings[color]" value="'. $color .'" '.$checked.' />';
    }
    echo $output;
  }

  public function customColor()
  {
    $background = isset($this->options['custom_color']['background']) ? $this->options['custom_color']['background'] : '';
    $color = isset($this->options['custom_color']['color']) ? $this->options['custom_color']['color'] : '';

    $output = '<input type="text" name="social_share_settings[custom_color][background]" id="custom_color_background" value="' . $background . '" placeholder="#FF0000" />';
    $output .= '<input type="text" name="social_share_settings[custom_color][color]" id="custom_color_color" value="' . $color . '" placeholder="#000000" />';

    echo $output;
  }
}
