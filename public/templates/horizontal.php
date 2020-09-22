<?php

$shareIcons = '<div class="social-share-horizontal" style="display: flex; ">';
foreach($this->options['social_networks'] as $network => $enabled) {
  $shareIcons .= '<a href="#" style="padding: 5px;"><img src="' . SOCIAL_SHARE_CHEEVT_PLUGIN_URL . '/assets/images/' . $network . '" style="width: 30px;"/></a> ';
}
$shareIcons .= '</div>';