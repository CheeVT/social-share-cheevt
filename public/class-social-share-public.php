<?php

class SocialSharePublic
{
  public $options;

  public function __construct()
  {    
    $this->options = get_option('social_share_settings');
    $this->render();
  }

  protected function render()
  {
    switch($this->options['position'])
    {
      case 'top':
      case 'bottom':
      case 'float-left':
        add_filter('the_content', [$this, 'renderAboveOrBelowContent'], 99);
      break;
      case 'featured-image':
        add_filter('post_thumbnail_html', [$this, 'renderFeaturedImage'], 10, 3);
      break;
    }    
  }

  public function renderFeaturedImage($html, $post_id, $post_image_id)
  {      
    if(! $this->shouldRenderButtons()) return $html;

    $shareIcons = $this->prepareHtml('social-share-cheevt--featured-image');

    return $html . $shareIcons;
  }

  

  public function renderAboveOrBelowContent($content)
  {
    if(! $this->shouldRenderButtons()) return $content;    

    switch($this->options['position'])
    {
      case 'top':
        $shareIcons = $this->prepareHtml('social-share-cheevt--top');
        $content = $shareIcons . $content;
      break;
      case 'bottom':
        $shareIcons = $this->prepareHtml('social-share-cheevt--bottom');
        $content = $content . $shareIcons;
      break;
      case 'float-left':
        $shareIcons = $this->prepareHtml('social-share-cheevt--floating');
        $content = $shareIcons . $content;
      break;
    }
    
    return $content;
  }

  protected function shouldRenderButtons()
  {
    global $post;   

    if (! is_object($post)) return false;

    $postType = $post->post_type;

    if(! array_key_exists($postType, $this->options['post_types'])) return false;

    return true;
  }

  protected function prepareHtml($class = null)
  {
    global $post;

    $shareIcons = '<div class="social-share-cheevt ' . $class . '" style="display: flex; ">';
    foreach($this->options['social_networks'] as $network => $enabled) {
      $renderButton = 'render' . ucfirst($network) . 'Button';
      $shareIcons .= $this->$renderButton($post);
    }
    $shareIcons .= '</div>';

    return $shareIcons;
  }

  protected function getCustomBackground()
  {
    if($this->options['color'] == 'default') return;

    return $this->options['custom_color']['background'];
  }

  protected function getCustomColor()
  {
    if($this->options['color'] == 'default') return;

    return $this->options['custom_color']['color'];
  }

  protected function renderFacebookButton($post)
  {
    $customBackground = $this->getCustomBackground();
    $customColor = $this->getCustomColor();

    $shareButtonHtml = '<a href="https://www.facebook.com/sharer/sharer.php?u=' . urlencode(get_permalink($post)) . '" style="padding: 5px;">';
    $shareButtonHtml .= '<svg height="' . $this->options['button_size'] . '" id="Layer_1" version="1.1" viewBox="0 0 512 512" width="' . $this->options['button_size'] . '" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:cc="http://creativecommons.org/ns#" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd" xmlns:svg="http://www.w3.org/2000/svg">';
    $shareButtonHtml .= '<defs id="defs12"/>';
    $shareButtonHtml .= '<g id="g5991">';
    $shareButtonHtml .= '<rect height="512" id="rect2987" rx="64" ry="64" style="fill:' . (isset($customBackground) ? $customBackground : '#3b5998') . ';fill-opacity:1;fill-rule:nonzero;stroke:none" width="512" x="0" y="0"/>';
    $shareButtonHtml .= '<path d="M 286.96783,455.99972 V 273.53753 h 61.244 l 9.1699,-71.10266 h -70.41246 v -45.39493 c 0,-20.58828 5.72066,-34.61942 35.23496,-34.61942 l 37.6554,-0.0112 V 58.807915 c -6.5097,-0.87381 -28.8571,-2.80794 -54.8675,-2.80794 -54.28803,0 -91.44995,33.14585 -91.44995,93.998125 v 52.43708 h -61.40181 v 71.10266 h 61.40039 v 182.46219 h 73.42707 z" id="f_1_" style="fill:' . (isset($customColor) ? $customColor : '#ffffff') . '"/>';
    $shareButtonHtml .= '</g>';
    $shareButtonHtml .= '</svg>';
    $shareButtonHtml .= '</a>';

    return $shareButtonHtml;
  }

