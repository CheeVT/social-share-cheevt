<?php

class SocialSharePublic
{
  public $options;

  public function __construct()
  {
    add_filter( 'the_content', array( $this, 'renderSharing' ), 99 );
    $this->options = get_option('social_share_settings');
  }

  public function renderSharing( $content )
  {
    global $post;   

    if ( ! is_object( $post ) ) return $content;

    $postType = $post->post_type;

    if( ! array_key_exists( $postType, $this->options['post_types'] ) ) return $content;

    //require_once SOCIAL_SHARE_CHEEVT_PLUGIN_PATH . 'public/templates/horizontal.php';   

    $shareIcons = '<div class="social-share-horizontal" style="display: flex; ">';
    foreach($this->options['social_networks'] as $network => $enabled) {
      $renderButton = 'render' . ucfirst($network) . 'Button';
      $shareIcons .= '<a href="' . $this->$renderButton() .'" target="_blank" style="padding: 5px;"><img src="' . SOCIAL_SHARE_CHEEVT_PLUGIN_URL . '/assets/images/' . $network . '" style="width: 30px;"/></a> ';
    }
    $shareIcons .= '</div>';
    
    return $content . $shareIcons;

  }

  protected function renderFacebookButton()
  {
    global $post;
    return 'https://www.facebook.com/sharer/sharer.php?u=' . urlencode(get_permalink($post));
  }

  protected function renderTwitterButton()
  {
    global $post;
    return 'http://twitter.com/intent/tweet?text=' . $post->post_title . '&url=' . urlencode(get_permalink($post));
  }

  protected function renderLinkedinButton()
  {
    global $post;
    return 'http://www.linkedin.com/shareArticle?mini=true&url=' . urlencode(get_permalink($post)) . '&title=' . $post->post_title;
  }

  protected function renderPinterestButton()
  {
    return '#';
  }

  protected function renderWhatsappButton()
  {
    global $post;
    return 'https://api.whatsapp.com/send?text=' . $post->post_title . ' ' . urlencode(get_permalink($post));
  }
}