  protected function renderTwitterButton($post)
  {
    $customBackground = $this->getCustomBackground();
    $customColor = $this->getCustomColor();

    $shareButtonHtml = '<a href="https://twitter.com/intent/tweet?text=' . $post->post_title . '&url=' . urlencode(get_permalink($post)) . '" style="padding: 5px;">';
    $shareButtonHtml .= '<svg height="' . $this->options['button_size'] . '" id="Layer_1" version="1.1" viewBox="0 0 512 512" width="' . $this->options['button_size'] . '" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:cc="http://creativecommons.org/ns#" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd" xmlns:svg="http://www.w3.org/2000/svg">';
    $shareButtonHtml .= '<defs id="defs12"/>';
    $shareButtonHtml .= '<g id="g2995">';
    $shareButtonHtml .= '<rect height="512" id="rect2987" rx="64" ry="64" style="fill:' . (isset($customBackground) ? $customBackground : '#00abf1') . ';fill-opacity:1;fill-rule:nonzero;stroke:none" width="512" x="0" y="5.6843419e-014"/>';
    $shareButtonHtml .= '<path d="m 354.94415,355.98152 h -98.7021 c -13.7217,0 -25.3908,-4.8011 -34.9742,-14.4425 -9.6274,-9.6541 -14.3894,-21.3184 -14.3894,-35.1091 v -35.1232 h 140.6368 c 12.6877,0 23.6094,-4.56452 32.6836,-13.61992 9.0694,-9.12435 13.6245,-20.03815 13.6245,-32.73985 0,-12.74087 -4.5551,-23.639 -13.6559,-32.73984 -9.0992,-9.07421 -20.0523,-13.62463 -32.7931,-13.62463 h -140.4975 v -72.56389 c 0,-13.734317 -4.8951,-25.491137 -14.6243,-35.287697 -9.6806,-9.80755 -21.392,-14.73091 -34.9978,-14.73091 -13.9882,0 -25.8923,4.84659 -35.5744,14.44258 -9.7167,9.62734 -14.5696,21.48915 -14.5696,35.615197 v 200.40506 c 0,41.2202 14.5696,76.4311 43.7226,105.6563 29.1766,29.28 64.3515,43.8809 105.4699,43.8809 h 98.6724 c 13.7029,0 25.4629,-4.9203 35.2406,-14.7325 9.7889,-9.7684 14.673,-21.5472 14.673,-35.2688 0,-13.7203 -4.8841,-25.4851 -14.673,-35.2925 -9.7793,-9.7872 -21.5627,-14.7247 -35.2721,-14.7247 z" id="Twitter_3_" style="fill:' . (isset($customColor) ? $customColor : '#ffffff') . '"/>';
    $shareButtonHtml .= '</g>';
    $shareButtonHtml .= '</svg>';
    $shareButtonHtml .= '</a>';

    return $shareButtonHtml;
  }

  protected function renderLinkedinButton($post)
  {
    $customBackground = $this->getCustomBackground();
    $customColor = $this->getCustomColor();

    $shareButtonHtml = '<a href="https://www.linkedin.com/shareArticle?mini=true&url=' . urlencode(get_permalink($post)) . '&title=' . $post->post_title . '" style="padding: 5px;">';
    $shareButtonHtml .= '<svg height="' . $this->options['button_size'] . '" id="Layer_1" version="1.1" viewBox="0 0 512 512" width="' . $this->options['button_size'] . '" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:cc="http://creativecommons.org/ns#" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd" xmlns:svg="http://www.w3.org/2000/svg">';
    $shareButtonHtml .= '<defs id="defs12"/>';
    $shareButtonHtml .= '<g id="g5891">';
    $shareButtonHtml .= '<rect height="512" id="rect2987" rx="64" ry="64" style="fill:' . (isset($customBackground) ? $customBackground : '#0083be') . ';fill-opacity:1;fill-rule:nonzero;stroke:none" width="512" x="0" y="5.6843419e-014"/><g id="g9-1" transform="matrix(1.5537946,0,0,1.5537946,-140.87332,-132.64552)"><rect height="166.021" id="rect11" style="fill:' . (isset($customColor) ? $customColor : '#ffffff') . '" width="55.194" x="129.957" y="200.35699"/><path d="m 157.927,120.303 c -18.884,0 -31.222,12.415 -31.222,28.687 0,15.93 11.963,28.687 30.491,28.687 h 0.357 c 19.245,0 31.224,-12.757 31.224,-28.687 -0.357,-16.272 -11.978,-28.687 -30.85,-28.687 z" id="path13-0" style="fill:' . (isset($customColor) ? $customColor : '#ffffff') . '"/>';
    $shareButtonHtml .= '<path d="m 320.604,196.453 c -29.277,0 -42.391,16.101 -49.734,27.41 v -23.506 h -55.18 c 0.732,15.573 0,166.021 0,166.021 h 55.179 V 273.66 c 0,-4.963 0.357,-9.924 1.82,-13.471 3.982,-9.911 13.068,-20.178 28.313,-20.178 19.959,0 27.955,15.23 27.955,37.539 v 88.828 h 55.182 v -95.206 c 0,-50.996 -27.227,-74.719 -63.535,-74.719 z" id="path15" style="fill:' . (isset($customColor) ? $customColor : '#ffffff') . '"/>';
    $shareButtonHtml .= '</g>';
    $shareButtonHtml .= '</svg>';
    $shareButtonHtml .= '</a>';

    return $shareButtonHtml;
  }

  protected function renderPinterestButton($post)
  {
    $customBackground = $this->getCustomBackground();
    $customColor = $this->getCustomColor();

    $shareButtonHtml = '<a href="#" style="padding: 5px;">';
    $shareButtonHtml .= '<svg height="' . $this->options['button_size'] . '" id="Layer_1" version="1.1" viewBox="0 0 512 512" width="' . $this->options['button_size'] . '" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:cc="http://creativecommons.org/ns#" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd" xmlns:svg="http://www.w3.org/2000/svg">';
    $shareButtonHtml .= '<defs id="defs12"/>';
    $shareButtonHtml .= '<g id="g5830">';
    $shareButtonHtml .= '<rect height="512" id="rect2987" rx="64" ry="64" style="fill:' . (isset($customBackground) ? $customBackground : '#ca2127') . ';fill-opacity:1;fill-rule:nonzero;stroke:none" width="512" x="0" y="0"/>';
    $shareButtonHtml .= '<path d="m 265.38115,56 c -109.161,0 -164.2023,78.2611 -164.2023,143.53806 0,39.51227 14.9518,74.66615 47.0384,87.75208 5.2638,2.17384 9.9811,0.0803 11.5108,-5.74201 1.0595,-4.01953 3.5694,-14.18825 4.6932,-18.44084 1.5297,-5.75942 0.9309,-7.76718 -3.3123,-12.80333 -9.2513,-10.90672 -15.1767,-25.03069 -15.1767,-45.0547 0,-58.05493 43.4474,-110.03969 113.1229,-110.03969 61.7036,0 95.6024,37.70275 95.6024,88.03604 0,66.25605 -29.3236,122.17062 -72.838,122.17062 -24.0381,0 -42.0182,-19.86865 -36.2668,-44.25509 6.9046,-29.10782 20.2838,-60.51273 20.2838,-81.53995 0,-18.7998 -10.1084,-34.48417 -30.9856,-34.48417 -24.57,0 -44.31,25.42046 -44.31,59.46664 0,21.68488 7.3292,36.36068 7.3292,36.36068 0,0 -25.1485,106.53849 -29.5551,125.19767 -8.7746,37.16163 -1.3234,82.70253 -0.6846,87.28998 0.3698,2.74041 3.879,3.40208 5.4675,1.33806 2.2529,-2.95739 31.5374,-39.085 41.4678,-75.19521 2.8234,-10.2156 16.1625,-63.14866 16.1625,-63.14866 7.9909,15.23969 31.3178,28.62699 56.1275,28.62699 73.8518,0 123.9654,-67.32625 123.9654,-157.44773 C 410.83415,119.47011 353.10245,56 265.38115,56 z" id="path15" style="fill:' . (isset($customColor) ? $customColor : '#ffffff') . '"/>';
    $shareButtonHtml .= '</g>';
    $shareButtonHtml .= '</svg>';
    $shareButtonHtml .= '</a>';

    return $shareButtonHtml;
  }

  protected function renderWhatsappButton($post)
  {
    $customBackground = $this->getCustomBackground();
    $customColor = $this->getCustomColor();

    $shareButtonHtml = '<a href="https://api.whatsapp.com/send?text=' . $post->post_title . ' ' . urlencode(get_permalink($post)) . '" style="padding: 5px;">';
    $shareButtonHtml .= '<svg height="' . $this->options['button_size'] . '" id="Layer_1" version="1.1" viewBox="0 0 512 512" width="' . $this->options['button_size'] . '" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:cc="http://creativecommons.org/ns#" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd" xmlns:svg="http://www.w3.org/2000/svg">';
    $shareButtonHtml .= '<defs id="defs12"/>';
    $shareButtonHtml .= '<g id="g5124">';
    $shareButtonHtml .= '<rect height="512" id="rect2987" rx="64" ry="64" style="fill:' . (isset($customBackground) ? $customBackground : '#65bc54') . ';fill-opacity:1;fill-rule:nonzero;stroke:none" width="512" x="0" y="0"/>';
    $shareButtonHtml .= '<path d="m 456,250.85266 c 0,107.60904 -87.9126,194.8442 -196.36397,194.8442 -34.43066,0 -66.77677,-8.80168 -94.9199,-24.24162 L 56.000005,456 91.437745,351.45584 C 73.559715,322.08872 63.265025,287.65523 63.265025,250.85124 63.265025,143.23516 151.18049,56 259.63463,56 368.0874,56.001 456,143.23657 456,250.85266 z M 259.63603,87.03196 c -91.04092,0 -165.093965,73.49248 -165.093965,163.8207 0,35.84056 11.683465,69.04162 31.446055,96.04529 l -20.62177,60.83151 63.44285,-20.16403 c 26.07126,17.11323 57.29196,27.09805 90.82543,27.09805 91.02965,0 165.09396,-73.48543 165.09396,-163.81224 0,-90.3268 -74.06292,-163.81928 -165.09256,-163.81928 z m 99.15526,208.68972 c -1.20989,-1.98879 -4.4185,-3.18602 -9.22424,-5.5706 -4.81705,-2.3874 -28.48964,-13.94551 -32.894,-15.53429 -4.41845,-1.59301 -7.63122,-2.39304 -10.83838,2.38458 -3.20432,4.79028 -12.42856,15.53429 -15.24273,18.72031 -2.80853,3.19166 -5.60863,3.59026 -10.42569,1.20003 -4.80578,-2.38739 -20.32177,-7.4284 -38.70826,-23.70215 -14.30749,-12.65815 -23.96978,-28.2854 -26.77831,-33.07147 -2.80854,-4.77903 -0.2972,-7.3622 2.10993,-9.73975 2.16626,-2.14796 4.81423,-5.58186 7.22416,-8.36364 2.40712,-2.79447 3.20715,-4.78184 4.80861,-7.96926 1.61272,-3.18884 0.80002,-5.97485 -0.3986,-8.3707 -1.20286,-2.38317 -10.83274,-25.88955 -14.84415,-35.449 -4.01138,-9.55947 -8.0115,-7.96646 -10.82568,-7.96646 -2.80996,0 -6.01569,-0.40002 -9.22987,-0.40002 -3.20997,0 -8.42703,1.19864 -12.83562,5.97344 -4.41001,4.78325 -16.84138,16.33291 -16.84138,39.83365 0,23.50497 17.24279,46.21133 19.65273,49.39594 2.40431,3.17756 33.28838,52.9721 82.21811,72.10228 48.94802,19.11328 48.94802,12.74407 57.77365,11.937 8.81437,-0.78735 28.46992,-11.54403 32.48832,-22.70072 4.0086,-11.14964 4.0086,-20.71896 2.8114,-22.70917 z" id="WhatsApp_2_" style="fill:' . (isset($customColor) ? $customColor : '#ffffff') . ';fill-rule:evenodd"/>';
    $shareButtonHtml .= '</g>';
    $shareButtonHtml .= '</svg>';
    $shareButtonHtml .= '</a>';

    return $shareButtonHtml;
  }
}